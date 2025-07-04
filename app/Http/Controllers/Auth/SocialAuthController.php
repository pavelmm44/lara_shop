<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Domain\Auth\Models\User;
use DomainException;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;
use Support\SessionRegenerator;

class SocialAuthController extends Controller
{
    public function redirect(string $driver): \Symfony\Component\HttpFoundation\RedirectResponse|RedirectResponse
    {
        try {
            return Socialite::driver($driver)
                ->redirect();
        } catch (\Throwable $e) {
            throw new DomainException('An error occurred or the driver is not supported');
        }
    }

    public function callback(string $driver): RedirectResponse
    {
        if ($driver !== 'github') {
            throw new DomainException('The driver is not supported');
        }

        $githubUser = Socialite::driver($driver)->user();

        $user = User::query()->updateOrCreate([
            $driver . '_id' => $githubUser->getId(),
        ], [
            'name' => $githubUser->getName(),
            'email' => $githubUser->getEmail(),
            'password' => bcrypt(str()->random(20))
        ]);

        SessionRegenerator::run(fn() => auth()->login($user));

        return redirect()->intended(route('home'));
    }
}
