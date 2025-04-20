<?php

namespace Tests\Feature\App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\SocialAuthController;
use Database\Factories\UserFactory;
use Domain\Auth\Models\User;
use DomainException;
use Illuminate\Testing\TestResponse;
use Laravel\Socialite\Contracts\User as SocialiteUser;
use Laravel\Socialite\Facades\Socialite;
use Mockery\MockInterface;
use Tests\TestCase;

class SocialAuthControllerTest extends TestCase
{
    private function mockSocialiteCallback(string|int $githubId): void
    {
        $user = $this->mock(SocialiteUser::class, function (MockInterface $m) use($githubId) {
            $m->shouldReceive('getId')
                ->once()
                ->andReturn($githubId);

            $m->shouldReceive('getName')
                ->once()
                ->andReturn(str()->random(10));

            $m->shouldReceive('getEmail')
                ->once()
                ->andReturn('test@gmail.com');
        });

        Socialite::shouldReceive('driver->user')
            ->once()
            ->andReturn($user);
    }

    private function callbackRequest(): TestResponse
    {
        return $this->get(action(
            [SocialAuthController::class, 'callback'],
            ['driver' => 'github']
        ));
    }

    public function test_github_callback_user_created_success(): void
    {
        $githubId = str()->random(10);

        $this->assertDatabaseMissing(User::class, [
           'github_id' => $githubId
        ]);

        $this->mockSocialiteCallback($githubId);

        $this->callbackRequest()
            ->assertRedirect(route('home'));

        $this->assertDatabaseHas(User::class, [
            'github_id' => $githubId
        ]);

        $user = User::query()
            ->where(['github_id' => $githubId])
            ->first();

        $this->assertAuthenticatedAs($user);
    }

    public function test_github_existing_user_authenticated_success(): void
    {
        $githubId = str()->random(10);

        $user = UserFactory::new()->create([
            'github_id' => $githubId
        ]);

        $this->assertDatabaseHas(User::class, [
            'github_id' => $githubId
        ]);

        $this->mockSocialiteCallback($githubId);

        $this->callbackRequest()
            ->assertRedirect(route('home'));

        $this->assertAuthenticatedAs($user);
    }

    public function test_driver_is_not_supported_exception(): void
    {
        $this->expectException(DomainException::class);

        $this->withoutExceptionHandling()
            ->get(action(
                [SocialAuthController::class, 'redirect'],
                ['driver' => 'test']
            ));

        $this->withoutExceptionHandling()
            ->get(action(
                [SocialAuthController::class, 'callback'],
                ['driver' => 'test']
            ));
    }
}
