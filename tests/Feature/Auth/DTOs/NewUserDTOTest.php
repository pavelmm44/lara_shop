<?php

namespace Auth\DTOs;

use App\Http\Requests\SignUpFormRequest;
use Domain\Auth\DTOs\NewUserDTO;
use Illuminate\Http\Request;
use Tests\TestCase;

class NewUserDTOTest extends TestCase
{
    public function test_instance_created_from_form_request()
    {
        $dto = NewUserDTO::fromRequest(new SignUpFormRequest([
            'name' => 'test',
            'email' => 'test@gmail.com',
            'password' => '12345678'
        ]));

        $this->assertInstanceOf(NewUserDTO::class, $dto);
    }
}
