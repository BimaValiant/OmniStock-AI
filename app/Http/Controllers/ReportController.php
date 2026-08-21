<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        // 0. Set Rentang Awal & Akhir Bulan Ini
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth   = Carbon::now()->endOfMonth();

        // 1. Total Sales (Revenue) BULAN INI (HANYA non-Returned)
        $totalSales = Transaction::where('status', '!=', 'Returned')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->sum('total_amount') ?? 0;
        
        $totalProducts = Product::count();
        $lowStockCount = Product::whereColumn('stock', '<=', 'min_stock_alert')->count();
        
        // 2. Transaksi Aktif Bulan Ini
        $recentTransactions = Transaction::with('details.product')
            ->where('status', '!=', 'Returned')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->latest()
            ->get();

        // 3. Hitung Total HPP (Cost), Laba Bersih, & Profit Margin
        $totalCost = 0;
        foreach ($recentTransactions as $tx) {
            foreach ($tx->details as $detail) {
                // Ambil harga modal (cost_price / purchase_price), jika kosong fallback ke harga jual
                $costPrice = $detail->product->cost_price ?? $detail->product->purchase_price ?? $detail->price;
                $totalCost += ($costPrice * $detail->qty);
            }
        }

        $netProfit = $totalSales - $totalCost;
        $avgMargin = $totalSales > 0 ? round(($netProfit / $totalSales) * 100, 1) : 0;

        // 4. Top Products (Filter Bulan Ini & Non-Returned)
        $topProducts = TransactionDetail::select('product_id', DB::raw('SUM(qty) as total_qty'), DB::raw('SUM(subtotal) as total_revenue'))
            ->whereHas('transaction', function($q) use ($startOfMonth, $endOfMonth) {
                $q->where('status', '!=', 'Returned')
                  ->whereBetween('created_at', [$startOfMonth, $endOfMonth]);
            })
            ->groupBy('product_id')
            ->orderByDesc('total_qty')
            ->take(4)
            ->with('product')
            ->get();

        // 5. Chart Data Mingguan (FIX: Menggunakan startOfDay & endOfDay agar jam tidak terpotong)
        $wk1_start = Carbon::now()->startOfMonth();
        $wk1_end   = Carbon::now()->startOfMonth()->addDays(6)->endOfDay(); // Tgl 1 - 7 (23:59:59)

        $wk2_start = Carbon::now()->startOfMonth()->addDays(7)->startOfDay(); // Tgl 8 (00:00:00)
        $wk2_end   = Carbon::now()->startOfMonth()->addDays(13)->endOfDay(); // Tgl 14 (23:59:59)

        $wk3_start = Carbon::now()->startOfMonth()->addDays(14)->startOfDay(); // Tgl 15 (00:00:00)
        $wk3_end   = Carbon::now()->startOfMonth()->addDays(20)->endOfDay(); // Tgl 21 (23:59:59)

        $wk4_start = Carbon::now()->startOfMonth()->addDays(21)->startOfDay(); // Tgl 22 s/d Akhir Bulan
        $wk4_end   = Carbon::now()->endOfMonth();

        $chartData = [
            Transaction::where('status', '!=', 'Returned')->whereBetween('created_at', [$wk1_start, $wk1_end])->sum('total_amount') ?? 0,
            Transaction::where('status', '!=', 'Returned')->whereBetween('created_at', [$wk2_start, $wk2_end])->sum('total_amount') ?? 0,
            Transaction::where('status', '!=', 'Returned')->whereBetween('created_at', [$wk3_start, $wk3_end])->sum('total_amount') ?? 0,
            Transaction::where('status', '!=', 'Returned')->whereBetween('created_at', [$wk4_start, $wk4_end])->sum('total_amount') ?? 0,
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