<?php

namespace Tests\Feature\App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\SignUpController;
use App\Http\Requests\SignUpFormRequest;
use App\Listeners\SendEmailNewUserListener;
use App\Notifications\NewUserNotification;
use Database\Factories\UserFactory;
use Domain\Auth\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class SignUpControllerTest extends TestCase
{
    private array $request;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = SignUpFormRequest::factory()->create([
            'email' => 'test12@gmail.com',
            'password' => '12345678',
            'password_confirmation' => '12345678'
        ]);
    }

    private function request(): TestResponse
    {
        return $this->post(
            action([SignUpController::class, 'handle']),
            $this->request
        );
    }

    private function findUser(): ?User
    {
        return User::query()
            ->where('email', $this->request['email'])
            ->first();
    }

    public function test_sign_up_page_success(): void
    {
        $this->get(action([SignUpController::class, 'page']))
            ->assertOk()
            ->assertSee('Registration')
            ->assertViewIs('auth.sign-up');
    }

    public function test_validation_success(): void
    {
        $this->request()
            ->assertValid();
    }

    public function test_should_validation_fail_on_password_confirm(): void
    {
        $this->request['password'] = '12345678';
        $this->request['password_confirmation'] = '123456789';

        $this->request()
            ->assertInvalid(['password']);
    }

    public function test_user_created_success(): void
    {
        $this->assertDatabaseMissing(User::class, [
            'email' => $this->request['email']
        ]);

        $this->request();

        $this->assertDatabaseHas(User::class, [
            'email' => $this->request['email']
        ]);
    }

    public function test_should_validation_fail_on_unique_email(): void
    {
        UserFactory::new()->create([
            'email' => $this->request['email']
        ]);

        $this->assertDatabaseHas(User::class, [
            'email' => $this->request['email']
        ]);

        $this->request()
            ->assertInvalid(['email']);
    }

    public function test_registered_event_and_listeners_dispatched(): void
    {
        Event::fake();

        $this->request();

        Event::assertDispatched(Registered::class);
        Event::assertListening(Registered::class, SendEmailNewUserListener::class);
    }

    public function test_notification_sent(): void
    {
        $this->request();

        Notification::assertSentTo(
            $this->findUser(),
            NewUserNotification::class
        );
    }

    public function test_user_authenticated_after_and_redirected(): void
    {
        $this->request()
            ->assertRedirect(route('home'));

        $this->assertAuthenticatedAs($this->findUser());
    }

}
