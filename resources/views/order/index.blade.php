@extends('layouts.app')

@section('title', 'Order')

@section('content')
    <main class="py-16 lg:py-20">
        <div class="container">

            <!-- Breadcrumbs -->
            <ul class="breadcrumbs flex flex-wrap gap-y-1 gap-x-4 mb-6">
                <li><a href="{{ route('home') }}" class="text-body hover:text-pink text-xs">Home</a></li>
                <li><a href="{{ route('cart') }}" class="text-body hover:text-pink text-xs">Cart</a></li>
                <li><span class="text-body text-xs">Placing an order</span></li>
            </ul>

            <section>
                <!-- Section heading -->
                <h1 class="mb-8 text-lg lg:text-[42px] font-black">Placing an order</h1>

                <form action="{{ route('order.handle') }}" method="POST" class="grid xl:grid-cols-3 items-start gap-6 2xl:gap-8 mt-12">
                    @csrf

                    <!-- Contact information -->
                    <div class="p-6 2xl:p-8 rounded-[20px] bg-card">
                        <h3 class="mb-6 text-md 2xl:text-lg font-bold">Contact information</h3>
                        <div class="space-y-3">

                            <x-forms.text-input
                                name="customer[first_name]"
                                value="{{ old('customer.first_name') }}"
                                placeholder="First name"
                                :isError="$errors->has('customer.first_name')"
                                class="w-full h-16 px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs shadow-transparent outline-0 transition"
                            />

                            @error('customer.first_name')
                                <x-forms.error>
                                    {{ $message }}
                                </x-forms.error>
                            @enderror

                            <x-forms.text-input
                                name="customer[last_name]"
                                value="{{ old('customer.last_name') }}"
                                placeholder="Last name"
                                :isError="$errors->has('customer.last_name')"
                                class="w-full h-16 px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs shadow-transparent outline-0 transition"
                            />

                            @error('customer.last_name')
                                <x-forms.error>
                                    {{ $message }}
                                </x-forms.error>
                            @enderror

                            <x-forms.text-input
                                name="customer[email]"
                                type="email"
                                value="{{ old('customer.email') }}"
                                placeholder="Email"
                                :isError="$errors->has('customer.email')"
                                class="w-full h-16 px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs shadow-transparent outline-0 transition"
                            />

                            @error('customer.email')
                                <x-forms.error>
                                    {{ $message }}
                                </x-forms.error>
                            @enderror

                            <x-forms.text-input
                                name="customer[phone]"
                                value="{{ old('customer.phone') }}"
                                placeholder="Phone"
                                :isError="$errors->has('customer.phone')"
                                class="w-full h-16 px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs shadow-transparent outline-0 transition"
                            />

                            @error('customer.phone')
                            <x-forms.error>
                                {{ $message }}
                            </x-forms.error>
                            @enderror

                            @guest
                                <div x-data="{ createAccount: {{ old('create_account') ? 'true' : 'false' }} }">
                                    <div class="py-3 text-body">You can create an account after placing your order</div>
                                    <div class="form-checkbox">
                                        <input
                                            name="create_account"
                                            type="checkbox"
                                            id="checkout-create-account"
                                            @checked(old('create_account'))
                                        >
                                        <label for="checkout-create-account" class="form-checkbox-label" @click="createAccount = ! createAccount">Register</label>
                                    </div>
                                    <div
                                        x-show="createAccount"
                                        x-transition:enter="ease-out duration-300"
                                        x-transition:enter-start="opacity-0"
                                        x-transition:enter-end="opacity-100"
                                        x-transition:leave="ease-in duration-150"
                                        x-transition:leave-start="opacity-100"
                                        x-transition:leave-end="opacity-0"
                                        class="mt-4 space-y-3"
                                    >
                                        <x-forms.text-input
                                            name="password"
                                            type="password"
                                            placeholder="Password"
                                            :isError="$errors->has('password')"
                                            class="w-full h-16 px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs shadow-transparent outline-0 transition"
                                        />

                                        @error('password')
                                        <x-forms.error>
                                            {{ $message }}
                                        </x-forms.error>
                                        @enderror

                                        <x-forms.text-input
                                            name="password-confirmation"
                                            type="password"
                                            placeholder="Confirm password"
                                            :isError="$errors->has('password_confirmation')"
                                            class="w-full h-16 px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs shadow-transparent outline-0 transition"
                                        />

                                        @error('password_confirmation')
                                        <x-forms.error>
                                            {{ $message }}
                                        </x-forms.error>
                                        @enderror

                                    </div>
                                </div>
                            @endguest

                        </div>
                    </div>

                    <!-- Shipping & Payment -->
                    <div class="space-y-6 2xl:space-y-8">

                        <!-- Shipping-->
                        <div class="p-6 2xl:p-8 rounded-[20px] bg-card">
                            <h3 class="mb-6 text-md 2xl:text-lg font-bold">Delivery method</h3>
                            <div class="space-y-5">
                                @foreach($deliveries as $delivery)
                                    <div class="form-radio">
                                        <input
                                            type="radio"
                                            name="delivery_method_id"
                                            value="{{ $delivery->id }}"
                                            id="delivery-method-{{ $delivery->id }}"
                                            @checked($loop->first || old('delivery_method_id') === (string) $delivery->id)
                                        >
                                        <label for="delivery-method-{{ $delivery->id }}" class="form-radio-label">
                                            {{ $delivery->title }}
                                        </label>
                                    </div>

                                    @if ($delivery->with_address)

                                        <x-forms.text-input
                                            name="customer[city]"
                                            value="{{ old('customer.city') }}"
                                            placeholder="City"
                                            :isError="$errors->has('customer.city')"
                                            class="w-full h-16 px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs shadow-transparent outline-0 transition"
                                        />

                                        @error('customer.city')
                                        <x-forms.error>
                                            {{ $message }}
                                        </x-forms.error>
                                        @enderror

                                        <x-forms.text-input
                                            name="customer[address]"
                                            value="{{ old('customer.address') }}"
                                            placeholder="Address"
                                            :isError="$errors->has('customer.address')"
                                            class="w-full h-16 px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs shadow-transparent outline-0 transition"
                                        />

                                        @error('customer.address')
                                        <x-forms.error>
                                            {{ $message }}
                                        </x-forms.error>
                                        @enderror

                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <!-- Payment-->
                        <div class="p-6 2xl:p-8 rounded-[20px] bg-card">
                            <h3 class="mb-6 text-md 2xl:text-lg font-bold">Payment method</h3>
                            <div class="space-y-5">
                                @foreach($payments as $payment)
                                    <div class="form-radio">
                                        <input
                                            type="radio"
                                            name="payment_method_id"
                                            value="{{ $payment->id }}"
                                            id="payment-method-{{ $payment->id }}"
                                            @checked($loop->first || old('payment_method_id') === (string) $payment->id)
                                        >
                                        <label for="payment-method-{{ $payment->id }}" class="form-radio-label">
                                            {{ $payment->title }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>

                    <!-- Checkout -->
                    <div class="p-6 2xl:p-8 rounded-[20px] bg-card">
                        <h3 class="mb-6 text-md 2xl:text-lg font-bold">Order</h3>
                        <table class="w-full border-spacing-y-3 text-body text-xxs text-left" style="border-collapse: separate">
                            <thead class="text-[12px] text-body uppercase">
                            <th scope="col" class="pb-2 border-b border-body/60">Product</th>
                            <th scope="col" class="px-2 pb-2 border-b border-body/60">Qty</th>
                            <th scope="col" class="px-2 pb-2 border-b border-body/60">Sum</th>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td scope="row" class="pb-3 border-b border-body/10">
                                        <h4 class="font-bold">
                                            <a href="{{ route('product', $item->product) }}" class="inline-block text-white hover:text-pink break-words pr-3">
                                                {{ $item->product->title }}
                                            </a>
                                        </h4>
                                        @if($item->optionValues)
                                            <ul>
                                                @foreach($item->optionValues as $value)
                                                    <li class="text-body">
                                                        {{ $value->option->title }}: {{ $value->title }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif

                                    </td>
                                    <td class="px-2 pb-3 border-b border-body/20 whitespace-nowrap">
                                        {{ $item->quantity }} pcs.
                                    </td>
                                    <td class="px-2 pb-3 border-b border-body/20 whitespace-nowrap">
                                        {{ $item->amount }}
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        <div class="text-xs font-semibold text-right">Total: {{ cart()->amount() }}</div>

                        <div class="mt-8 space-y-8">

                            <!-- Summary -->
                            <table class="w-full text-left">
                                <tbody>
                                <tr>
                                    <th scope="row" class="pb-2 text-xs font-medium">Delivery:</th>
                                    <td class="pb-2 text-xs"></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-md 2xl:text-lg font-black">Total:</th>
                                    <td class="text-md 2xl:text-lg font-black">{{ cart()->amount() }}</td>
                                </tr>
                                </tbody>
                            </table>

                            <!-- Process to checkout -->
                            <button type="submit" class="w-full btn btn-pink">Place an order</button>
                        </div>
                    </div>

                </form>
            </section>

        </div>
    </main>

@endsection
