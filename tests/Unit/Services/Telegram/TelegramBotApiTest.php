<?php

namespace Tests\Unit\Services\Telegram;

use Illuminate\Support\Facades\Http;
use Services\Telegram\TelegramBotApi;
use Services\Telegram\TelegramBotApiContract;
use Tests\TestCase;

class TelegramBotApiTest extends TestCase
{
    public function test_send_message_success(): void
    {
        Http::fake([
            TelegramBotApi::HOST . '*' => Http::response(['ok' => true])
        ]);

        $response = TelegramBotApi::sendMessage('test', 1, 'message');

        $this->assertTrue($response);
    }

    public function test_send_message_success_by_fake_instance(): void
    {
        TelegramBotApi::fake()
            ->returnTrue();

        $response = app(TelegramBotApiContract::class)::sendMessage('', 1, '');

        $this->assertTrue($response);
    }

    public function test_send_message_fail_by_fake_instance(): void
    {
        TelegramBotApi::fake()
            ->returnFalse();

        $response = app(TelegramBotApiContract::class)::sendMessage('', 1, '');

        $this->assertFalse($response);
    }
}
