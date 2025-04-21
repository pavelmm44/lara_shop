<?php

namespace Tests\Feature\App\Http\Controllers;

use Database\Factories\ProductFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ThumbnailControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_generated_success()
    {
        $size = '500x500';
        $method = 'resize';

        $storage = Storage::disk('images');

        $product = ProductFactory::new()->create();
        config()->set('thumbnail', ['allowed_sizes' => [$size]]);

        $response = $this->get($product->makeThumbnail($size, $method));
        $response->assertOk();

        $storage->exists("products/$method/$size/" . File::basename($product->thumbnail));
    }
}
