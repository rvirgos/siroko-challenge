<?php

namespace Tests\Unit;

use App\Models\Products\Domain\Price;
use App\Models\Products\Domain\Product;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_invalid_price_product(): void
    {
        $this->expectException('InvalidArgumentException');

        $product = new Product(1, 'Gafas', new Price(-1, 'EUR'));
    }

    public function test_valid_product(): void
    {
        $product = new Product(1, 'Gafas', new Price(1, 'EUR'));
        $this->assertIsObject($product);
    }
}
