<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => ucfirst(fake()->words(2, true)),
            'price' => fake()->numberBetween(100, 100000),
            'thumbnail' => $this->faker->fixturesImage(
                'products',
                'images/products'
            ),
            'brand_id' => Brand::query()->inRandomOrder()->value('id')
        ];
    }
}
