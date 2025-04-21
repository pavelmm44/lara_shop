<?php

namespace Database\Seeders;

use Database\Factories\BrandFactory;
use Database\Factories\CategoryFactory;
use Database\Factories\OptionFactory;
use Database\Factories\OptionValueFactory;
use Database\Factories\ProductFactory;
use Database\Factories\PropertyFactory;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        BrandFactory::new()->count(20)
            ->create();

        $properties = PropertyFactory::new()->count(10)
            ->create();

        OptionFactory::new()->count(2)
            ->create();

        $optionValues = OptionValueFactory::new()->count(10)
            ->create();

        CategoryFactory::new()->count(10)
            ->has(
                ProductFactory::new()->count(rand(5,15))
                    ->hasAttached($optionValues)
                    ->hasAttached($properties, function () {
                        return ['value' => fake()->word()];
                    })
            )
            ->create();
    }
}
