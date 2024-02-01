<?php

namespace App\Models\Cart\Domain;

use App\Models\Products\Domain\Price;

class Cart
{
    private int $id;

    private array $items;

    public function __construct()
    {
        $this->items = [];
    }

    public function addItem(CartItem $item): void
    {
        $key = $item->product()->id();
        if (array_key_exists($key, $this->items)) {
            $this->items[$key]->addQuantity($item->quantity());

            return;
        }
        $this->items[$key] = $item;
    }

    public function removeItem(CartItem $itemToRemove): void
    {
        $key = $itemToRemove->product()->id();
        unset($this->items[$key]);
    }

    public function getTotal(): Price
    {
        $total = 0;

        foreach ($this->items as $item) {
            /* @var $item CartItem */
            $total += $item->subtotal()->value();
        }

        return new Price($total, env('DEFAULT_CURRENCY'));
    }

    public function items(): array
    {
        return $this->items;
    }
}
