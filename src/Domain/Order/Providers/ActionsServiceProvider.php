<?php

namespace Domain\Order\Providers;

use Domain\Order\Actions\CreateNewOrderAction;
use Domain\Order\Contracts\CreateNewOrderContract;
use Illuminate\Support\ServiceProvider;

class ActionsServiceProvider extends ServiceProvider
{
    public array $bindings = [
        CreateNewOrderContract::class => CreateNewOrderAction::class
    ];
}
