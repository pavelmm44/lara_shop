<?php

namespace Domain\Order\Processes;

use Domain\Order\Contracts\OrderProcessContract;
use Domain\Order\Models\Order;
use Domain\Order\States\PendingOrderState;
use Illuminate\Support\Facades\DB;

class DecreaseProductsQuantities implements OrderProcessContract
{

    public function handle(Order $order, $next)
    {
        foreach (cart()->items() as $item) {

            $item->product()->update([
                'quantity' => DB::raw("quantity - {$item->quantity}")
            ]);
        }

        return $next($order);
    }
}
