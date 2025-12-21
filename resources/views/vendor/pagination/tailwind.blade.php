@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-end">
        <span class="inline-flex rounded-md shadow-sm">

            {{-- Previous Page --}}
            @if ($paginator->onFirstPage())
                <span class="inline-flex items-center px-3 py-2 text-sm text-gray-400 bg-white border border-gray-300 cursor-not-allowed rounded-l-md">
                    ‹
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                   class="inline-flex items-center px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-l-md hover:bg-gray-100">
                    ‹
                </a>
            @endif

            {{-- Page Numbers --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="inline-flex items-center px-3 py-2 text-sm text-gray-500 bg-white border border-gray-300">
                        {{ $element }}
                    </span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="inline-flex items-center px-3 py-2 text-sm font-semibold text-white bg-orange-600 border border-orange-600">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                               class="inline-flex items-center px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 hover:bg-gray-100">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                   class="inline-flex items-center px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-r-md hover:bg-gray-100">
                    ›
                </a>
            @else
                <span class="inline-flex items-center px-3 py-2 text-sm text-gray-400 bg-white border border-gray-300 cursor-not-allowed rounded-r-md">
                    ›
                </span>
            @endif

        </span>
    </nav>
@endif
