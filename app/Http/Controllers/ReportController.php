<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        // 1. Total Sales (Revenue) HANYA yang 'Completed' / non-Returned
        $totalSales = Transaction::where('status', '!=', 'Returned')->sum('total_amount') ?? 0;
        
        $totalProducts = Product::count();
        $lowStockCount = Product::whereColumn('stock', '<=', 'min_stock_alert')->count();
        
        // 2. Transaksi Aktif (non-Returned)
        $recentTransactions = Transaction::with('details.product')
            ->where('status', '!=', 'Returned')
            ->latest()
            ->get();

        // 3. Hitung Total HPP (Cost), Laba Bersih (Net Profit), & Profit Margin
        $totalCost = 0;
        foreach ($recentTransactions as $tx) {
            foreach ($tx->details as $detail) {
                // Ambil harga modal (cost_price / purchase_price), jika kosong fallback ke harga jual saat transaksi
                $costPrice = $detail->product->cost_price ?? $detail->product->purchase_price ?? $detail->price;
                $totalCost += ($costPrice * $detail->qty);
            }
        }

        $netProfit = $totalSales - $totalCost;
        $avgMargin = $totalSales > 0 ? round(($netProfit / $totalSales) * 100, 1) : 0;

        // 4. Top Products (Dari transaksi yg TIDAK diretur)
        $topProducts = TransactionDetail::select('product_id', DB::raw('SUM(qty) as total_qty'), DB::raw('SUM(subtotal) as total_revenue'))
            ->whereHas('transaction', function($q) {
                $q->where('status', '!=', 'Returned');
            })
            ->groupBy('product_id')
            ->orderByDesc('total_qty')
            ->take(4)
            ->with('product')
            ->get();

        // 5. Chart Data Mingguan (Filter non-Returned)
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
            'recentTransactions', 
            'totalCost',
            'netProfit',
            'avgMargin', 
            'topProducts', 
            'chartData'
        ));
    }
}