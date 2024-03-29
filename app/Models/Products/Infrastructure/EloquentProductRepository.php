<?php

namespace App\Models\Products\Infrastructure;

use App\Models\Products\Domain\Price;
use App\Models\Products\Domain\Product;
use App\Models\Products\Domain\ProductRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EloquentProductRepository implements ProductRepository
{
    public function save(Product $product): void
    {
        ProductEloquentModel::create([
            'id' => $product->id(),
            'name' => $product->name(),
            'description' => $product->description(),
            'price' => $product->price()->value(),
            'image' => $product->image(),
        ]);
    }

    public function searchOrFail(int $id): ?Product
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

    public function all(): array
    {
        $collection = [];

        $allProducts = ProductEloquentModel::all();

        foreach ($allProducts as $product) {
            $collection[] = new Product(
                $product->id,
                $product->name,
                $product->description,
                new Price($product->price, env('DEFAULT_CURRENCY')),
                $product->image
            );
        }

        return $collection;
    }
}
