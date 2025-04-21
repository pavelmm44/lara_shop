<?php

namespace Domain\Catalog\Sorters;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Stringable;

class Sorter
{
    public const SORT_KEY = 'sort';

    public function __construct(
        private array $columns = []
    )
    {
    }

    public function run(Builder $query): Builder
    {
        $sortData = $this->sortData();

        return $query->when($sortData->contains($this->columns()), function (Builder $q) use ($sortData) {
            $q->orderBy(
                (string) $sortData->remove('-'),
                $sortData->contains('-') ? 'DESC' : 'ASC'
            );
        });
    }

    public function key(): string
    {
        return self::SORT_KEY;
    }

    public function columns(): array
    {
        return $this->columns;
    }

    public function sortData(): Stringable
    {
        return request()->str($this->key());
    }

    public function isActive(string $column, string $direction = 'ASC'): bool
    {
        $column = trim($column, '-');

        if (strtoupper($direction) === 'DESC') {
            $column = '-' . $column;
        }

        return (string) request($this->key()) === $column;
    }
}
