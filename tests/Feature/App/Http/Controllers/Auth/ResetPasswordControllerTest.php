<?php

namespace Tests\Feature\App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SignInController;
use Database\Factories\UserFactory;
use Domain\Auth\Models\User;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class ResetPasswordControllerTest extends TestCase
{
    private User $user;
    private string $token;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = UserFactory::new()->create([
            'email' => 'test@gmail.com'
        ]);
        $this->token = Password::createToken($this->user);
    }

    public function test_page_success(): void
    {
        $this->get(action(
            [ResetPasswordController::class, 'page'],
            ['token' => $this->token]
        ))
            ->assertOk()
            ->assertViewIs('auth.reset-password');
    }

    public function test_handle_success(): void
    {
        $password = '1234567890';
        $password_confirmation = '1234567890';

        Password::shouldReceive('reset')
            ->once()
            ->withSomeOfArgs([
                'email' => $this->user->email,
                'password' => $password,
                'password_confirmation' => $password_confirmation,
                'token' => $this->token,
            ])
            ->andReturn(Password::PASSWORD_RESET);

        $this->post(action([ResetPasswordController::class, 'handle'], [
            'email' => $this->user->email,
            'password' => $password,
            'password_confirmation' => $password_confirmation,
            'token' => $this->token,
        ]))
            ->assertRedirect(action([SignInController::class, 'page']));
    }
}
