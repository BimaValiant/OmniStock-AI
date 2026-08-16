<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\AiChatLog;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // 1. Query Filter & Search Real-time
        $query = Product::with('category');

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        if ($request->has('status') && !empty($request->status)) {
            if ($request->status == 'low') {
                $query->whereColumn('stock', '<=', 'min_stock_alert')->where('stock', '>', 0);
            } elseif ($request->status == 'out') {
                $query->where('stock', 0);
            } elseif ($request->status == 'instock') {
                $query->whereColumn('stock', '>', 'min_stock_alert');
            }
        }

        $products = $query->latest()->get();
        $categories = Category::all();

        // 2. Statistics (Dinamis Real-time)
        $totalAssetValue  = Product::selectRaw('SUM(stock * selling_price) as total')->value('total') ?? 0;
        
        // Ambil data barang menipis/habis untuk Notifikasi Lonceng Header
        $lowStockProducts = Product::whereColumn('stock', '<=', 'min_stock_alert')->orderBy('stock', 'asc')->get();
        $lowStockCount    = $lowStockProducts->count();
        
        $recentLogs       = AiChatLog::latest()->take(5)->get();

        // Total akumulasi revenue agar presisi dengan halaman Transactions
        $monthlySales = Transaction::where('status', '!=', 'Returned')->sum('total_amount') ?? 0;

        // Hitung Profit Margin Realtime
        $totalCost = 0;
        $allTransactions = Transaction::with('details.product')->get();
        
        foreach ($allTransactions as $tx) {
            foreach ($tx->details as $detail) {
                $purchasePrice = $detail->product->purchase_price ?? 0;
                $totalCost += ($purchasePrice * $detail->qty);
            }
        }

        $avgMargin = $monthlySales > 0 
            ? round((($monthlySales - $totalCost) / $monthlySales) * 100, 1) 
            : 0;

        // Respons AJAX untuk live search/filter
        if ($request->ajax()) {
            return response()->json([
                'status'          => 'success',
                'products'        => $products,
                'lowStockCount'   => $lowStockCount,
                'totalAssetValue' => $totalAssetValue,
                'monthlySales'    => $monthlySales
            ]);
        }

        return view('welcome', compact(
            'products',
            'categories',
            'totalAssetValue',
            'lowStockProducts',
            'lowStockCount',
            'recentLogs',
            'monthlySales',
            'avgMargin'
        ));
    }

    public function transactionsIndex()
    {
        $transactions = Transaction::with('details.product')->latest()->get();
        $products = Product::where('stock', '>', 0)->get();

        return view('transactions', compact('transactions', 'products'));
    }

    public function inventoryIndex(Request $request)
    {
        $query = Product::with('category');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        $products = $query->latest()->get();
        $categories = Category::all();

        return view('inventory', compact('products', 'categories'));
    }

    // Method Tambah Produk Baru
    public function storeProduct(Request $request)
    {
        if ($request->category_id == "") {
            $request->merge(['category_id' => null]);
        }

        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'sku'             => 'required|string|unique:products,sku',
            'category_id'     => 'nullable|exists:categories,id',
            'stock'           => 'required|integer|min:0',
            'min_stock_alert' => 'required|integer|min:0',
            'selling_price'   => 'required|numeric|min:0',
        ]);

        $validated['purchase_price'] = $request->purchase_price ?? $request->selling_price;

        Product::create($validated);

        return response()->json(['status' => 'success', 'message' => 'Produk berhasil ditambahkan!']);
    }

    // Method Catat Penjualan (Dengan Pencatatan Riwayat Transaksi DB)
    public function recordSale(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty'        => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($validated['product_id']);

        if ($product->stock < $validated['qty']) {
            return response()->json(['status' => 'error', 'message' => 'Stok tidak mencukupi!'], 400);
        }

        DB::transaction(function () use ($product, $validated) {
            $product->decrement('stock', $validated['qty']);

            $totalAmount = $product->selling_price * $validated['qty'];
            $transaction = Transaction::create([
                'invoice_code' => 'INV-' . strtoupper(uniqid()),
                'total_amount' => $totalAmount,
            ]);

            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'product_id'     => $product->id,
                'qty'            => $validated['qty'],
                'price'          => $product->selling_price,
                'subtotal'       => $totalAmount,
            ]);

            if ($product->fresh()->stock <= $product->min_stock_alert) {
                \Log::warning("ALERT: Stok produk {$product->name} tersisa {$product->fresh()->stock} unit!");
            }
        });

        return response()->json(['status' => 'success', 'message' => 'Penjualan berhasil dicatat!']);
    }

    // Method Update Produk
    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($request->category_id == "") {
            $request->merge(['category_id' => null]);
        }

        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'sku'             => 'required|string|unique:products,sku,' . $id,
            'category_id'     => 'nullable|exists:categories,id',
            'stock'           => 'required|integer|min:0',
            'min_stock_alert' => 'required|integer|min:0',
            'selling_price'   => 'required|numeric|min:0',
        ]);

        $validated['purchase_price'] = $request->purchase_price ?? $product->purchase_price ?? $request->selling_price;

        $product->update($validated);

        return response()->json(['status' => 'success', 'message' => 'Produk berhasil diperbarui!']);
    }

    // Method Hapus Produk
    public function destroyProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['status' => 'success', 'message' => 'Produk berhasil dihapus!']);
    }

    // Fitur Export CSV Data Stok
    public function exportCsv()
    {
        $fileName = 'OmniStock_Inventory_' . date('Y-m-d') . '.csv';
        $products = Product::with('category')->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Product Name', 'SKU', 'Category', 'Stock Level', 'Min Alert', 'Price (IDR)', 'Status');

        $callback = function() use($products, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($products as $p) {
                $status = $p->stock == 0 ? 'Out of Stock' : ($p->stock <= $p->min_stock_alert ? 'Low Stock' : 'In Stock');
                fputcsv($file, array(
                    $p->name,
                    $p->sku,
                    $p->category->name ?? 'General',
                    $p->stock,
                    $p->min_stock_alert,
                    $p->selling_price,
                    $status
                ));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function reportsIndex()
    {
        // 1. Total Revenue hanya menghitung yang statusnya BUKAN Returned
        $totalSales = Transaction::where('status', '!=', 'Returned')->sum('total_amount');
        
        $totalProducts = Product::count();
        $lowStockCount = Product::whereColumn('stock', '<=', 'min_stock_alert')->where('stock', '>', 0)->count();
        
        // 2. Transaksi terbaru juga memfilter yang aktif saja
        $recentTransactions = Transaction::with('details.product')
            ->where('status', '!=', 'Returned')
            ->latest()
            ->take(5)
            ->get();

        return view('reports', compact('totalSales', 'totalProducts', 'lowStockCount', 'recentTransactions'));
    }

    public function notificationsIndex()
    {
        $lowStockProducts = Product::with('category')
            ->whereColumn('stock', '<=', 'min_stock_alert')
            ->orderBy('stock', 'asc')
            ->get();

        $criticalProducts = Product::with('category')
            ->where('stock', 0)
            ->get();

        return view('notifications.index', compact('lowStockProducts', 'criticalProducts'));
    }

    public function downloadInvoicePdf(Transaction $transaction)
    {
        $transaction->load(['details.product']);

        $pdf = Pdf::loadView('invoices.transaction', compact('transaction'))
            ->setPaper('A4', 'portrait');

        return $pdf->download('invoice-' . $transaction->invoice_code . '.pdf');
    }

    // EXPORT ALL TRANSACTIONS CSV
    public function exportTransactionsCsv()
    {
        $fileName = 'OmniStock_Transactions_' . date('Y-m-d') . '.csv';
        $transactions = Transaction::with('details.product')->latest()->get();

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['Date / Time', 'Invoice Code', 'Items Purchased', 'Total Amount', 'Status'];

        $callback = function() use($transactions, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($transactions as $t) {
                $items = $t->details->map(fn($d) => ($d->product->name ?? 'Item') . " (x{$d->qty})")->implode(', ');
                fputcsv($file, [
                    $t->created_at->format('M d, Y H:i:s'),
                    $t->invoice_code,
                    $items,
                    $t->total_amount,
                    $t->status ?? 'Completed'
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // METHOD RETUR TRANSAKSI PENJUALAN
    public function returnTransaction($id)
    {
        $transaction = Transaction::with('details')->findOrFail($id);

        if ($transaction->status === 'Returned') {
            return back()->with('error', 'Transaksi sudah diretur!');
        }

        DB::transaction(function () use ($transaction) {
            $transaction->update(['status' => 'Returned']);

            foreach ($transaction->details as $detail) {
                if ($detail->product_id) {
                    $product = Product::find($detail->product_id);
                    if ($product) {
                        $product->increment('stock', $detail->qty);
                        \App\Models\StockMovement::create([
                            'product_id' => $product->id,
                            'type'       => 'Return',
                            'quantity'   => $detail->qty,
                            'reason'     => 'Retur Invoice: ' . $transaction->invoice_code,
                            'by'         => 'Bima Valiant'
                        ]);
                    }
                }
            }
        });

        return back()->with('success', 'Retur berhasil!');
    }
}