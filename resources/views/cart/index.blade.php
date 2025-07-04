@extends('layouts.app')

@section('title', 'Cart')

@section('content')

    <main class="py-16 lg:py-20">
        <div class="container">

            <!-- Breadcrumbs -->
            <ul class="breadcrumbs flex flex-wrap gap-y-1 gap-x-4 mb-6">
                <li><a href="{{ route('home') }}" class="text-body hover:text-pink text-xs">Home</a></li>
                <li><span class="text-body text-xs">Cart</span></li>
            </ul>

            <section>

                <h1 class="mb-8 text-lg lg:text-[42px] font-black">Shopping cart</h1>

                @if($items->isEmpty())
                    <div class="py-3 px-6 rounded-lg bg-pink text-white">Cart is empty</div>
                @else
                    <div class="overflow-auto">
                        <table class="min-w-full border-spacing-y-4 text-white text-sm text-left"
                               style="border-collapse: separate">
                            <thead class="text-xs uppercase">
                            <th scope="col" class="py-3 px-6">Product</th>
                            <th scope="col" class="py-3 px-6">Price</th>
                            <th scope="col" class="py-3 px-6">Qty</th>
                            <th scope="col" class="py-3 px-6">Sum</th>
                            <th scope="col" class="py-3 px-6"></th>
                            </thead>
                            @foreach($items as $item)
                                <tbody>
                                    <tr>
                                        <td scope="row" class="py-4 px-4 md:px-6 rounded-l-2xl bg-card">
                                            <div class="flex flex-col lg:flex-row min-w-[200px] gap-2 lg:gap-6">
                                                <div
                                                    class="shrink-0 overflow-hidden w-[64px] lg:w-[84px] h-[64px] lg:h-[84px] rounded-2xl">
                                                    <img src="{{ $item->product->makeThumbnail('345x320') }}" class="object-cover w-full h-full"
                                                         alt="{{ $item->product->title }}">
                                                </div>
                                                <div class="py-3">
                                                    <h4 class="text-xs sm:text-sm xl:text-md font-bold">
                                                        <a href="{{ route('product', $item->product->slug) }}" class="inline-block text-white hover:text-pink">
                                                            {{ $item->product->title }}
                                                        </a>
                                                    </h4>
                                                    @if($item->optionValues->isNotEmpty())
                                                        <ul class="space-y-1 mt-2 text-xs">
                                                            @foreach($item->optionValues as $value)
                                                                <li class="text-body">
                                                                    {{ $value->option->title }}: {{ $value->title }}
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4 md:px-6 bg-card">
                                            <div class="font-medium whitespace-nowrap">{{ $item->price }}</div>
                                        </td>
                                        <td class="py-4 px-4 md:px-6 bg-card">
                                            <div class="flex items-stretch h-[56px] gap-2">
                                                <form action="{{ route('cart.quantity', $item) }}" method="POST">
                                                    @csrf

                                                    <button type="button" class="w-12 h-full rounded-lg border border-body/10 hover:bg-card/20 active:bg-card/50 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs text-center font-bold shadow-transparent outline-0 transition">-</button>
                                                    <input name="quantity" type="number" class="h-full px-2 lg:px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs text-center font-bold shadow-transparent outline-0 transition" min="1" max="999" value="{{ $item->quantity }}" placeholder="Qty">
                                                    <button type="button" class="w-12 h-full rounded-lg border border-body/10 hover:bg-card/20 active:bg-card/50 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs text-center font-bold shadow-transparent outline-0 transition">+</button>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4 md:px-6 bg-card">
                                            <div class="font-medium whitespace-nowrap">{{ $item->amount }}</div>
                                        </td>
                                        <td class="py-4 px-4 md:px-6 rounded-r-2xl bg-card">
                                            <form action="{{ route('cart.delete', $item) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="w-12 !h-12 !px-0 btn btn-pink" title="Delete from cart">
                                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                         viewBox="0 0 52 52">
                                                        <path d="M49.327 7.857H2.673a2.592 2.592 0 0 0 0 5.184h5.184v31.102a7.778 7.778 0 0 0 7.776 7.776h20.735a7.778 7.778 0 0 0 7.775-7.776V13.041h5.184a2.592 2.592 0 0 0 0-5.184Zm-25.919 28.51a2.592 2.592 0 0 1-5.184 0V23.409a2.592 2.592 0 1 1 5.184 0v12.96Zm10.368 0a2.592 2.592 0 0 1-5.184 0V23.409a2.592 2.592 0 1 1 5.184 0v12.96ZM20.817 5.265h10.367a2.592 2.592 0 0 0 0-5.184H20.817a2.592 2.592 0 1 0 0 5.184Z"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            @endforeach
                        </table>
                    </div>

                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mt-8">
                        <div class="text-[32px] font-black">Total: {{ cart()->amount() }}</div>
                        <div class="pb-3 lg:pb-0">
                            <form action="{{ route('cart.truncate') }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="text-body hover:text-pink font-medium">
                                    Clear cart
                                </button>
                            </form>
                        </div>
                        <div class="flex flex-col sm:flex-row lg:justify-end gap-4">
                            <a href="{{ route('catalog') }}" class="btn btn-pink">Product catalog</a>
                            <a href="{{ route('order') }}" class="btn btn-purple">Place an order</a>
                        </div>
                    </div>
                @endif

            </section>

        </div>
    </main>

@endsection
