<?php

namespace App\Models\Cart\Domain;

use App\Models\Products\Domain\Price;
use App\Models\Products\Domain\Product;

class CartItem
{
    private Product $product;

    private Quantity $quantity;

    public function __construct(Product $product, Quantity $quantity)
    {
        $this->product = $product;
        $this->quantity = $quantity;
    }

    public function product(): Product
    {
        return $this->product;
    }

    public function quantity(): Quantity
    {
        return $this->quantity;
    }

    public function getSubtotal(): Price
    {
        return new Price( $this->product->price()->value() * $this->quantity->value(), env('DEFAULT_CURRENCY'));
    }
}
