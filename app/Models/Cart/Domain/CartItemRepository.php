<?php

namespace App\Models\Cart\Domain;

interface CartItemRepository
{
    public function save(Cart $cart, CartItem $item): CartItem;

    public function update(CartItem $item, Quantity $newQuantity): void;

    public function remove(string $cartId, CartItem $item): void;

    public function searchOrFail(string $cartId, int $itemId): CartItem;

    public function countItems(string $cartId): int;
}
