<?php

namespace Domain\Order\Providers;

use Domain\Order\Models\Payment;
use Domain\Order\Payment\PaymentData;
use Domain\Order\Payment\PaymentSystem;
use Illuminate\Support\ServiceProvider;

class PaymentSystemProvider extends ServiceProvider
{
    public function boot(): void
    {
        PaymentSystem::provider();

        PaymentSystem::onCreating(function (PaymentData $paymentData) {
            return $paymentData;
        });

        PaymentSystem::onSuccess(function (Payment $payment) {

        });

        PaymentSystem::onValidation(function () {

        });

        PaymentSystem::onError(function (string $message) {

        });
    }
}
