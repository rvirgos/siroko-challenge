<?php

namespace App\Models\Cart\Domain;

interface CartRepository
{
    public function save(Cart $cart): void;

    public function searchOrCreate(string $id): Cart;

    public function searchOrFail(string $id): Cart;

    public function checkout(string $id): void;
}
