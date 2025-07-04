<?php

namespace App\Http\Controllers;

use App\View\ViewModels\CatalogViewModel;
use Domain\Catalog\Models\Category;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;


class CatalogController extends Controller
{
    public function __invoke(?Category $category): View|Factory|Application
    {
        return view('catalog.index', new CatalogViewModel($category));
    }
}
