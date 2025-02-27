@if ($paginator->hasPages())
    <nav>
        <ul class="flex flex-wrap items-center justify-center gap-3">
            {{-- Previous Page Link --}}
            @if (!$paginator->onFirstPage())
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="previous"
                       class="block p-3 text-white hover:text-pink text-sm font-black leading-none"
                       aria-label="{{ __('pagination.previous') }}">
                        {!! __('pagination.previous') !!}
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="text-body/50 text-sm font-black leading-none" aria-disabled="true">
                        {{ $element }}
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active" aria-current="page">
                                <span
                                    class="block p-3 pointer-events-none text-pink text-sm font-black leading-none">
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}"
                                   class="block p-3 text-white hover:text-pink text-sm font-black leading-none"
                                   aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                   class="block p-3 text-white hover:text-pink text-sm font-black leading-none"
                   aria-label="{{ __('pagination.next') }}">
                    {!! __('pagination.next') !!}
                </a>
            @endif
        </ul>
    </nav>
@endif
