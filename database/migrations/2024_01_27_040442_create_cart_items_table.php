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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->string('cart_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity', false, true);
            $table->timestamps();

            $table->foreign('cart_id', 'cart_item_cart_id_foreign')->references('id')->on('carts');
            $table->foreign('product_id', 'cart_item_product_id_foreign')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropForeign('cart_item_cart_id_foreign');
            $table->dropForeign('cart_item_product_id_foreign');
        });
        Schema::dropIfExists('cart_item');
    }
};
