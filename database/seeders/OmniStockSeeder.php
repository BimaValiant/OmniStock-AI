<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;

class OmniStockSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Categories
        $electronics = Category::create(['name' => 'Electronics', 'slug' => 'electronics']);
        $furniture = Category::create(['name' => 'Furniture', 'slug' => 'furniture']);
        $smarthome = Category::create(['name' => 'Smart Home', 'slug' => 'smart-home']);

        // 2. Seed Products
        $p1 = Product::create([
            'category_id' => $electronics->id,
            'name' => 'Quantum Noise-Canceling Headphones',
            'sku' => 'QNC-882-BK',
            'purchase_price' => 1500000,
            'selling_price' => 2200000,
            'stock' => 420,
            'min_stock_alert' => 50,
            'image_icon' => 'headphones'
        ]);

        $p2 = Product::create([
            'category_id' => $furniture->id,
            'name' => 'ErgoForm Mesh Task Chair',
            'sku' => 'EFC-104-GR',
            'purchase_price' => 2100000,
            'selling_price' => 3100000,
            'stock' => 12,
            'min_stock_alert' => 15,
            'image_icon' => 'armchair'
        ]);

        $p3 = Product::create([
            'category_id' => $smarthome->id,
            'name' => 'Nexus Smart Home Hub v2',
            'sku' => 'NEX-SH2-WH',
            'purchase_price' => 800000,
            'selling_price' => 1250000,
            'stock' => 0,
            'min_stock_alert' => 10,
            'image_icon' => 'home'
        ]);

        // 3. Seed Sample Transaction
        $trx = Transaction::create([
            'transaction_code' => 'TRX-' . time(),
            'total_amount' => 5300000,
            'type' => 'sale'
        ]);

        TransactionDetail::create([
            'transaction_id' => $trx->id,
            'product_id' => $p1->id,
            'quantity' => 1,
            'price' => 2200000,
            'subtotal' => 2200000
        ]);

        TransactionDetail::create([
            'transaction_id' => $trx->id,
            'product_id' => $p2->id,
            'quantity' => 1,
            'price' => 3100000,
            'subtotal' => 3100000
        ]);
    }
}