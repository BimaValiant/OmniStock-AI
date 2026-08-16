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
        // 1. Seed Categories (Kategori Lengkap & Variatif)
        $categoriesData = [
            ['name' => 'Electronics & Gadgets', 'slug' => 'electronics-gadgets'],
            ['name' => 'Gaming & Peripherals', 'slug' => 'gaming-peripherals'],
            ['name' => 'Automotive & Parts', 'slug' => 'automotive-parts'],
            ['name' => 'Furniture & Living', 'slug' => 'furniture-living'],
            ['name' => 'Smart Home & IoT', 'slug' => 'smart-home-iot'],
            ['name' => 'Fashion & Apparel', 'slug' => 'fashion-apparel'],
            ['name' => 'Food & Beverages', 'slug' => 'food-beverages'],
            ['name' => 'Health & Beauty', 'slug' => 'health-beauty'],
            ['name' => 'Office Supplies & Stationeries', 'slug' => 'office-supplies'],
            ['name' => 'Sports & Outdoor Equipment', 'slug' => 'sports-outdoor'],
        ];

        $categories = [];
        foreach ($categoriesData as $cat) {
            $categories[$cat['slug']] = Category::firstOrCreate(
                ['slug' => $cat['slug']],
                ['name' => $cat['name']]
            );
        }

        // 2. Seed Sample Products
        $p1 = Product::firstOrCreate(['sku' => 'QNC-882-BK'], [
            'category_id'     => $categories['gaming-peripherals']->id,
            'name'            => 'Quantum Noise-Canceling Headphones',
            'purchase_price'  => 1500000,
            'selling_price'   => 2200000,
            'stock'           => 420,
            'min_stock_alert' => 50,
            'image_icon'      => 'headphones'
        ]);

        $p2 = Product::firstOrCreate(['sku' => 'EFC-104-GR'], [
            'category_id'     => $categories['furniture-living']->id,
            'name'            => 'ErgoForm Mesh Task Chair',
            'purchase_price'  => 2100000,
            'selling_price'   => 3100000,
            'stock'           => 12,
            'min_stock_alert' => 15,
            'image_icon'      => 'armchair'
        ]);

        $p3 = Product::firstOrCreate(['sku' => 'NEX-SH2-WH'], [
            'category_id'     => $categories['smart-home-iot']->id,
            'name'            => 'Nexus Smart Home Hub v2',
            'purchase_price'  => 800000,
            'selling_price'   => 1250000,
            'stock'           => 0,
            'min_stock_alert' => 10,
            'image_icon'      => 'home'
        ]);

        $p4 = Product::firstOrCreate(['sku' => 'CB150-EXH-01'], [
            'category_id'     => $categories['automotive-parts']->id,
            'name'            => 'Custom Exhaust Header Performance',
            'purchase_price'  => 450000,
            'selling_price'   => 750000,
            'stock'           => 25,
            'min_stock_alert' => 5,
            'image_icon'      => 'wrench'
        ]);

        // 3. Seed Sample Transaction (Tanpa transaction_code & type)
        $trx = Transaction::create([
            'invoice_code' => 'INV-' . strtoupper(uniqid()),
            'total_amount' => 5300000,
        ]);

        TransactionDetail::create([
            'transaction_id' => $trx->id,
            'product_id'     => $p1->id,
            'qty'            => 1,
            'price'          => 2200000,
            'subtotal'       => 2200000
        ]);

        TransactionDetail::create([
            'transaction_id' => $trx->id,
            'product_id'     => $p2->id,
            'qty'            => 1,
            'price'          => 3100000,
            'subtotal'       => 3100000
        ]);
    }
}