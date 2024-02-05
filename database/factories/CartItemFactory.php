<?php

namespace Database\Factories;

use App\Models\Cart\Infrastructure\CartEloquentModel;
use App\Models\Products\Infrastructure\ProductEloquentModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart\Infrastructure\CartItemEloquentModel>
 */
class CartItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cart_id' => CartEloquentModel::factory(),
            'product_id' => ProductEloquentModel::factory(),
            'quantity' => fake()->numberBetween(1, 10),
        ];
    }
}
