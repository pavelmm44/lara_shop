<?php

namespace Domain\Order\Processes;

use Domain\Order\Contracts\OrderProcessContract;
use Domain\Order\Models\Order;
use Domain\Order\Models\OrderItem;
use Domain\Order\States\PendingOrderState;

class AssignProducts implements OrderProcessContract
{

    public function handle(Order $order, $next)
    {
        $order->orderItems()->createMany(
            cart()->items()->map(
                function ($item) {
                    return [
                        'product_id' => $item->product_id,
                        'price' => $item->price,
                        'quantity' => $item->quantity
                    ];
            })
        );

        return $next($order);
    }
}
