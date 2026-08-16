<?php

use App\Http\Controllers\AiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\StockMovementController;
use App\Http\Controllers\PurchaseOrderController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.alt');

    Route::post('/record-sale', [DashboardController::class, 'recordSale'])->name('sales.record');
    Route::post('/sales/record', [DashboardController::class, 'recordSale'])->name('sales.record.legacy');

    Route::post('/products/store', [DashboardController::class, 'storeProduct'])->name('products.store');
    Route::put('/products/{id}', [DashboardController::class, 'updateProduct'])->name('products.update');
    Route::delete('/products/{id}', [DashboardController::class, 'destroyProduct'])->name('products.destroy');

    Route::get('/transactions', [DashboardController::class, 'transactionsIndex']);
    Route::get('/transactions/{transaction}/invoice/pdf', [DashboardController::class, 'downloadInvoicePdf'])->name('transactions.invoice.pdf');
    Route::get('/inventory', [DashboardController::class, 'inventoryIndex']);
    Route::get('/reports', [DashboardController::class, 'reportsIndex']);

    Route::get('/suppliers', [SupplierController::class, 'index']);
    Route::post('/suppliers', [SupplierController::class, 'store']);
    Route::delete('/suppliers/{id}', [SupplierController::class, 'destroy']);

    Route::get('/stock-movements', [StockMovementController::class, 'index'])->name('stock-movements.index');
    Route::post('/stock-movements', [StockMovementController::class, 'store'])->name('stock-movements.store');
    Route::get('/stock-movements/{id}', [StockMovementController::class, 'show'])->name('stock-movements.show');

    Route::get('/purchase-orders', [PurchaseOrderController::class, 'index'])->name('purchase-orders.index');
    Route::post('/purchase-orders', [PurchaseOrderController::class, 'store'])->name('purchase-orders.store');
    Route::get('/purchase-orders/{id}', [PurchaseOrderController::class, 'show'])->name('purchase-orders.show');
    Route::put('/purchase-orders/{id}/status', [PurchaseOrderController::class, 'updateStatus'])->name('purchase-orders.updateStatus');
    Route::delete('/purchase-orders/{id}', [PurchaseOrderController::class, 'destroy'])->name('purchase-orders.destroy');

    Route::get('/inventory/export-csv', [DashboardController::class, 'exportCsv'])->name('inventory.export');

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('/settings/profile', [SettingsController::class, 'updateProfile'])->name('settings.profile');
    Route::get('/notifications', [DashboardController::class, 'notificationsIndex'])->name('notifications.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/ai/ask', [AiController::class, 'ask'])->name('ai.ask');
});

require __DIR__.'/auth.php';