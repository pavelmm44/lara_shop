@extends('layouts.app')

@section('content')
    <section>
        <!-- Section heading -->
        <h2 class="text-lg lg:text-[42px] font-black">Our advantages</h2>

        <!-- Advantages -->
        <div class="grid grid-cols-1 sm:grid-cols-2 2xl:grid-cols-4 gap-3 sm:gap-4 md:gap-6 mt-8">
            <div class="flex flex-col items-center gap-2 py-6 md:py-8 px-4 md:px-6 rounded-xl bg-purple text-white text-center">
                <svg class="w-10 md:w-12 h-10 md:h-12 opacity-40" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                    <path fill-rule="evenodd" d="M1.302 2.65H11.64c.292 0 .528.236.528.527v1.056h3.007c.33 0 .62.218.71.536l.905 3.166c.106.019.205.07.282.147l.747.746a.528.528 0 0 1 .154.373v3.476a.528.528 0 0 1-.527.528H15.86a2.111 2.111 0 0 1-4.222 0H6.361a2.111 2.111 0 0 1-4.222 0H.556a.528.528 0 0 1-.528-.528V3.924a.53.53 0 0 1 .155-.374l.746-.746a.528.528 0 0 1 .373-.155ZM15.69 7.926l-.754-2.639h-2.768V7.4c0 .292.236.528.528.528h2.994Zm-1.94 4.224a1.056 1.056 0 1 1 0 2.111 1.056 1.056 0 0 1 0-2.11ZM3.195 13.205a1.055 1.055 0 1 0 2.11 0 1.055 1.055 0 0 0-2.11 0Z" clip-rule="evenodd"/>
                </svg>
                <h5 class="pt-2 md:pt-4 text-sm md:text-md font-bold">Free shipping</h5>
                <div class="text-xs md:text-sm">from 30 $</div>
            </div>
            <div class="flex flex-col items-center gap-2 py-6 md:py-8 px-4 md:px-6 rounded-xl bg-purple text-white text-center">
                <svg class="w-10 md:w-12 h-10 md:h-12 opacity-40" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                    <path d="M9 0a3.6 3.6 0 0 0-3.6 3.6v.6h-.498A1.962 1.962 0 0 0 2.94 6.072l-.474 9.87A1.968 1.968 0 0 0 4.428 18h9.144a1.969 1.969 0 0 0 1.962-2.058l-.474-9.87A1.961 1.961 0 0 0 13.098 4.2H12.6v-.6A3.6 3.6 0 0 0 9 0ZM6.6 3.6a2.4 2.4 0 1 1 4.8 0v.6H6.6v-.6Zm-.984 3.114a.6.6 0 1 1 1.2 0 .6.6 0 0 1-1.2 0Zm5.568 0a.6.6 0 1 1 1.2 0 .6.6 0 0 1-1.2 0Z"/>
                </svg>
                <h5 class="pt-2 md:pt-4 text-sm md:text-md font-bold">Safe shopping</h5>
                <div class="text-xs md:text-sm">100% guarantee</div>
            </div>
            <div class="flex flex-col items-center gap-2 py-6 md:py-8 px-4 md:px-6 rounded-xl bg-purple text-white text-center">
                <svg class="w-10 md:w-12 h-10 md:h-12 opacity-40" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                    <path d="M17.953 6.905a.955.955 0 0 0-.823-.658l-5.196-.471L9.88.967a.957.957 0 0 0-1.76.001L6.066 5.776.87 6.247a.957.957 0 0 0-.543 1.674l3.927 3.445-1.158 5.1A.956.956 0 0 0 4.519 17.5L9 14.822l4.48 2.678a.957.957 0 0 0 1.424-1.034l-1.159-5.1 3.928-3.444a.957.957 0 0 0 .28-1.017Z"/>
                </svg>
                <h5 class="pt-2 md:pt-4 text-sm md:text-md font-bold">We work for the client</h5>
                <div class="text-xs md:text-sm">100% positive feedback</div>
            </div>
            <div class="flex flex-col items-center gap-2 py-6 md:py-8 px-4 md:px-6 rounded-xl bg-purple text-white text-center">
                <svg class="w-10 md:w-12 h-10 md:h-12 opacity-40" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                    <path fill-rule="evenodd" d="M0 2.572C0 1.507.863.643 1.929.643H16.07c1.067 0 1.93.864 1.93 1.929v10.285a1.928 1.928 0 0 1-1.929 1.929h-6.89l-4.023 2.476a.643.643 0 0 1-.98-.547v-1.93h-2.25A1.929 1.929 0 0 1 0 12.858V2.572Zm5.143 3.857a1.286 1.286 0 1 0 0 2.571 1.286 1.286 0 0 0 0-2.571Zm2.571 1.285a1.286 1.286 0 1 1 2.572 0 1.286 1.286 0 0 1-2.572 0Zm5.143-1.285a1.286 1.286 0 1 0 0 2.571 1.286 1.286 0 0 0 0-2.571Z" clip-rule="evenodd"/>
                </svg>
                <h5 class="pt-2 md:pt-4 text-sm md:text-md font-bold">Support</h5>
                <div class="text-xs md:text-sm">online chat 24/7</div>
            </div>
        </div>
    </section>

    <section class="mt-16 lg:mt-24">
        <!-- Section heading -->
        <h2 class="text-lg lg:text-[42px] font-black">Categories</h2>

        <!-- Categories -->
        <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-5 gap-3 sm:gap-4 md:gap-5 mt-8">
            @each('catalog.shared.category', $categories, 'item')
        </div>
    </section>

    <section class="mt-16 lg:mt-24">
        <!-- Section heading -->
        <h2 class="text-lg lg:text-[42px] font-black">Products</h2>

        <!-- Products list -->
        <div class="products grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-x-8 gap-y-8 lg:gap-y-10 2xl:gap-y-12 mt-8">
            @each('catalog.shared.product', $products, 'item')
        </div>

        <div class="mt-12 text-center">
            <a href="#" class="btn btn-purple">All products &nbsp;→</a>
        </div>
    </section>

    <section class="mt-20">
        <!-- Section heading -->
        <h2 class="text-lg lg:text-[42px] font-black">Brands</h2>

        <!-- Brands list -->
        <div class="grid grid-cols-2 md:grid-cols-3 2xl:grid-cols-6 gap-4 md:gap-8 mt-12">
            @each('catalog.shared.brand', $brands, 'item')
        </div>
    </section>
@endsection
