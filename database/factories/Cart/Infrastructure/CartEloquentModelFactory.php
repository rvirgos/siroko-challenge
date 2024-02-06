<?php

namespace Database\Factories\Cart\Infrastructure;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart\Infrastructure\CartEloquentModel>
 */
class CartEloquentModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => uniqid('cart_'),
            'complete' => false,
        ];
    }
}
