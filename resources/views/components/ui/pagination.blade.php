@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
        <div class="flex justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="relative inline-flex items-center px-4 py-2 text-sm font-bold text-gray-400 bg-gray-50 border border-gray-100 cursor-default rounded-xl">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 bg-white border border-gray-100 rounded-lg hover:bg-gray-50 transition-all">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-semibold text-gray-700 bg-white border border-gray-100 rounded-lg hover:bg-gray-50 transition-all">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-semibold text-gray-400 bg-gray-50 border border-gray-100 cursor-default rounded-lg">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div>

        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-xs font-medium text-gray-500">
                    <span class="text-gray-900 font-bold">{{ $paginator->firstItem() }}-{{ $paginator->lastItem() }}</span>
                    <span class="mx-1 text-gray-400">dari</span>
                    <span class="text-gray-900 font-bold">{{ $paginator->total() }}</span>
                    <span class="ml-0.5 text-gray-400">data</span>
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex rounded-lg overflow-hidden border border-gray-100">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <span class="relative inline-flex items-center px-3 py-2 bg-gray-50 text-gray-300 cursor-default" aria-hidden="true">
                                <i data-lucide="chevron-left" class="w-4 h-4"></i>
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-3 py-2 bg-white text-gray-500 hover:bg-gray-50 transition-colors" aria-label="{{ __('pagination.previous') }}">
                            <i data-lucide="chevron-left" class="w-4 h-4"></i>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="relative inline-flex items-center px-4 py-2 bg-white text-gray-700 text-xs font-bold">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span class="relative inline-flex items-center px-4 py-2 bg-[#1B3A6B] text-white text-xs font-bold z-10">{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 bg-white text-gray-600 hover:bg-gray-50 text-xs font-bold transition-all" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-3 py-2 bg-white text-gray-500 hover:bg-gray-50 transition-colors" aria-label="{{ __('pagination.next') }}">
                            <i data-lucide="chevron-right" class="w-4 h-4"></i>
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                            <span class="relative inline-flex items-center px-3 py-2 bg-gray-50 text-gray-300 cursor-default" aria-hidden="true">
                                <i data-lucide="chevron-right" class="w-4 h-4"></i>
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
