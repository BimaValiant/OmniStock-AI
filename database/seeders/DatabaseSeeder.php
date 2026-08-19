<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Kategori Produk
        $elektronik = Category::create(['name' => 'Electronics & Gadgets']);
        $fnb = Category::create(['name' => 'Food & Beverage']);
        $otomotif = Category::create(['name' => 'Automotive & Parts']);

        // 2. Buat Produk dengan Harga Modal (Cost Price) dan Harga Jual Asli
        Product::create([
            'name' => 'Lenovo LOQ 15',
            'sku' => 'LNV-LOQ-15',
            'category_id' => $elektronik->id,
            'stock' => 10,
            'min_stock_alert' => 2,
            'cost_price' => 11500000, // Harga Beli/Modal
            'selling_price' => 13500000, // Harga Jual
        ]);

        Product::create([
            'name' => 'Samsung S25 Ultra',
            'sku' => 'SS-S25U',
            'category_id' => $elektronik->id,
            'stock' => 8,
            'min_stock_alert' => 2,
            'cost_price' => 21000000,
            'selling_price' => 24500000,
        ]);

        Product::create([
            'name' => 'Kopi Arabica Single Origin 1kg',
            'sku' => 'KOP-ARB-1K',
            'category_id' => $fnb->id,
            'stock' => 25,
            'min_stock_alert' => 5,
            'cost_price' => 120000,
            'selling_price' => 180000,
        ]);

        Product::create([
            'name' => 'Braking System Brembo',
            'sku' => 'BRM-BRK-SYS',
            'category_id' => $otomotif->id,
            'stock' => 5,
            'min_stock_alert' => 2,
            'cost_price' => 1250000,
            'selling_price' => 1850000,
        ]);

        Product::create([
            'name' => 'Keyboard Mechanical Gaming',
            'sku' => 'KB-MECH-01',
            'category_id' => $elektronik->id,
            'stock' => 15,
            'min_stock_alert' => 3,
            'cost_price' => 450000,
            'selling_price' => 750000,
        ]);
    }
}