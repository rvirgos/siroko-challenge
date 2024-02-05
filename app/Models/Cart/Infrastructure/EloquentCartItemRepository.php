<?php

namespace App\Models\Cart\Infrastructure;

use App\Models\Cart\Domain\Cart;
use App\Models\Cart\Domain\CartItem;
use App\Models\Cart\Domain\CartItemRepository;
use App\Models\Cart\Domain\Quantity;
use App\Models\Products\Infrastructure\EloquentProductRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EloquentCartItemRepository implements CartItemRepository
{
    public function save(Cart $cart, CartItem $item): CartItem
    {
        $model = CartItemEloquentModel::create([
            'cart_id' => $cart->id(),
            'product_id' => $item->product()->id(),
            'quantity' => $item->quantity()->value(),
        ]);

        return $this->searchOrFail($cart->id(), $model->id);
    }

    public function update(CartItem $item, Quantity $newQuantity): void
    {
        $item = CartItemEloquentModel::find($item->id());
        $item->update([
            'quantity' => $newQuantity->value(),
        ]);
    }

    public function remove(string $cartId, CartItem $item): void
    {
        $model = CartItemEloquentModel::select(['id'])
            ->where('cart_id', '=', $cartId)
            ->where('id', '=', $item->id());

        $model->delete();
    }

    public function searchOrFail(string $cartId, int $itemId): CartItem
    {
        $model = CartItemEloquentModel::select(['id', 'product_id', 'quantity'])
            ->where('cart_id', '=', $cartId)
            ->where('id', '=', $itemId);
        if ($model->count() === 0) {
            throw new NotFoundHttpException('Item no encontrado');
        }

        $data = $model->first();

        return CartItem::make(
            $itemId,
            (new EloquentProductRepository())->searchOrFail($data->product_id),
            (new Quantity($data->quantity)),
        );
    }

    public function countItems(string $cartId): int
    {
        return CartItemEloquentModel::select(['quantity'])->where('cart_id', '=', $cartId)->sum();
    }
}
