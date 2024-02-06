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

class CartRemoveTest extends TestCase
{
    private ProductEloquentModel $product;

    public function setUp(): void
    {
        parent::setUp();
        $this->product = ProductEloquentModel::factory()->create();
    }

    public function test_try_to_delete_non_existing_item_must_fail()
    {
        $response = $this->post(
            URL::route('cartRemoveItem'), [
                'product_id' => 0,
            ]
        );
        $this->assertEquals(500, $response->getStatusCode());
    }

    public function test_cart_removes_ok()
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
            URL::route('cartRemoveItem'), [
                'cart_id' => $cart->id(),
                'cart_item_id' => $cartItemId,
            ]
        );

        $this->assertDatabaseMissing('cart_items', [
            'id' => $cartItemId,
            'cart_id' => $cart->id(),
            'product_id' => $this->product->id(),
        ]);
    }
}

