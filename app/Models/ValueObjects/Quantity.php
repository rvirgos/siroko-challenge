<?php

namespace App\Models\ValueObjects;

use InvalidArgumentException;

class Quantity
{
    private int $value;

    public function __construct($value)
    {
        if ($value < 1) {
            throw new InvalidArgumentException('Quantity cannot be less than one.');
        }

        $this->value = $value;
    }

    public function value(): int
    {
        return $this->value;
    }
}
