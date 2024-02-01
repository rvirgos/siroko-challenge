<?php

namespace App\Models\Cart\Infrastructure;

use App\Models\Cart\Domain\CartRepository;

class EloquentCartRepository implements CartRepository
{
    public function save(Cart $cart): void
    {
        $model = new CartEloquentModel();
        $model->save();
    }

    public function update(Cart $cart): bool
    {
        // TODO: Implement update() method.
    }

    public function remove(Cart $cart): bool
    {
        // TODO: Implement remove() method.
    }
}
