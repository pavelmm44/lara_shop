<?php

use App\Http\Middleware\SeoMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Sentry\Laravel\Integration;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->prependToGroup('web', 'throttle:global');

        $middleware->appendToGroup('web', SeoMiddleware::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        Integration::handles($exceptions);

        $exceptions->renderable(function (\DomainException $e) {
            flash()->alert($e->getMessage());

            return back();
        });
    })->create();
