<?php

namespace Domain\Order\Processes;

use Domain\Order\Events\OrderCreated;
use Domain\Order\Exceptions\OrderProcessException;
use Domain\Order\Models\Order;
use DomainException;
use Illuminate\Pipeline\Pipeline;
use Support\Transaction;
use Throwable;

class OrderProcess
{
    private array $processes;

    public function __construct(
        private Order $order
    )
    {

    }

    public function processes(array $processes): static
    {
        $this->processes = $processes;

        return $this;
    }

    public function run (): void
    {
        Transaction::run(function (){
            return app(Pipeline::class)
                ->send($this->order)
                ->through($this->processes)
                ->thenReturn();
        }, function (Order $order) {
            flash()->info("Good order #{$order->id}");

            event(new OrderCreated($order));
        }, function (Throwable $e) {
            throw new DomainException($e->getMessage());
        });
    }
}


