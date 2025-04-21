<?php

namespace Database\Seeders;

use App\Models\Product;
use Database\Factories\BrandFactory;
use Database\Factories\CategoryFactory;
use Database\Factories\ProductFactory;
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

        CategoryFactory::new()->count(20)
            ->has(
                ProductFactory::new()
                    ->count(rand(5,15))
            )
            ->create();
    }
}
