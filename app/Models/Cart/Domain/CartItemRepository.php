<?php

namespace App\Models\Cart\Domain;

interface CartItemRepository
{
    public function save(Cart $cart, CartItem $item): CartItem;

    public function update(CartItem $item, Quantity $newQuantity): void;

    public function remove(CartItem $item): void;

    public function searchOrFail(string $cartId, int $itemId): CartItem;
}
