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
            // nullableOnDelete() atau nullable() supaya category_id boleh NULL (buat Kategori "General")
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('sku')->unique();
            // default(0) & nullable() supaya gak crash kalau form cuma ngirim selling_price
            $table->decimal('purchase_price', 15, 2)->nullable()->default(0); 
            $table->decimal('selling_price', 15, 2);
            $table->integer('stock')->default(0);
            $table->integer('min_stock_alert')->default(10);
            $table->string('image_icon')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};