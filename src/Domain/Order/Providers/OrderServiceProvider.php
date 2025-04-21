<?php

namespace Domain\Order\Providers;

use Illuminate\Support\ServiceProvider;

class OrderServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(
            ActionsServiceProvider::class,
            PaymentSystemProvider::class
        );
    }

    public function boot(): void
    {

    }
}
