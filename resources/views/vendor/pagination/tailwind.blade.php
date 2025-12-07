@if ($paginator->hasPages())
    <nav role="navigation" class="flex justify-center mt-6" aria-label="Pagination Navigation">
        <div class="inline-flex items-center gap-4 bg-white px-4 py-2 rounded-full shadow border border-gray-200">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="text-gray-400 cursor-not-allowed">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
                         d="M15 19l-7-7 7-7"/></svg>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="text-[#016DAE] hover:text-[#00ADE5] transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
                         d="M15 19l-7-7 7-7"/></svg>
                </a>
            @endif

            {{-- Page Info --}}
            <span class="text-sm font-semibold text-gray-800">
                {{ $paginator->currentPage() }} dari {{ $paginator->lastPage() }}
            </span>

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="text-[#016DAE] hover:text-[#00ADE5] transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
                         d="M9 5l7 7-7 7"/></svg>
                </a>
            @else
                <span class="text-gray-400 cursor-not-allowed">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
                         d="M9 5l7 7-7 7"/></svg>
                </span>
            @endif
        </div>
    </nav>
@endif
