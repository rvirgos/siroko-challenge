<?php

namespace Tests\Feature;

use App\Models\Cart\Domain\Cart;
use App\Models\Cart\Infrastructure\CartEloquentModel;
use App\Models\Cart\Infrastructure\CartItemEloquentModel;
use App\Models\Products\Domain\Product;
use App\Models\Products\Infrastructure\EloquentProductRepository;
use App\Models\Products\Infrastructure\ProductEloquentModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class CartUpdateTest extends TestCase
{
    private ProductEloquentModel $product;

    public function setUp(): void
    {
        parent::setUp();
        $this->product = ProductEloquentModel::factory()->create();
    }

    public function test_add_negative_quantity_must_fail()
    {
        $response = $this->post(
            URL::route('cartUpdateItem'), [
                'product_id' => $this->product->id(),
                'quantity' => -1
            ]
        );
        $this->assertEquals(500, $response->getStatusCode());
    }

    public function test_cart_updates_ok()
    {
        $cart = new Cart('cart_001');

        $this->withSession(['cart' => $cart])->post(
            URL::route('cartAddItem'), [
                'product_id' => $this->product->id(),
                'quantity' => 1
            ]
        );
        $cartItemId = DB::table('cart_items')->latest()->value('id');

        $this->withSession(['cart' => $cart])->post(
            URL::route('cartUpdateItem'), [
                'cart_id' => $cart->id(),
                'cart_item_id' => $cartItemId,
                'quantity' => 7
            ]
        );

        $this->assertDatabaseHas('cart_items', [
            'id' => $cartItemId,
            'cart_id' => $cart->id(),
            'product_id' => $this->product->id(),
            'quantity' => 7,
        ]);
    }
}

