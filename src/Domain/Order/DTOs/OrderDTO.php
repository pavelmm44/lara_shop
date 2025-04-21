<?php

namespace Domain\Order\DTOs;

use Support\Traits\Makeable;

class OrderDTO
{
    use Makeable;

    public function __construct(
        public int $delivery_method_id,
        public int $payment_method_id,
        public ?string $password,
    )
    {
    }
}
