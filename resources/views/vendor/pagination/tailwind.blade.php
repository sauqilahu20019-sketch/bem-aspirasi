@if ($paginator->hasPages())
    <nav
        role="navigation"
        aria-label="Pagination Navigation"
        class="flex flex-col items-center justify-between space-y-4 sm:flex-row sm:space-y-0"
    >
        {{-- Mobile Pagination --}}
        <div class="flex justify-between w-full sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="relative inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-md cursor-default bg-gray-100 text-gray-400 dark:bg-gray-800 dark:text-gray-500 border border-gray-200 dark:border-gray-700">
                    @lang('pagination.previous')
                </span>
            @else
                <button
                    wire:click="previousPage"
                    wire:loading.attr="disabled"
                    rel="prev"
                    class="relative inline-flex items-center px-3 py-1.5 text-xs font-medium transition duration-150 ease-in-out rounded-md hover:bg-gray-50 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 bg-white text-gray-700 border border-gray-300 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-700 dark:hover:bg-gray-700"
                >
                    @lang('pagination.previous')
                </button>
            @endif

            @if ($paginator->hasMorePages())
                <button
                    wire:click="nextPage"
                    wire:loading.attr="disabled"
                    rel="next"
                    class="relative inline-flex items-center px-3 py-1.5 ml-3 text-xs font-medium transition duration-150 ease-in-out rounded-md hover:bg-gray-50 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 bg-white text-gray-700 border border-gray-300 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-700 dark:hover:bg-gray-700"
                >
                    @lang('pagination.next')
                </button>
            @else
                <span class="relative inline-flex items-center px-3 py-1.5 ml-3 text-xs font-medium rounded-md cursor-default bg-gray-100 text-gray-400 dark:bg-gray-800 dark:text-gray-500 border border-gray-200 dark:border-gray-700">
                    @lang('pagination.next')
                </span>
            @endif
        </div>

        {{-- Desktop Pagination --}}
        <div class="hidden w-full sm:flex sm:flex-1 sm:items-center sm:justify-between">
            <div>
                <p class="text-xs text-gray-700 dark:text-gray-300">
                    Showing
                    <span class="font-medium">{{ $paginator->firstItem() }}</span>
                    to
                    <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    of
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    results
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex shadow-sm rounded-md">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span
                            aria-disabled="true"
                            aria-label="@lang('pagination.previous')"
                            class="relative inline-flex items-center px-2 py-1.5 text-xs font-medium rounded-l-md cursor-default bg-gray-100 text-gray-400 dark:bg-gray-800 dark:text-gray-500 border border-gray-200 dark:border-gray-700"
                        >
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    @else
                        <button
                            wire:click="previousPage"
                            wire:loading.attr="disabled"
                            rel="prev"
                            aria-label="@lang('pagination.previous')"
                            class="relative inline-flex items-center px-2 py-1.5 text-xs font-medium transition duration-150 ease-in-out rounded-l-md hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 bg-white text-gray-500 border border-gray-300 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-700 dark:hover:bg-gray-700"
                        >
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    @endif

                    {{-- Pagination Elements --}}
                    @php
                        $current = $paginator->currentPage();
                        $last = $paginator->lastPage();
                        $maxVisible = 4; // Jumlah maksimal nomor yang ditampilkan
                        $half = floor($maxVisible / 2);
                        $start = max($current - $half, 1);
                        $end = min($start + $maxVisible - 1, $last);

                        // Adjust start if we're at the end
                        if ($end - $start + 1 < $maxVisible) {
                            $start = max($end - $maxVisible + 1, 1);
                        }
                    @endphp

                    {{-- Always show first page --}}
                    @if ($start > 1)
                        <button
                            wire:click="gotoPage(1)"
                            aria-label="{{ __('Go to page :page', ['page' => 1]) }}"
                            class="relative inline-flex items-center px-3 py-1.5 -ml-px text-xs font-medium transition duration-150 ease-in-out border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-700 dark:hover:bg-gray-700"
                        >
                            1
                        </button>
                        @if ($start > 2)
                            <span
                                aria-disabled="true"
                                class="relative inline-flex items-center px-3 py-1.5 -ml-px text-xs font-medium text-gray-700 bg-white border border-gray-300 cursor-default dark:bg-gray-800 dark:text-gray-300 dark:border-gray-700"
                            >
                                ...
                            </span>
                        @endif
                    @endif

                    {{-- Visible pages --}}
                    @for ($page = $start; $page <= $end; $page++)
                        @if ($page == $current)
                            <span
                                aria-current="page"
                                class="relative inline-flex items-center px-3 py-1.5 -ml-px text-xs font-medium border border-indigo-500 bg-indigo-500 text-white dark:bg-indigo-600 dark:border-indigo-600"
                            >
                                {{ $page }}
                            </span>
                        @else
                            <button
                                wire:click="gotoPage({{ $page }})"
                                aria-label="{{ __('Go to page :page', ['page' => $page]) }}"
                                class="relative inline-flex items-center px-3 py-1.5 -ml-px text-xs font-medium transition duration-150 ease-in-out border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-700 dark:hover:bg-gray-700"
                            >
                                {{ $page }}
                            </button>
                        @endif
                    @endfor

                    {{-- Always show last page if not in visible range --}}
                    @if ($end < $last)
                        @if ($end < $last - 1)
                            <span
                                aria-disabled="true"
                                class="relative inline-flex items-center px-3 py-1.5 -ml-px text-xs font-medium text-gray-700 bg-white border border-gray-300 cursor-default dark:bg-gray-800 dark:text-gray-300 dark:border-gray-700"
                            >
                                ...
                            </span>
                        @endif
                        <button
                            wire:click="gotoPage({{ $last }})"
                            aria-label="{{ __('Go to page :page', ['page' => $last]) }}"
                            class="relative inline-flex items-center px-3 py-1.5 -ml-px text-xs font-medium transition duration-150 ease-in-out border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-700 dark:hover:bg-gray-700"
                        >
                            {{ $last }}
                        </button>
                    @endif

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <button
                            wire:click="nextPage"
                            wire:loading.attr="disabled"
                            rel="next"
                            aria-label="@lang('pagination.next')"
                            class="relative inline-flex items-center px-2 py-1.5 -ml-px text-xs font-medium transition duration-150 ease-in-out rounded-r-md hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 bg-white text-gray-500 border border-gray-300 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-700 dark:hover:bg-gray-700"
                        >
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    @else
                        <span
                            aria-disabled="true"
                            aria-label="@lang('pagination.next')"
                            class="relative inline-flex items-center px-2 py-1.5 -ml-px text-xs font-medium rounded-r-md cursor-default bg-gray-100 text-gray-400 dark:bg-gray-800 dark:text-gray-500 border border-gray-200 dark:border-gray-700"
                        >
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
