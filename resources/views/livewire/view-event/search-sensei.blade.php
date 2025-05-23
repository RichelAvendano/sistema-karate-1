<div>
    <!--Buscador de Dojos-->
    <div class="table-controls" style="margin-bottom:0px;">
        <div class="search-box" style="max-width: 200px;">
            <i class="fa-solid fa-magnifying-glass" style="color:#002569"></i>
            <input wire:model.live="searchSensei" type="text" placeholder="Buscar Senseis..." class="search-input">
        </div>
        <!-- Select -->
        <div class="custom-select-container" wire:ignore.self style="max-width: 150px">
            <div class="custom-select active" x-data="{ isOpen: false }" @click="isOpen = !isOpen" x-cloak>
                <div class="selected-option" style="padding:5px">
                    @if ($selectedValueSearchSensei)
                        <div class="option-content">
                            <div class="dojo-avatar">
                                <i class="{{$selectedIconSearchSensei}}" style="color:black;font-size:20px"></i>
                            </div>
                            <div class="option-text">
                                <div class="option-title">{{ $selectedLabelSearchSensei }}</div>
                            </div>
                        </div>
                    @else
                        <span>Selecciona un dojo</span>
                    @endif
                    <i class="fa-solid fa-angle-down"></i>
                </div>

                <div class="custom-options" x-show="isOpen" x-transition @click.away="isOpen = false" x-cloak style="">
                    @foreach ($optionsSearchSensei as $index => $option)
                        <div class="option {{ $selectedValueSearchSensei == $option['value'] ? 'selected' : '' }}"
                            wire:click="selectOptionSensei({{ $index }})">
                            <div class="option-content">
                                <div class="dojo-avatar">
                                    <i class="{{$option['icon']}}" style="color:black;font-size:20px"></i>
                                </div>
                                <div class="option-text">
                                    <div class="option-title">{{ $option['title'] }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>  
    </div>

    <!-- Senseis -->
    <div class="senseis-section">
        @if($senseis->count() == 0)
            <div class="no-results-alert">
                <div class="alert-icon">
                    <i class="fa-solid fa-circle-exclamation"></i>
                </div>
                <div class="alert-content">
                    <h3>No se encontraron resultados</h3>
                    <p>Intenta ajustar tus criterios de búsqueda</p>
                </div>
            </div>
        @endif
        @foreach($senseis as $sensei)
            <div class="sensei-card">
                @if ($sensei->photo)
                    <img src="{{ asset('storage/' . $sensei->photo) }}" class="sensei-avatar">
                @else
                    <img src="{{ asset('image/sensei-default.jpg') }}">
                @endif
                <div>
                    <h3> {{$sensei->name}}</h3>
                    <p><i class="fa-solid fa-ribbon"></i> {{$sensei->dan}} • <i class="fas fa-cake-candles"></i> {{ \Carbon\Carbon::parse($sensei->date_of_birth)->age }} años</p>
                    @if($sensei->dojo)
                        <p class="dojo-name" style="margin-top: 3px"><i class="fa-solid fa-vihara"></i> {{$sensei->dojo->name}}</p>
                    @else
                        <p class="dojo-name" style="margin-top: 3px"><i class="fa-solid fa-exclamation-circle"></i> Este Sensei se encuentra Inactivo</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    <div wire:key="senseis">

        {{ $senseis->links('vendor.livewire.bootstrap') }}
    </div>
</div>
