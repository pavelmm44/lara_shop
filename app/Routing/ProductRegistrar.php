<?php

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ThumbnailController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class ProductRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('web')->group(function (){

            Route::get('/product/{product:slug}', ProductController::class)
                ->name('product');
        });
    }
}
