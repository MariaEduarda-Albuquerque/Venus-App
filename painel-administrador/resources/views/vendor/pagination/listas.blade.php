@if ($paginator->hasPages())
    <nav class="lst-pag" role="navigation" aria-label="Paginação">
        
        @if ($paginator->onFirstPage())
            <span class="lst-pag-item is-disabled" aria-disabled="true"><i data-lucide="chevron-left"></i></span>
        @else
            <a class="lst-pag-item" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Anterior"><i data-lucide="chevron-left"></i></a>
        @endif
  
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="lst-pag-item is-disabled">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="lst-pag-item is-active" aria-current="page">{{ $page }}</span>
                    @else
                        <a class="lst-pag-item" href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a class="lst-pag-item" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Próxima"><i data-lucide="chevron-right"></i></a>
        @else
            <span class="lst-pag-item is-disabled" aria-disabled="true"><i data-lucide="chevron-right"></i></span>
        @endif
    </nav>
@endif