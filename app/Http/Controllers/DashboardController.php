<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\AiChatLog;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\StockMovement; // <-- DITAMBAHKAN
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // <-- DITAMBAHKAN

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
        
        // Data barang menipis/habis untuk Notifikasi Lonceng Header
        $lowStockProducts = Product::whereColumn('stock', '<=', 'min_stock_alert')->orderBy('stock', 'asc')->get();
        $lowStockCount    = $lowStockProducts->count();
        
        $recentLogs       = AiChatLog::latest()->take(5)->get();

        // Total akumulasi revenue (Non-Returned)
        $monthlySales = Transaction::where('status', '!=', 'Returned')->sum('total_amount') ?? 0;

        // Hitung Total HPP / Modal & Laba Bersih (Hanya Transaksi Non-Returned)
        $totalCost = 0;
        $allTransactions = Transaction::with('details.product')
            ->where('status', '!=', 'Returned')
            ->get();
        
        foreach ($allTransactions as $tx) {
            foreach ($tx->details as $detail) {
                $costPrice = $detail->product->cost_price ?? $detail->product->purchase_price ?? 0;
                $totalCost += ($costPrice * $detail->qty);
            }
        }

        $netProfit = $monthlySales - $totalCost;
        $avgMargin = $monthlySales > 0 
            ? round(($netProfit / $monthlySales) * 100, 1) 
            : 0;

        // 3. GRAFIK DASHBOARD: DATA SALES VS DEMAND UNIT PER MINGGU (DITAMBAHKAN)
        $wk1_start = Carbon::now()->startOfMonth();
        $wk1_end   = Carbon::now()->startOfMonth()->addDays(6)->endOfDay();

        $wk2_start = Carbon::now()->startOfMonth()->addDays(7)->startOfDay();
        $wk2_end   = Carbon::now()->startOfMonth()->addDays(13)->endOfDay();

        $wk3_start = Carbon::now()->startOfMonth()->addDays(14)->startOfDay();
        $wk3_end   = Carbon::now()->startOfMonth()->addDays(20)->endOfDay();

        $wk4_start = Carbon::now()->startOfMonth()->addDays(21)->startOfDay();
        $wk4_end   = Carbon::now()->endOfMonth();

        $weeks = [
            ['start' => $wk1_start, 'end' => $wk1_end],
            ['start' => $wk2_start, 'end' => $wk2_end],
            ['start' => $wk3_start, 'end' => $wk3_end],
            ['start' => $wk4_start, 'end' => $wk4_end],
        ];

        $salesWeeklyUnits = [];
        $demandWeeklyUnits = [];

        foreach ($weeks as $w) {
            // Hitung total unit terjual dari Transaksi Non-Returned
            $qtySold = TransactionDetail::whereHas('transaction', function($q) use ($w) {
                $q->where('status', '!=', 'Returned')
                  ->whereBetween('created_at', [$w['start'], $w['end']]);
            })->sum('qty') ?? 0;

            // Hitung total unit keluar dari Stock Movements
            $qtyDemand = StockMovement::where('type', 'Out')
                ->whereBetween('created_at', [$w['start'], $w['end']])
                ->sum('quantity');

            // Jika belum ada catatan StockMovement manual, fallback ke jumlah terjual
            if ($qtyDemand == 0) {
                $qtyDemand = $qtySold;
            }

            $salesWeeklyUnits[]  = (int) $qtySold;
            $demandWeeklyUnits[] = (int) $qtyDemand;
        }

        // Respons AJAX untuk live search/filter
        if ($request->ajax()) {
            return response()->json([
                'status'          => 'success',
                'products'        => $products,
                'lowStockCount'   => $lowStockCount,
                'totalAssetValue' => $totalAssetValue,
                'monthlySales'    => $monthlySales,
                'netProfit'       => $netProfit,
                'avgMargin'       => $avgMargin,
                'salesWeeklyUnits' => $salesWeeklyUnits,
                'demandWeeklyUnits' => $demandWeeklyUnits,
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
            'totalCost',
            'netProfit',
            'avgMargin',
            'salesWeeklyUnits',   // <-- DITAMBAHKAN
            'demandWeeklyUnits'  // <-- DITAMBAHKAN
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
            'cost_price'      => 'nullable|numeric|min:0',
            'selling_price'   => 'required|numeric|min:0',
        ]);

        $validated['cost_price'] = $request->cost_price ?? $request->purchase_price ?? $request->selling_price;

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
            'cost_price'      => 'nullable|numeric|min:0',
            'selling_price'   => 'required|numeric|min:0',
        ]);

        $validated['cost_price'] = $request->cost_price ?? $request->purchase_price ?? $product->cost_price ?? $request->selling_price;

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
        $totalSales = Transaction::where('status', '!=', 'Returned')->sum('total_amount') ?? 0;
        
        $totalProducts = Product::count();
        $lowStockCount = Product::whereColumn('stock', '<=', 'min_stock_alert')->where('stock', '>', 0)->count();
        
        $activeTransactions = Transaction::with('details.product')
            ->where('status', '!=', 'Returned')
            ->latest()
            ->get();

        $totalCost = 0;
        foreach ($activeTransactions as $tx) {
            foreach ($tx->details as $detail) {
                $costPrice = $detail->product->cost_price ?? $detail->product->purchase_price ?? $detail->price;
                $totalCost += ($costPrice * $detail->qty);
            }
        }

        $netProfit = $totalSales - $totalCost;
        $avgMargin = $totalSales > 0 
            ? round(($netProfit / $totalSales) * 100, 1) 
            : 0;

        $topProducts = TransactionDetail::select('product_id', DB::raw('SUM(qty) as total_qty'), DB::raw('SUM(subtotal) as total_revenue'))
            ->whereHas('transaction', function($q) {
                $q->where('status', '!=', 'Returned');
            })
            ->groupBy('product_id')
            ->orderByDesc('total_qty')
            ->take(4)
            ->with('product')
            ->get();

        $chartData = [
            Transaction::where('status', '!=', 'Returned')->whereBetween('created_at', [now()->startOfMonth(), now()->startOfMonth()->addDays(6)])->sum('total_amount') ?? 0,
            Transaction::where('status', '!=', 'Returned')->whereBetween('created_at', [now()->startOfMonth()->addDays(7), now()->startOfMonth()->addDays(13)])->sum('total_amount') ?? 0,
            Transaction::where('status', '!=', 'Returned')->whereBetween('created_at', [now()->startOfMonth()->addDays(14), now()->startOfMonth()->addDays(20)])->sum('total_amount') ?? 0,
            Transaction::where('status', '!=', 'Returned')->whereBetween('created_at', [now()->startOfMonth()->addDays(21), now()->endOfMonth()])->sum('total_amount') ?? 0,
        ];

        return view('reports', compact(
            'totalSales', 
            'totalProducts', 
            'lowStockCount', 
            'activeTransactions', 
            'totalCost',
            'netProfit',
            'avgMargin', 
            'topProducts', 
            'chartData'
        ));
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