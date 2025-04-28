
@push('styles')
<style>
    .modern-pagination {
        margin: 1.5rem 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .pagination-container {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    .pagination-mobile {
        display: flex;
        justify-content: space-between;
        width: 100%;
    }
    
    .pagination-desktop {
        display: none;
        justify-content: space-between;
        align-items: center;
        width: 100%;
    }
    
    .pagination-buttons {
        display: flex;
        gap: 0.5rem;
    }
    
    .pagination-btn {
        padding: 0.5rem 1rem;
        border-radius: 6px;
        background: rgba(59, 130, 246, 0.1);
        color: #1e40af;
        border: 1px solid rgba(59, 130, 246, 0.3);
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 0.875rem;
    }
    
    .pagination-btn:hover:not(:disabled) {
        background: rgba(59, 130, 246, 0.2);
        transform: translateY(-1px);
    }
    
    .pagination-btn:disabled {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
        border-color: rgba(239, 68, 68, 0.2);
        cursor: not-allowed;
        opacity: 0.7;
    }
    
    .pagination-info {
        font-size: 1.3rem;
        color: #4b5563;
    }
    
    .pagination-info span {
        font-weight: 600;
        color: #1e40af;
    }
    
    .pagination-numbers {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .page-number {
        width: 3rem;
        height: 3rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        background: rgba(255, 255, 255, 0.7);
        color: #1e40af;
        border: 1px solid rgba(59, 130, 246, 0.2);
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 1.3rem;
    }
    
    .page-number:hover {
        background: rgba(59, 130, 246, 0.1);
    }
    
    .page-number.active {
        background: linear-gradient(135deg, rgb(59 130 246 / 51%), rgb(220 38 38 / 43%));
        color: white;
        font-weight: 600;
        border: none;
        box-shadow: 0 2px 4px rgba(59, 130, 246, 0.3);
        cursor: default;
    }
    
    .page-ellipsis {
        width: 2rem;
        height: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6b7280;
    }
    
    @media (min-width: 576px) {
        .pagination-mobile {
            display: none;
        }
        
        .pagination-desktop {
            display: flex;
        }
    }
</style>
@endpush

<div class="modern-pagination">
    @if ($paginator->hasPages())
        <div class="pagination-container">
            {{-- Versión móvil --}}
            <div class="pagination-mobile">
                <div class="pagination-buttons">
                    @if ($paginator->onFirstPage())
                        <button class="pagination-btn" disabled>
                            <i class="fa-solid fa-angles-left"></i> Anterior
                        </button>
                    @else
                        <button class="pagination-btn" 
                                wire:click.prevent="previousPage('{{ $paginator->getPageName() }}')"  
                                wire:loading.attr="disabled">
                            <i class="fa-solid fa-angles-left"></i> Anterior
                        </button>
                    @endif

                    @if ($paginator->hasMorePages())
                        <button class="pagination-btn" 
                                wire:click.prevent="nextPage('{{ $paginator->getPageName() }}')"  
                                wire:loading.attr="disabled">
                            Siguiente <i class="fa-solid fa-angles-right"></i>
                        </button>
                    @else
                        <button class="pagination-btn" disabled>
                            Siguiente <i class="fa-solid fa-angles-right"></i>
                        </button>
                    @endif
                </div>
            </div>

            {{-- Versión desktop --}}
            <div class="pagination-desktop">
                <div class="pagination-info">
                    Mostrando <span>{{ $paginator->firstItem() }}</span> a 
                    <span>{{ $paginator->lastItem() }}</span> de 
                    <span>{{ $paginator->total() }}</span> resultados
                </div>

                <div class="pagination-numbers">
                    {{-- Flecha izquierda --}}
                    @if ($paginator->onFirstPage())
                        <button class="page-number" disabled style="background: white; cursor:not-allowed">
                            <i class="fa-solid fa-chevron-left"></i>
                        </button>
                    @else
                        <button class="page-number" 
                                wire:click.prevent="previousPage('{{ $paginator->getPageName() }}')"  
                                wire:loading.attr="disabled">
                            <i class="fa-solid fa-chevron-left"></i>
                        </button>
                    @endif

                    {{-- Números de página --}}
                    @foreach ($elements as $element)
                        {{-- Puntos suspensivos --}}
                        @if (is_string($element))
                            <span class="page-ellipsis">
                                {{ $element }}
                            </span>
                        @endif

                        {{-- Array de enlaces --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span class="page-number active">
                                        {{ $page }}
                                    </span>
                                @else
                                    <button class="page-number" 
                                            wire:click.prevent="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')">
                                        {{ $page }}
                                    </button>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Flecha derecha --}}
                    @if ($paginator->hasMorePages())
                        <button class="page-number" 
                                wire:click.prevent="nextPage('{{ $paginator->getPageName() }}')"  
                                wire:loading.attr="disabled">
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>
                    @else
                        <button class="page-number" disabled style="background: white; cursor:not-allowed">
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>