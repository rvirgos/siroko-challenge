<?php

namespace App\Models\Cart\Domain;

interface CartRepository
{
    public function save(Cart $cart): void;

    public function search(int $id): ?Cart;

    public function getItems(Cart $cart): array;
}
