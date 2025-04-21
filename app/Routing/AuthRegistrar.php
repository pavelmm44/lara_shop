<?php

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\Auth\SocialAuthController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class AuthRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware(['web', 'guest'])->group(function (){

            Route::controller(SignInController::class)->group(function () {

                Route::get('/login', 'page')->name('login');
                Route::post('/sign-in', 'handle')
                    ->middleware('throttle:auth')
                    ->name('login.handle');
                Route::delete('/logout', 'logout')
                    ->withoutMiddleware('guest')
                    ->middleware('auth')
                    ->name('logout');
            });

            Route::controller(SignUpController::class)->group(function () {

                Route::get('/sign-up','page')->name('register');
                Route::post('/sign-up','handle')
                    ->middleware('throttle:auth')
                    ->name('register.handle');
            });

            Route::controller(ForgotPasswordController::class)->group(function () {

                Route::get('/forgot-password', 'page')
                    ->name('forgot');

                Route::post('/forgot-password', 'handle')
                    ->name('forgot.handle');
            });

            Route::controller(ResetPasswordController::class)->group(function () {

                Route::get('/reset-password/{token}', 'page')
                    ->name('password.reset');

                Route::post('/reset-password', 'handle')
                    ->name('password-reset.handle');
            });

            Route::controller(SocialAuthController::class)->group(function () {

                Route::get('/auth/socialite/{driver}', 'redirect')
                    ->name('socialite.redirect');

                Route::get('/auth/socialite/{driver}/callback', 'callback')
                    ->name('socialite.callback');
            });
        });
    }
}
