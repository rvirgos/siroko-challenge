<?php

namespace App\Models\Products\Domain;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @method static first()
 */
class Product
{
    use HasFactory;

    private int $id;

    private string $name;

    private string $description;

    private Price $price;

    private string $image;

    public function __construct(int $id, string $name, string $description, Price $price, string $image)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->image = $image;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function price(): Price
    {
        return $this->price;
    }

    public function image(): string
    {
        return $this->image;
    }
}
