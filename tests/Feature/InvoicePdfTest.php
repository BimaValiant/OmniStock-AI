<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InvoicePdfTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_download_transaction_invoice_pdf(): void
    {
        $user = User::factory()->create();

        $product = Product::create([
            'name' => 'Keyboard Mechanical',
            'sku' => 'KB-001',
            'category_id' => null,
            'stock' => 20,
            'min_stock_alert' => 5,
            'selling_price' => 450000,
            'purchase_price' => 300000,
        ]);

        $transaction = Transaction::create([
            'invoice_code' => 'INV-TEST-001',
            'total_amount' => 900000,
        ]);

        TransactionDetail::create([
            'transaction_id' => $transaction->id,
            'product_id' => $product->id,
            'qty' => 2,
            'price' => 450000,
            'subtotal' => 900000,
        ]);

        $response = $this->actingAs($user)
            ->get(route('transactions.invoice.pdf', $transaction));

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/pdf');
    }
}
