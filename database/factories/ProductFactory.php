<?php

namespace Database\Factories;

use Domain\Catalog\Models\Brand;
use Domain\Product\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Product\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => ucfirst(fake()->words(2, true)),
            'price' => fake()->numberBetween(10000, 10000000),
            'thumbnail' => $this->faker->fixturesImage('products', 'products'),
            'brand_id' => Brand::query()->inRandomOrder()->value('id'),
            'on_home_page' => fake()->boolean,
            'sorting' => fake()->numberBetween(1,999),
            'text' => fake()->realText()
        ];
    }
}
