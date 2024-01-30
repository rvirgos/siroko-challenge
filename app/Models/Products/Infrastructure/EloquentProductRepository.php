<?php

namespace App\Models\Products\Infrastructure;

use App\Models\Products\Domain\Price;
use App\Models\Products\Domain\Product;
use App\Models\Products\Domain\ProductRepository;
use Illuminate\Support\Collection;

class EloquentProductRepository implements ProductRepository
{

    public function save(Product $product): void
    {
        $model = new ProductEloquentModel();
        $model->id = $product->id();
        $model->name = $product->name();
        $model->price = $product->price()->value();

        $model->save();
    }

    public function search(int $id): ?Product
    {
        $model = ProductEloquentModel::find($id);

        if ($model === null) {
            return null;
        }

        return new Product($model->id, $model->name, new Price($model->price, 'EUR'));
    }

    public function all(): Collection
    {
        $collection = new Collection();

        $allProducts = ProductEloquentModel::all();

        foreach ($allProducts as $product) {
            $collection->add(new Product($product->id, $product->name, new Price($product->price, 'EUR')));
        }

        return $collection;
    }
}
