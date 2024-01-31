<?php

namespace App\Models\Cart\Domain;

use App\Models\Products\Domain\Price;
use function App\Models\Entities\array_intersect;

class Cart
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

    public function removeItem(CartItem $itemToRemove): void
    {
        $this->items = array_intersect($this->items, [$itemToRemove]);
    }

    public function getTotal(): Price
    {
        $total = 0;

        foreach ($this->items as $item) {
            /* @var $item CartItem */
            $total += $item->getSubtotal()->value();
        }

        return new Price($total, env('DEFAULT_CURRENCY'));
    }

    public function items(): array
    {
        return $this->items;
    }
}
