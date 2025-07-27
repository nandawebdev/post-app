<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')
                ->nullable()
                ->constrained('categories')
                ->nullOnDelete();
            $table->string('product_name');
            $table->string('sku')->comment('SKU (Stock Keeping Unit) / Product Code');
            $table->integer('purchase_price'); // 'harga_beli'
            $table->integer('product_purchase_price'); // 'harga_beli_produk'
            $table->integer('stock');
            $table->integer('minimum_stock'); // 'stok_minimal'
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
