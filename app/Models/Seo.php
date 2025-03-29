<?php

namespace App\Models;

use App\Casts\SeoUrlCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Seo extends Model
{
    protected $fillable = [
        'url',
        'title'
    ];

    protected $casts = [
        'url' => SeoUrlCast::class
    ];

    protected static function boot()
    {
        parent::boot();

        self::created(function ($model) {
            Cache::forget('seo_' . str($this->url)->slug('_'));
        });

        self::updated(function ($model) {
            Cache::forget('seo_' . str($this->url)->slug('_'));
        });

        self::deleted(function ($model) {
            Cache::forget('seo_' . str($this->url)->slug('_'));
        });
    }
}
