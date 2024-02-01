<?php

namespace App\Models\Cart\Infrastructure;

use App\Models\Cart\Domain\CartItem;
use App\Models\Cart\Domain\CartItemRepository;

class EloquentCartItemRepository implements CartItemRepository
{
    public function save(Cart $cart, CartItem $item): void
    {
        $model = new CartItemEloquentModel();
        $model->cart_id = $cart->id();
        $model->product_id = $item->product()->id();
        $model->quantity = $item->quantity()->value();

        $model->save();
    }

    public function update(CartItem $item): bool
    {
        // TODO: Implement update() method.
    }

    public function remove(CartItem $item): bool
    {
        // TODO: Implement remove() method.
    }
}
