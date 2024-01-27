<?php

namespace App\Entities;

use App\ValueObjects\Money;
use App\ValueObjects\Quantity;

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

    public function subTotal(): Money
    {
        return new Money($this->product->price()->amount() * $this->quantity->value(), 'EUR');
    }
}
