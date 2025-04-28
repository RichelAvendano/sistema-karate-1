@if ($paginator->hasPages())
<div style="display: flex; justify-content: space-between; align-items: center;">
    <!-- Texto de resultados -->
    <div style="font-size: 14px; color: #666;">
        Mostrando 
        <span style="font-weight: bold;">{{ $paginator->firstItem() }}</span> - 
        <span style="font-weight: bold;">{{ $paginator->lastItem() }}</span> de 
        <span style="font-weight: bold;">{{ $paginator->total() }}</span> resultados
    </div>

    <!-- Paginador -->
    <ul class="pagination">
        <!-- Flecha izquierda -->
        <li class="{{ $paginator->onFirstPage() ? 'disabled' : '' }}">
            @if($paginator->onFirstPage())
                <span class="demo-pli-arrow-left"></span>
            @else
                <a wire:click="previousPage" wire:loading.attr="disabled" class="demo-pli-arrow-left"></a>
            @endif
        </li>

        @php
            $current = $paginator->currentPage();
            $last = $paginator->lastPage();
            $window = 1; // Páginas alrededor de la actual (1 = muestra 3 páginas en total)
            $showLeftDots = false;
            $showRightDots = false;
            
            if ($last > ($window * 2 + 3)) { // 3 = primera + última + current
                $showLeftDots = $current > ($window + 2);
                $showRightDots = $current < ($last - $window - 1);
            }
        @endphp

        <!-- Primera página -->
        <li class="{{ $current == 1 ? 'active' : '' }}">
            <a wire:click="gotoPage(1)" wire:loading.attr="disabled">1</a>
        </li>

        <!-- Puntos suspensivos izquierdos -->
        @if($showLeftDots)
            <li class="disabled"><span>...</span></li>
        @endif

        <!-- Páginas centrales -->
        @foreach($paginator->getUrlRange(
            max($current - $window, 2),
            min($current + $window, $last - 1)
        ) as $page => $url)
            <li class="{{ $page == $current ? 'active' : '' }}">
                <a wire:click="gotoPage({{ $page }})" wire:loading.attr="disabled">{{ $page }}</a>
            </li>
        @endforeach

        <!-- Puntos suspensivos derechos -->
        @if($showRightDots)
            <li class="disabled"><span>...</span></li>
        @endif

        <!-- Última página (si es diferente de la primera) -->
        @if($last > 1)
            <li class="{{ $current == $last ? 'active' : '' }}">
                <a wire:click="gotoPage({{ $last }})" wire:loading.attr="disabled">{{ $last }}</a>
            </li>
        @endif

        <!-- Flecha derecha -->
        <li class="{{ !$paginator->hasMorePages() ? 'disabled' : '' }}">
            @if(!$paginator->hasMorePages())
                <span class="demo-pli-arrow-right"></span>
            @else
                <a wire:click="nextPage" wire:loading.attr="disabled" class="demo-pli-arrow-right"></a>
            @endif
        </li>
    </ul>
</div>
@endif