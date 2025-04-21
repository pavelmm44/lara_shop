<?php

namespace Domain\Order\Payment;

use Closure;
use Domain\Order\Contracts\PaymentGatewayContract;
use Domain\Order\Exceptions\PaymentProcessException;
use Domain\Order\Exceptions\PaymentProviderException;
use Domain\Order\Models\Payment;
use Domain\Order\Models\PaymentHistory;
use Domain\Order\States\Payment\PaidPaymentState;
use Domain\Order\Traits\PaymentEvents;

class PaymentSystem
{
    use PaymentEvents;

    private static PaymentGatewayContract $provider;

    public static function provider(PaymentGatewayContract|Closure $providerOrClosure): void
    {
        if (is_callable($providerOrClosure)) {
            $providerOrClosure = call_user_func($providerOrClosure);
        }

        if (!$providerOrClosure instanceof PaymentGatewayContract) {
            throw PaymentProviderException::providerRequired();
        }

        self::$provider = $providerOrClosure;
    }

    public static function create(PaymentData $paymentData): PaymentGatewayContract
    {
        if (!self::$provider instanceof PaymentGatewayContract) {
            throw PaymentProviderException::providerRequired();
        }

        if (is_callable(self::$onCreating)) {
            $paymentData = call_user_func(self::$onCreating, $paymentData);
        }

        Payment::query()->create([
            'payment_id' => self::$provider->paymentId()
        ]);

        return self::$provider->data($paymentData);
    }

    public static function validate(): PaymentGatewayContract
    {
        if (!self::$provider instanceof PaymentGatewayContract) {
            throw PaymentProviderException::providerRequired();
        }

        PaymentHistory::query()->create([
            'payment_getaway' => get_class(self::$provider),
            'method' => request()->method(),
            'payload' => self::$provider->request()
        ]);

        if (is_callable(self::$onValidation)) {
            call_user_func(self::$onValidation);
        }

        if (self::$provider->validate() && self::$provider->paid()) {

            try {
                $payment = Payment::query()
                    ->where('payment_id', self::$provider->paymentId())
                    ->firstOr(function () {
                        throw PaymentProcessException::paymentNotFound();
                    });

                if (is_callable(self::$onSuccess)) {
                    call_user_func(self::$onSuccess, $payment);
                }

                $payment->state->transitionTo(PaidPaymentState::class);
            } catch (PaymentProcessException $e) {

                if (is_callable(self::$onError)) {
                    call_user_func(
                        self::$onError,
                        self::$provider->errorMessage() ?? $e->getMessage()
                    );
                }
            }
        }

        return self::$provider;
    }
}
