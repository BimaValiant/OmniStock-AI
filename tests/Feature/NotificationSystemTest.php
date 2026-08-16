<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NotificationSystemTest extends TestCase
{
    use RefreshDatabase;

    public function test_low_stock_products_are_listed_in_notifications_page(): void
    {
        $user = User::factory()->create();

        Product::create([
            'name' => 'Mouse Wireless',
            'sku' => 'MOUSE-001',
            'category_id' => null,
            'stock' => 2,
            'min_stock_alert' => 5,
            'selling_price' => 150000,
            'purchase_price' => 100000,
        ]);

        $response = $this->actingAs($user)->get(route('notifications.index'));

        $response->assertOk();
        $response->assertSee('Low Stock Alerts');
        $response->assertSee('Mouse Wireless');
    }
}
