<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AiController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/products/store', [DashboardController::class, 'storeProduct'])->name('products.store');
Route::post('/sales/record', [DashboardController::class, 'recordSale'])->name('sales.record');
Route::get('/inventory/export-csv', [DashboardController::class, 'exportCsv'])->name('inventory.export');
Route::post('/ai/ask', [AiController::class, 'ask'])->name('ai.ask');