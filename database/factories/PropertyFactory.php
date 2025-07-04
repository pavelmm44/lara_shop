<?php

namespace Database\Factories;

use Domain\Product\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Product\Models\Property>
 */
class PropertyFactory extends Factory
{
    protected $model = Property::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => ucfirst(fake()->words(2, true))
        ];
    }
}
