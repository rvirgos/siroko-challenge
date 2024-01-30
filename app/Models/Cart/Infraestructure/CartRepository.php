<?php

namespace App\Models\Cart\Infraestructure;

use App\Models\Cart\Domain\Cart;

class CartRepository
{
    public function save(Cart $cart)
    {
        // Logic to save the shopping cart to the database or other storage
        // ...
    }

    public function getById(int $id)
    {
        // Logic to retrieve a shopping cart by its identifier from the database
        // ...
    }

    public function getItems(int $id)
    {
        // Logic to retrieve a shopping cart items
        // ...
    }
}
