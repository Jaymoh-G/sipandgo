@if ($paginator->hasPages())
    <ul class="pagination flex-center flex-wrap gap-16">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="Previous">
                <span class="page-link h-64 w-64 flex-center text-xxl rounded-8 fw-medium text-neutral-400 border border-gray-100">
                    <i class="ph-bold ph-arrow-left"></i>
                </span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link h-64 w-64 flex-center text-xxl rounded-8 fw-medium text-neutral-600 border border-gray-100" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Previous">
                    <i class="ph-bold ph-arrow-left"></i>
                </a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled" aria-disabled="true"><span class="page-link h-64 w-64 flex-center text-md rounded-8 fw-medium text-neutral-400 border border-gray-100">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active" aria-current="page"><span class="page-link h-64 w-64 flex-center text-md rounded-8 fw-medium text-white bg-main-600 border border-main-600">{{ str_pad($page, 2, '0', STR_PAD_LEFT) }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link h-64 w-64 flex-center text-md rounded-8 fw-medium text-neutral-600 border border-gray-100" href="{{ $url }}">{{ str_pad($page, 2, '0', STR_PAD_LEFT) }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link h-64 w-64 flex-center text-xxl rounded-8 fw-medium text-neutral-600 border border-gray-100" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next">
                    <i class="ph-bold ph-arrow-right"></i>
                </a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true" aria-label="Next">
                <span class="page-link h-64 w-64 flex-center text-xxl rounded-8 fw-medium text-neutral-400 border border-gray-100">
                    <i class="ph-bold ph-arrow-right"></i>
                </span>
            </li>
        @endif
    </ul>
@endif


