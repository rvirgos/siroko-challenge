<?php

namespace App\Models\Cart\Domain;

interface CartItemRepository
{
    public function save(Cart $cart, CartItem $item): void;

    public function update(CartItem $item): bool;

    public function remove(CartItem $item): bool;
}
