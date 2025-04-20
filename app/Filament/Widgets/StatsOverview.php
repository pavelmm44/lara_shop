<?php

namespace App\Filament\Widgets;

use Domain\Catalog\Models\Brand;
use Domain\Catalog\Models\Category;
use Domain\Product\Models\Option;
use Domain\Product\Models\Product;
use Domain\Product\Models\Property;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Products', Product::query()->count())
                ->description('Count of products')
                ->icon('heroicon-m-shopping-bag'),
            Stat::make('Categories', Category::query()->count())
                ->description('Count of categories')
                ->icon('heroicon-m-wallet'),
            Stat::make('Options', Option::query()->count())
                ->description('Count of options')
                ->icon('heroicon-m-numbered-list'),
            Stat::make('Properties', Property::query()->count())
                ->description('Count of properties')
                ->icon('heroicon-m-adjustments-horizontal'),
            Stat::make('Brands', Brand::query()->count())
                ->description('Count of brands')
                ->icon('heroicon-m-tag'),
        ];
    }
}
