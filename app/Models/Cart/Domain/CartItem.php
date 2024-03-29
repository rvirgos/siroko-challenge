<?php

namespace App\Models\Cart\Domain;

use App\Models\Products\Domain\Price;
use App\Models\Products\Domain\Product;

class CartItem
{
    private ?int $id;

    private Product $product;

    private Quantity $quantity;

    public static function make(?int $id, Product $product, Quantity $quantity): self
    {
        return new self($id, $product, $quantity);
    }

    private function __construct(?int $id, Product $product, Quantity $quantity)
    {
        $this->id = $id;
        $this->product = $product;
        $this->quantity = $quantity;
    }

    public function id(): ?int
    {
        return $this->id;
    }

    public function product(): Product
    {
        return $this->product;
    }

    public function quantity(): Quantity
    {
        return $this->quantity;
    }

    public function addQuantity(Quantity $moreQuantity): void
    {
        $this->quantity->setValue($this->quantity->value() + $moreQuantity->value());
    }

    public function updateQuantity(Quantity $quantity): void
    {
        $this->quantity->setValue($quantity->value());
    }

    public function subTotal(): Price
    {
        return new Price($this->product->price()->value() * $this->quantity->value(), env('DEFAULT_CURRENCY'));
    }
}
