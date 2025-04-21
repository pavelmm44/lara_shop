<?php

namespace Domain\Cart\Providers;

use Domain\Cart\CartManager;
use Domain\Cart\Contracts\CartStorageIdentityContract;
use Domain\Cart\StorageIdentities\SessionStorageIdentity;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(
            ActionsServiceProvider::class
        );

        app()->bind(CartStorageIdentityContract::class, SessionStorageIdentity::class);

        app()->singleton(CartManager::class);
    }

    public function boot(): void
    {

    }
}
