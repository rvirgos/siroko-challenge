<?php

namespace App\Models\Products\Domain;

use InvalidArgumentException;

class Price
{
    private float $value;

    private string $currency;

    private function ensurePriceIsValid(float $value): void
    {
        if ($value <= 0) {
            throw new InvalidArgumentException($value . 'is not a valid price');
        }

    }

    public function __construct(float $value, string $currency)
    {
        $this->ensurePriceIsValid($value);
        $this->value = $value;
        $this->currency = $currency;
    }

    public function value(): float
    {
        return $this->value;
    }

    public function currency(): string
    {
        return $this->currency;
    }
}
