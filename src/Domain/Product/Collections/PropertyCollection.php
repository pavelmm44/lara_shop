<?php

namespace Domain\Product\Collections;

use Illuminate\Database\Eloquent\Collection;

class PropertyCollection extends Collection
{
    public function keyValues()
    {
        return $this->mapToGroups(function ($item) {
            return [$item->option->title => $item];
        });
    }
}
