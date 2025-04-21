<?php

namespace Domain\Product\QueryBuilders;

use Domain\Catalog\Facades\Sorter;
use Domain\Catalog\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pipeline\Pipeline;

class ProductQueryBuilder extends Builder
{
    public function homePage(): ProductQueryBuilder
    {
        return $this->where('on_home_page', true)
            ->orderBy('sorting')
            ->limit(10);
    }

    public function sorted(): \Illuminate\Contracts\Database\Eloquent\Builder|ProductQueryBuilder
    {
        return Sorter::run($this);
    }

    public function filtered(): \Illuminate\Contracts\Database\Eloquent\Builder|ProductQueryBuilder
    {
        return app(Pipeline::class)
            ->send($this)
            ->through(filters())
            ->thenReturn();

        /*foreach (filters() as $filter) {
            $query = $filter->apply($query);
        }*/
    }

    public function search(): ProductQueryBuilder
    {
        return $this->when(request('s'), function (Builder $query) {
            $query->whereFullText(['title', 'text'], request('s'));
        });
    }

    public function withCategory(Category $category): ProductQueryBuilder
    {
        return $this->when($category->exists, function (Builder $query) use ($category) {
            $query->whereRelation(
                'categories',
                'categories.id',
                '=',
                $category->id
            );
        });
    }
}
