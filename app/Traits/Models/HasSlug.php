<?php

namespace App\Traits\Models;

use Illuminate\Database\Eloquent\Model;

trait HasSlug
{
    protected static function bootHasSlug(): void
    {
        self::creating(function (Model $model) {
            $model->makeSlug();
        });
    }

    protected function makeSlug(): void
    {
        if (!$this->{$this->slugColumn()}) {

            $this->{$this->slugColumn()} = $this->uniqueSlug(
                str($this->{$this->slugFrom()})
                    ->slug()
                    ->value()
            );
        }
    }

    protected function slugColumn(): string
    {
        return 'slug';
    }

    protected function slugFrom(): string
    {
        return 'title';
    }

    private function uniqueSlug(string $slug): string
    {
        $originalSlug = $slug;
        $i = 0;

        while ($this->isSlugExists($slug)) {
            $i++;

            $slug = $originalSlug . '-' . $i;
        }

        return $slug;
    }

    private function isSlugExists(string $slug): bool
    {
        $query = $this->newQuery()
            ->where($this->slugColumn(), $slug)
            ->withoutGlobalScopes();

        return $query->exists();
    }
}
