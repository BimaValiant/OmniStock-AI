<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\AiChatLog;

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

    public function storeProduct(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products,sku',
            'category_id' => 'nullable|exists:categories,id',
            'stock' => 'required|integer|min:0',
            'min_stock_alert' => 'required|integer|min:0',
            'selling_price' => 'required|numeric|min:0',
        ]);

        Product::create($validated);

        return response()->json(['status' => 'success', 'message' => 'Produk berhasil ditambahkan!']);
    }

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

        $product->decrement('stock', $validated['qty']);

        return response()->json(['status' => 'success', 'message' => 'Penjualan berhasil dicatat!']);
    }

    // 3. Fitur Export CSV Data Stok
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