<?php

namespace Domain\Order\Processes;

use Domain\Order\Contracts\OrderProcessContract;
use Domain\Order\Models\Order;
use Domain\Order\States\PendingOrderState;
use Illuminate\Support\Facades\DB;

class ClearCart implements OrderProcessContract
{

    public function handle(Order $order, $next)
    {
        cart()->truncate();

        return $next($order);
    }
}
