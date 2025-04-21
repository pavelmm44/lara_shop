<?php

namespace Domain\Order\Contracts;

use Domain\Order\DTOs\OrderCustomerDTO;
use Domain\Order\DTOs\OrderDTO;

interface CreateNewOrderContract
{
    public function __invoke(OrderDTO $order, OrderCustomerDTO $customer,  bool $createAccount = false);
}
