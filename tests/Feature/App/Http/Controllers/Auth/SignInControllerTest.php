<?php

namespace Tests\Feature\App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\SignInController;
use App\Http\Requests\SignInFormRequest;
use Database\Factories\UserFactory;
use Tests\TestCase;

class SignInControllerTest extends TestCase
{

    public function test_page_success(): void
    {
        $this->get(action([SignInController::class, 'page']))
            ->assertOk()
            ->assertSee('Login to account')
            ->assertViewIs('auth.login');
    }

    public function test_handle_success(): void
    {
        $password = '123456789';

        $user = UserFactory::new()->create([
            'email' => 'test@gmail.com',
            'password' => bcrypt($password)
        ]);

        $request = SignInFormRequest::factory()->create([
            'email' => $user->email,
            'password' => $password
        ]);

        $response = $this->post(
            action([SignInController::class, 'handle']),
            $request
        );

        $response
            ->assertValid()
            ->assertRedirect(route('home'));

        $this->assertAuthenticatedAs($user);
    }

    public function test_handle_fail(): void
    {
        $user = UserFactory::new()->create([
            'email' => 'test@gmail.com',
            'password' => bcrypt('12345678')
        ]);

        $request = SignInFormRequest::factory()->create([
            'email' => $user->email,
            'password' => '123456789'
        ]);

        $response = $this->post(
            action([SignInController::class, 'handle']),
            $request
        );

        $response
            ->assertInvalid('email')
            ->assertRedirect();

        $this->assertGuest();
    }

    public function test_logout_success(): void
    {
        $user = UserFactory::new()->create([
            'email' => 'test@gmail.com'
        ]);

        $this->actingAs($user);

        $this->delete(action([SignInController::class, 'logout']))
            ->assertRedirect(route('login'));

        $this->assertGuest();
    }

    public function test_logout_middleware_guest_fail(): void
    {
        $this->assertGuest();

        $this->delete(action([SignInController::class, 'logout']))
            ->assertRedirect(route('login'));
    }
}
