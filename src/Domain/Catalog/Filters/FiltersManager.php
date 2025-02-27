<?php

namespace Domain\Catalog\Filters;

class FiltersManager
{
    public function __construct(
        private array $items = []
    )
    {
    }

    public function registerFilters(array $items): void
    {
        $this->items = $items;
    }

    public function filters(): array
    {
        return $this->items;
    }
}
