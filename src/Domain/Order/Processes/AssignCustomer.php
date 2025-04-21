<?php

namespace Domain\Order\Processes;

use Domain\Order\Contracts\OrderProcessContract;
use Domain\Order\DTOs\NewOrderDTO;
use Domain\Order\DTOs\OrderCustomerDTO;
use Domain\Order\Exceptions\OrderProcessException;
use Domain\Order\Models\Order;

class AssignCustomer implements OrderProcessContract
{
    public function __construct(
        private OrderCustomerDTO $dto
    )
    {
    }

    public function handle(Order $order, $next)
    {
        $order->orderCustomer()
            ->create($this->dto->toArray());

        return $next($order);
    }
}
