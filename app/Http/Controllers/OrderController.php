<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderFormRequest;
use Domain\Order\Actions\CreateNewOrderAction;
use Domain\Order\Contracts\CreateNewOrderContract;
use Domain\Order\DTOs\NewOrderDTO;
use Domain\Order\DTOs\OrderCustomerDTO;
use Domain\Order\DTOs\OrderDTO;
use Domain\Order\Models\DeliveryType;
use Domain\Order\Models\PaymentMethod;
use Domain\Order\Processes\AssignCustomer;
use Domain\Order\Processes\ChangeStateToPending;
use Domain\Order\Processes\CheckProductsQuantities;
use Domain\Order\Processes\ClearCart;
use Domain\Order\Processes\DecreaseProductsQuantities;
use Domain\Order\Processes\OrderProcess;
use Domain\Order\Processes\AssignProducts;
use DomainException;
use Illuminate\Http\RedirectResponse;

class OrderController
{
    public function index()
    {
        $items = cart()->items();

        if ($items->isEmpty()) {
            throw new DomainException('Cart is empty');
        }

        return view('order.index', [
            'items' => $items,
            'deliveries' => DeliveryType::query()->get(),
            'payments' => PaymentMethod::query()->get(),
        ]);
    }

    public function handle(OrderFormRequest $request, CreateNewOrderContract $action): RedirectResponse
    {
        $order = $action(
            OrderDTO::make(...$request->only('delivery_method_id', 'payment_method_id', 'password')),
            OrderCustomerDTO::fromArray($request->get('customer')),
            $request->get('create_account')
        );

        (new OrderProcess($order))
            ->processes([
                new CheckProductsQuantities(),
                new AssignCustomer(
                    OrderCustomerDTO::fromArray($request->get('customer'))
                ),
                new ChangeStateToPending(),
                new AssignProducts(),
                new DecreaseProductsQuantities(),
                new ClearCart()
            ])
            ->run();

        return redirect()
            ->intended(route('home'));
    }
}
