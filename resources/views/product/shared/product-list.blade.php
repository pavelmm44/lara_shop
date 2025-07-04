<!-- Product card -->
<div class="product-card flex flex-col md:flex-row rounded-3xl bg-card">
    <a href="{{ route('product', ['product' => $item->slug]) }}" class="product-card-photo overflow-hidden shrink-0 md:w-[260px] xl:w-[320px] h-[320px] md:h-full rounded-3xl">
        <img src="{{ $item->makeThumbnail('345x320') }}" class="object-cover w-full h-full" alt="{{ $item->title }}">
    </a>
    <div class="grow flex flex-col py-8 px-6 md:px-8">
        <h3 class="text-sm lg:text-md font-black">
            <a href="{{ route('product', ['product' => $item->slug]) }}" class="inline-block text-white hover:text-pink">
                {{ $item->title }}
            </a>
        </h3>
        @if($item->json_properties)
            <ul class="space-y-1 mt-4 text-xxs">
                @foreach($item->json_properties as $title => $value)
                    <li class="flex justify-between text-body"><strong>{{ $title }}:</strong> {{ $value }}</li>
                @endforeach
            </ul>
        @endif
        <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-6 mt-6">
            <div class="flex items-baseline gap-4">
                <div class="text-pink text-md xl:text-lg font-black">{{ $item->price }}</div>
                <div class="text-body text-sm xl:text-md font-semibold line-through">59 300 ₽</div>
            </div>
            <div class="flex flex-wrap items-center gap-4">
                <a href="#" class="w-[56px] !h-[56px] !px-0 btn btn-pink">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 52 52">
                        <path d="M39.385 38.663a6.047 6.047 0 1 0 6.041 6.053v-.006a6.053 6.053 0 0 0-6.041-6.047ZM50.11 9.706a2.329 2.329 0 0 0-.439-.042H12.852l-.583-3.902a5.248 5.248 0 0 0-5.196-4.519h-4.74a2.332 2.332 0 1 0 0 4.665h4.746a.583.583 0 0 1 .583.513l3.592 24.62a6.45 6.45 0 0 0 6.35 5.447H41.87a6.414 6.414 0 0 0 6.292-5.126l3.796-18.923a2.333 2.333 0 0 0-1.847-2.733ZM24.571 44.45a6.047 6.047 0 0 0-6.062-5.782 6.047 6.047 0 0 0 .14 12.089h.146a6.047 6.047 0 0 0 5.776-6.306Z"/>
                    </svg>
                </a>
                <a href="#" class="w-[56px] !h-[56px] !px-0 btn btn-purple" title="Удалить из избранного">
                    <!-- <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 52 52">
                        <path d="M26 48.486c-.263 0-.526-.067-.762-.203-.255-.148-6.336-3.679-12.504-8.998-3.656-3.153-6.574-6.28-8.673-9.295C1.344 26.09-.022 22.338 0 18.84c.025-4.072 1.483-7.901 4.106-10.782 2.667-2.93 6.226-4.544 10.021-4.544 4.865 0 9.312 2.725 11.872 7.042 2.56-4.317 7.007-7.042 11.872-7.042 3.586 0 7.007 1.456 9.634 4.1 2.883 2.9 4.52 7 4.494 11.245-.022 3.493-1.414 7.24-4.137 11.134-2.105 3.013-5.02 6.14-8.66 9.291-6.146 5.32-12.183 8.85-12.437 8.997a1.524 1.524 0 0 1-.766.206ZM14.128 6.56c-2.927 0-5.686 1.26-7.768 3.548-2.115 2.324-3.292 5.431-3.313 8.75-.042 6.606 6.308 13.483 11.642 18.09 4.712 4.068 9.49 7.123 11.308 8.236 1.808-1.115 6.554-4.168 11.246-8.235 5.319-4.61 11.668-11.493 11.71-18.11.022-3.44-1.294-6.749-3.608-9.079-2.05-2.063-4.705-3.2-7.473-3.2-4.658 0-8.847 3.276-10.422 8.152a1.523 1.523 0 0 1-2.9 0C22.976 9.836 18.787 6.56 14.129 6.56Z"/>
                    </svg> -->
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 52 52">
                        <path d="M26 48.486c-.263 0-.526-.067-.762-.203-.255-.148-6.336-3.679-12.504-8.998-3.656-3.153-6.574-6.28-8.673-9.295C1.344 26.09-.022 22.338 0 18.84c.025-4.072 1.483-7.901 4.106-10.782 2.667-2.93 6.226-4.544 10.021-4.544 4.865 0 9.312 2.725 11.872 7.042 2.56-4.317 7.007-7.042 11.872-7.042 3.586 0 7.007 1.456 9.634 4.1 2.883 2.9 4.52 7 4.494 11.245-.022 3.493-1.414 7.24-4.137 11.135-2.105 3.012-5.02 6.138-8.66 9.29-6.146 5.32-12.183 8.85-12.437 8.997a1.524 1.524 0 0 1-.766.206Z"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div><!-- /.product-card -->
