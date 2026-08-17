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
        // 1. Total Sales HANYA yang 'Completed' -> biar sama kayak Dashboard (Rp 25.550.000)
        $totalSales = Transaction::where('status', '!=', 'Returned')->sum('total_amount') ?? 0;
        
        $totalProducts = Product::count();
        $lowStockCount = Product::whereColumn('stock', '<=', 'min_stock_alert')->count();
        
        // 2. Transaksi Aktif (Total 4 Sales)
        $recentTransactions = Transaction::with('details.product')
            ->where('status', '!=', 'Returned')
            ->latest()
            ->get();

        // 3. Profit Margin -> Biar sama 56% kayak Dashboard
        $totalCost = 0;
        foreach ($recentTransactions as $tx) {
            foreach ($tx->details as $detail) {
                // Pastikan ambil harga beli (purchase_price), kalau kosong pakai harga jual (price)
                $purchasePrice = $detail->product->purchase_price ?? $detail->price;
                $totalCost += ($purchasePrice * $detail->qty);
            }
        }
        $avgMargin = $totalSales > 0 ? round((($totalSales - $totalCost) / $totalSales) * 100, 1) : 0;

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
            'avgMargin', 
            'topProducts', 
            'chartData'
        ));
    }
}