<?php

namespace App\Entities;

use App\ValueObjects\Money;

class ShoppingCart
{
    private int $id;
    private array $items;

    public function create(int $id): self
    {
        return new self($id);
    }

    private function __construct(int $id)
    {
        $this->id = $id;
        $this->items = [];
    }

    public function addItem(CartItem $item): void
    {
        $this->items[] = $item;
    }

    public function getTotal(): Money
    {
        $total = 0;

        foreach ($this->items as $item) {
            /* @var $item CartItem */
            $total += $item->subtotal()->amount();
        }

        return new Money($total, 'EUR');
    }

    public function items(): array
    {
        return $this->items;
    }
}
