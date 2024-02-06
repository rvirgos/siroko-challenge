<?php

namespace Tests\Feature;

use App\Models\Cart\Infrastructure\CartEloquentModel;
use App\Models\Products\Infrastructure\ProductEloquentModel;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class CartAddTest extends TestCase
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
            URL::route('cartAddItem'), [
                'product_id' => $this->product->id(),
                'quantity' => -1
            ]
        );
        $this->assertEquals(500, $response->getStatusCode());
    }

    public function test_new_cart_created_on_first_insert()
    {
        $actualCount = CartEloquentModel::count();

        $this->post(
            URL::route('cartAddItem'), [
                'product_id' => $this->product->id(),
                'quantity' => 1
            ]
        );

        $this->assertDatabaseCount('carts',$actualCount+1);
    }

    public function test_cart_inserts_ok()
    {
        $this->post(
            URL::route('cartAddItem'), [
                'product_id' => $this->product->id(),
                'quantity' => 18
            ]
        );

        $this->assertDatabaseHas('cart_items', ['product_id' => $this->product->id(),
            'quantity' => 18]);
    }
}

