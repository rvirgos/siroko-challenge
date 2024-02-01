<?php

namespace App\Models\Cart\Infrastructure;

use App\Models\Cart\Domain\CartItem;
use App\Models\Cart\Domain\CartItemRepository;

use App\Models\Products\Infrastructure\ProductEloquentModel;

class EloquentCartItemRepository implements CartItemRepository
{
    public function save(CartItem $item): void
    {
        $model = new ProductCartItemModel();
        $model->id = $item->id();
        $model->product_id = $item->product()->id();
        $model->quantity = $item->quantity();

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
