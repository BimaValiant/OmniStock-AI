<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\AiChatLog;
use App\Models\Transaction;
use App\Models\TransactionDetail;
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

        // 2. Statistics
        $totalAssetValue = Product::selectRaw('SUM(stock * selling_price) as total')->value('total') ?? 0;
        $lowStockCount = Product::whereColumn('stock', '<=', 'min_stock_alert')->count();
        $recentLogs = AiChatLog::latest()->take(5)->get();

        // Respons AJAX untuk live search/filter
        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'products' => $products,
                'lowStockCount' => $lowStockCount
            ]);
        }

        return view('welcome', compact(
            'products',
            'categories',
            'totalAssetValue',
            'lowStockCount',
            'recentLogs'
        ));
    }

    public function transactionsIndex()
{
    $transactions = Transaction::with('details.product')->latest()->get();
    return view('transactions', compact('transactions'));
}

    // Method Tambah Produk Baru
    public function storeProduct(Request $request)
    {
        if ($request->category_id == "") {
            $request->merge(['category_id' => null]);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products,sku',
            'category_id' => 'nullable|exists:categories,id',
            'stock' => 'required|integer|min:0',
            'min_stock_alert' => 'required|integer|min:0',
            'selling_price' => 'required|numeric|min:0',
        ]);

        // Mencegah error MySQL pada kolom purchase_price yang NOT NULL
        $validated['purchase_price'] = $request->purchase_price ?? $request->selling_price;

        Product::create($validated);

        return response()->json(['status' => 'success', 'message' => 'Produk berhasil ditambahkan!']);
    }

    // Method Catat Penjualan (Dengan Pencatatan Riwayat Transaksi DB)
    public function recordSale(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($validated['product_id']);

        if ($product->stock < $validated['qty']) {
            return response()->json(['status' => 'error', 'message' => 'Stok tidak mencukupi!'], 400);
        }

        // Gunakan DB Transaction agar potong stok dan simpan transaksi bersifat atomik
        DB::transaction(function () use ($product, $validated) {
            // 1. Potong stok produk
            $product->decrement('stock', $validated['qty']);

            // 2. Buat header transaksi baru
            $totalAmount = $product->selling_price * $validated['qty'];
            $transaction = Transaction::create([
                'invoice_code' => 'INV-' . strtoupper(uniqid()),
                'total_amount' => $totalAmount,
            ]);

            // 3. Simpan detail transaksi
            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'product_id' => $product->id,
                'qty' => $validated['qty'],
                'price' => $product->selling_price,
                'subtotal' => $totalAmount,
            ]);
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
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products,sku,' . $id,
            'category_id' => 'nullable|exists:categories,id',
            'stock' => 'required|integer|min:0',
            'min_stock_alert' => 'required|integer|min:0',
            'selling_price' => 'required|numeric|min:0',
        ]);

        // Jaga-jaga kalau purchase_price dari record lama null/diisi nilai baru
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
}