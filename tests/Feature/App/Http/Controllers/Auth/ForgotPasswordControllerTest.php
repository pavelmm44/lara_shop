<?php

namespace Tests\Feature\App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\ForgotPasswordController;
use Database\Factories\UserFactory;
use Domain\Auth\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ForgotPasswordControllerTest extends TestCase
{
    private function testCredentials(): array
    {
        return [
            'email' => 'test@gmail.com'
        ];
    }

    public function test_page_success(): void
    {
        $this->get(action([ForgotPasswordController::class, 'page']))
            ->assertOk()
            ->assertSee('Forgot password')
            ->assertViewIs('auth.forgot-password');
    }

    public function test_handle_success(): void
    {
        $user = UserFactory::new()
            ->create($this->testCredentials());

        $this->assertDatabaseHas(User::class, $this->testCredentials());

        $this->post(
            action([ForgotPasswordController::class, 'handle']),
            $this->testCredentials()
        )->assertRedirect();

        Notification::assertSentTo($user, ResetPassword::class);
    }

    public function test_handle_fail(): void
    {
        $this->assertDatabaseMissing(User::class, $this->testCredentials());

        $this->post(
            action([ForgotPasswordController::class, 'handle']),
            $this->testCredentials()
        )->assertRedirect()
            ->assertInvalid('email');

        Notification::assertNothingSent();
    }
}
