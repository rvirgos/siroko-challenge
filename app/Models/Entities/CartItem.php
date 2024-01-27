<?php

namespace App\Models\Entities;

use App\Models\ValueObjects\Money;
use App\Models\ValueObjects\Quantity;

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

    public function getSubtotal(): Money
    {
        return new Money($this->product->price()->amount() * $this->quantity->value(), env('DEFAULT_CURRENCY'));
    }
}
