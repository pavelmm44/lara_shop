<?php

namespace Domain\Auth\Providers;

use Domain\Auth\Actions\RegisterNewUserAction;
use Domain\Auth\Contracts\RegisterNewUserContract;
use Illuminate\Support\ServiceProvider;

class ActionsServiceProvider extends ServiceProvider
{
    public $bindings = [
        RegisterNewUserContract::class => RegisterNewUserAction::class
    ];
}
