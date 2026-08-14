<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AiController;
use App\Http\Controllers\SupplierController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/products/store', [DashboardController::class, 'storeProduct'])->name('products.store');
Route::post('/sales/record', [DashboardController::class, 'recordSale'])->name('sales.record');
Route::get('/inventory/export-csv', [DashboardController::class, 'exportCsv'])->name('inventory.export');
Route::post('/ai/ask', [AiController::class, 'ask'])->name('ai.ask');
Route::put('/products/{id}', [DashboardController::class, 'updateProduct'])->name('products.update');
Route::delete('/products/{id}', [DashboardController::class, 'destroyProduct'])->name('products.destroy');
Route::get('/transactions', [DashboardController::class, 'transactionsIndex']);
Route::get('/suppliers', [SupplierController::class, 'index']);
Route::post('/suppliers', [SupplierController::class, 'store']);
Route::delete('/suppliers/{id}', [SupplierController::class, 'destroy']);