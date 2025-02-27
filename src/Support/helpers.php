<?php

use Domain\Catalog\Filters\FiltersManager;
use Support\Flash\Flash;

if (!function_exists('filters')) {
    function filters():array
    {
        return app(FiltersManager::class)->filters();
    }
}

if (!function_exists('flash')) {
    function flash():Flash
    {
        return app(Flash::class);
    }
}
