<?php

namespace Domain\Auth\Providers;

use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(ActionsServiceProvider::class);
    }
}
