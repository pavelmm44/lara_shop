<?php

namespace Tests\Feature\App\Http\Controllers;

use App\Http\Controllers\HomeController;
use Database\Factories\BrandFactory;
use Database\Factories\CategoryFactory;
use Database\Factories\ProductFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_success_response()
    {
        CategoryFactory::new()
            ->count(5)
            ->create([
                'on_home_page' => true,
                'sorting' => 999
            ]);

        $category = CategoryFactory::new()
            ->create([
                'on_home_page' => true,
                'sorting' => 1
            ]);

        ProductFactory::new()
            ->count(5)
            ->create([
                'on_home_page' => true,
                'sorting' => 999
            ]);

        $product = ProductFactory::new()
            ->create([
                'on_home_page' => true,
                'sorting' => 1
            ]);

        BrandFactory::new()
            ->count(5)
            ->create([
                'on_home_page' => true,
                'sorting' => 999
            ]);

        $brand = BrandFactory::new()
            ->create([
                'on_home_page' => true,
                'sorting' => 1
            ]);

        $this->get(action(HomeController::class))
            ->assertOk()
            ->assertViewHas('categories.0', $category)
            ->assertViewHas('products.0', $product)
            ->assertViewHas('brands.0', $brand);
    }
}
