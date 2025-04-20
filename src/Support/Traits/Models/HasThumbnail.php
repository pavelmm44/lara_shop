<?php

namespace Support\Traits\Models;

use App\Http\Controllers\ThumbnailController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait HasThumbnail
{
    abstract private function thumbnailDir(): string;

    public function makeThumbnail(string $size, string $method = 'resize'): string
    {
        return route('thumbnail', [
            $this->thumbnailDir(),
            $method,
            $size,
            File::basename($this->{$this->thumbnailColumn()})
        ]);
    }

    private function thumbnailColumn(): string
    {
        return 'thumbnail';
    }
}
