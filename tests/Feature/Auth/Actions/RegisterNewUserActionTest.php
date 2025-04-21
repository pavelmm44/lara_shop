<?php

namespace Tests\Feature\Auth\Actions;

use App\Http\Requests\SignUpFormRequest;
use Domain\Auth\Contracts\RegisterNewUserContract;
use Domain\Auth\DTOs\NewUserDTO;
use Domain\Auth\Models\User;
use Domain\Cart\CartManager;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterNewUserActionTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_created_success()
    {
        $this->assertDatabaseMissing(User::class, ['email' => 'test@gmail.com']);

        $action = app(RegisterNewUserContract::class);

        $action(NewUserDTO::make('test', 'test@gmail.com', '12345678'));

        $this->assertDatabaseHas(User::class, ['email' => 'test@gmail.com']);
    }
}
