<?php

namespace App\Models\Cart\Infrastructure;

use App\Models\Cart\Domain\Cart;
use App\Models\Cart\Domain\CartRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    public function searchOrFail(string $id): Cart
    {
        $model = CartEloquentModel::select('id')->where('id', '=', $id);
        if ($model->count() === 0) {
            throw new NotFoundHttpException('Carrito no encontrado');
        }

        return $model->first();
    }

    public function checkout(string $id): void
    {
        $model = CartEloquentModel::select('id')->where('id', '=', $id);
        if ($model->count() === 0) {
            throw new NotFoundHttpException('Carrito no encontrado');
        }

        $model->first()->update([
            'complete' => true,
        ]);

    }
}
