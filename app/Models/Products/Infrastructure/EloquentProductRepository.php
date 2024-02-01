<?php

namespace App\Models\Products\Infrastructure;

use App\Models\Products\Domain\Price;
use App\Models\Products\Domain\Product;
use App\Models\Products\Domain\ProductRepository;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EloquentProductRepository implements ProductRepository
{
    public function save(Product $product): void
    {
        $model = new ProductEloquentModel();
        $model->id = $product->id();
        $model->name = $product->name();
        $model->description = $product->description();
        $model->price = $product->price()->value();
        $model->image = $product->image();

        $model->save();
    }

    public function search(int $id): ?Product
    {
        if (! $model = ProductEloquentModel::find($id)) {
            throw new NotFoundHttpException('Producto no encontrado');
        }

        return new Product(
            $model->id,
            $model->name,
            $model->description,
            new Price($model->price, env('DEFAULT_CURRENCY')),
            $model->image
        );
    }

    public function all(): Collection
    {
        $collection = new Collection();

        $allProducts = ProductEloquentModel::all();

        foreach ($allProducts as $product) {
            $collection->add(new Product(
                $product->id,
                $product->name,
                $product->description,
                new Price($product->price, env('DEFAULT_CURRENCY')),
                $product->image
            ));
        }

        return $collection;
    }
}
