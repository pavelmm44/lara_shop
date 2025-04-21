<?php

namespace App\Jobs;

use Domain\Product\Models\Product;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProductJsonProperties implements ShouldQueue, ShouldBeUnique
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private Product $product
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $properties = $this->product->properties
            ->mapWithKeys(fn($item) => [$item->title => $item->pivot->value])
            ->toArray();

        $this->product->updateQuietly(['json_properties' => $properties]);
    }

    public function uniqueId(): mixed
    {
        return $this->product->getKey();
    }
}
