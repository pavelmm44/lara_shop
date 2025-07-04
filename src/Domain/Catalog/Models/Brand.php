<?php

namespace Domain\Catalog\Models;

use Domain\Catalog\Collections\BrandCollection;
use Domain\Catalog\QueryBuilders\BrandQueryBuilder;
use Domain\Product\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Support\Traits\Models\HasSlug;
use Support\Traits\Models\HasThumbnail;

/**
 * @method static Builder|BrandQueryBuilder query()
 */
class Brand extends Model
{
    use HasFactory;
    use HasSlug;
    use HasThumbnail;

    protected $fillable = [
        'title',
        'slug',
        'thumbnail',
        'on_home_page',
        'sorting'
    ];

    public function newCollection(array $models = []): BrandCollection
    {
        return new BrandCollection($models);
    }

    public function newEloquentBuilder($query): BrandQueryBuilder
    {
        return new BrandQueryBuilder($query);
    }

    private function thumbnailDir(): string
    {
        return 'brands';
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
