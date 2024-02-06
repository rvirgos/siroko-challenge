<?php

namespace Database\Factories\Products\Infrastructure;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Products\Domain\Product>
 */
class ProductEloquentModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'description' => fake()->paragraph(),
            'price' => fake()->randomFloat(2, 30, 100),
            'image' => fake()->randomElement(['k3s-london.webp', 'k3-triathlon.webp', 'x1-lanzarote.webp', 'x1-monaco.webp']),
        ];
    }
}
