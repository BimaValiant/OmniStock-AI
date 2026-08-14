<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up(): void
{
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->foreignId('category_id')->constrained()->onDelete('cascade');
        $table->string('name');
        $table->string('sku')->unique();
        $table->decimal('purchase_price', 15, 2); // Harga Beli/Modal
        $table->decimal('selling_price', 15, 2);  // Harga Jual
        $table->integer('stock')->default(0);
        $table->integer('min_stock_alert')->default(10); // Batas minimal buat alert AI
        $table->string('image_icon')->nullable(); // Nama icon Lucide (misal: headphones, armchair)
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
