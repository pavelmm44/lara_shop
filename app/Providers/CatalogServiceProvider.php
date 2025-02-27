<?php

namespace App\Providers;

use App\Filters\BrandFilter;
use App\Filters\PriceFilter;
use App\View\Composers\NavigationComposer;
use Domain\Catalog\Filters\FiltersManager;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class CatalogServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        app()->singleton(FiltersManager::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        app(FiltersManager::class)->registerFilters([
            new PriceFilter(),
            new BrandFilter()
        ]);
    }
}
