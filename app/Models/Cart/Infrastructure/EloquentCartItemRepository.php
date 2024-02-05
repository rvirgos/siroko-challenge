<?php

namespace App\Models\Cart\Infrastructure;

use App\Models\Cart\Domain\Cart;
use App\Models\Cart\Domain\CartItem;
use App\Models\Cart\Domain\CartItemRepository;

class EloquentCartItemRepository implements CartItemRepository
{
    public function save(Cart $cart, CartItem $item): void
    {
        CartItemEloquentModel::create([
            'cart_id' => $cart->id(),
            'product_id' => $item->product()->id(),
            'quantity' => $item->quantity()->value(),
        ]);
    }

    public function update(CartItem $item): bool
    {
        // TODO: Implement update() method.
        return false;
    }

    public function remove(CartItem $item): bool
    {
        // TODO: Implement remove() method.
        return false;
    }
}
