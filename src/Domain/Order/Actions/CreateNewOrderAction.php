<?php

namespace Domain\Order\Actions;

use App\Http\Requests\OrderFormRequest;
use Domain\Auth\Actions\RegisterNewUserAction;
use Domain\Auth\Contracts\RegisterNewUserContract;
use Domain\Auth\DTOs\NewUserDTO;
use Domain\Auth\Models\User;
use Domain\Order\Contracts\CreateNewOrderContract;
use Domain\Order\DTOs\NewOrderDTO;
use Domain\Order\DTOs\OrderCustomerDTO;
use Domain\Order\DTOs\OrderDTO;
use Domain\Order\Events\OrderCreated;
use Domain\Order\Models\Order;

class CreateNewOrderAction implements CreateNewOrderContract
{
    public function __invoke(OrderDTO $order, OrderCustomerDTO $customer, ?bool $createAccount = false): Order
    {
        if ($createAccount) {
            $registered = app(RegisterNewUserContract::class);

            $registered(
                NewUserDTO::make(
                    $customer->fullName(),
                    $customer->email,
                    $order->password,
                )
            );
        }

        return Order::query()->create([
            'delivery_type_id' => $order->delivery_method_id,
            'payment_method_id' => $order->payment_method_id,
        ]);
    }
}
