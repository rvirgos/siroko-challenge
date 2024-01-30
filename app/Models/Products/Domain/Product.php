<?php

namespace App\Models\Products\Domain;

class Product
{
    private int $id;

    private string $name;

    private Price $price;

    public function __construct(int $id, string $name, Price $price)
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

    public function price(): Price
    {
        return $this->price;
    }
}
