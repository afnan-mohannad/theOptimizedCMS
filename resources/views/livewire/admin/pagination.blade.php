@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled page-item" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <a href="#" class="page-link">
                        <i class="previous"></i>
                    </a>
                </li>
            @else
                <li class="page-item">
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')" class="page-link">
                        <i class="previous"></i>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled page-item px-3" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active page-item" aria-current="page">
                                <a class="page-link page_change">{{ $page }}</a>
                            </li>
                        @else
                            <li class="page-item"> 
                                <a class="page-link page_change" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"><i class="next"></i></a>
                </li>
            @else
                <li class="disabled page-item" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <a href="#" class="page-link"><i class="next"></i></a>
                </li>
            @endif
        </ul>
    </nav>
@endif
