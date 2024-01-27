<?php

namespace App\Entities;

use Money;

class Product
{
    private int $id;
    private string $name;
    private Money $price;

    public function __construct(int $id, string $name, Money $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function price(): Money
    {
        return $this->price;
    }
}
