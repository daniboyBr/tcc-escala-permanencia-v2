@if ($paginator->hasPages())
    <nav>
        <ul class="pagination justify-content-end">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                <a class="page-link" aria-hidden="true" href="javascript:void(0)">
                        Anterior  
                    </a>
                </li>
            @else
                <li class="page-item" >
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                       Anterior
                    </a>
                </li>
            @endif

            <li class="page-item">
                <span class="page-link text-muted" style="pointer-events: none;">
                    {{$paginator->currentPage()}} de {{$paginator->lastPage()}} 
                </span>
            </li>

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item" >
                    <a  class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">
                        Próxima
                    </a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <a class="page-link" href="javascript:void(0)" rel="next" aria-label="@lang('pagination.next')">
                        Próxima
                    </a>   
                </li>
            @endif
        </ul>
    </nav>
@endif
