<?php

namespace App\Http\Controllers;

use Domain\Product\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;

class ProductController
{
    public function __invoke(Product $product): View|Factory|Application
    {
        $product->load(['optionValues.option']);

        return view('product.index', [
            'product' => $product,
            'options' => $product->optionValues->keyValues()
        ]);
    }
}
