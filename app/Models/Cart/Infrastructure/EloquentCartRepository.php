<?php

namespace App\Models\Cart\Infrastructure;

use App\Models\Cart\Domain\Cart;
use App\Models\Cart\Domain\CartRepository;

class EloquentCartRepository implements CartRepository
{
    public function save(Cart $cart): void
    {
        CartEloquentModel::create([
            'id' => $cart->id(),
            'complete' => false,
        ]);
    }

    public function searchOrCreate(string $id): Cart
    {
        $cart = new Cart($id);

        if (CartEloquentModel::select('id')->where('id', '=', $id)->count() === 0) {
            $this->save($cart);
        }

        return $cart;
    }

    public function getItems(Cart $cart): array
    {
        //  TODO: Implement getItems() method.
        return [];
    }
}
