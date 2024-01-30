<?php

namespace App\Models\Products\Domain;

use Illuminate\Support\Collection;

interface ProductRepository
{
    public function save(Product $product): void;

    public function search(int $id): ?Product;

    public function all(): Collection;
}
