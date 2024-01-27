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
        Schema::create('cart_item', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->integer('quantity', false, true);
            $table->timestamps();

            $table->foreign('product_id', 'cart_item_product_id_foreign')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cart_item', function (Blueprint $table) {
            $table->dropForeign('cart_item_product_id_foreign');
        });
        Schema::dropIfExists('cart_item');
    }
};
