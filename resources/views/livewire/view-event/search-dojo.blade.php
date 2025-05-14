<div>
    <!--Buscador de Dojos-->
    <div class="table-controls" style="margin-bottom:0px;">
        <div class="search-box" style="max-width: 200px;">
            <i class="fa-solid fa-magnifying-glass" style="color:#002569"></i>
            <input wire:model.live="searchDojo" type="text" placeholder="Buscar dojos..." class="search-input">
        </div>
        <!-- Select -->
        <div class="custom-select-container" wire:ignore.self style="max-width: 150px">
            <div class="custom-select active" x-data="{ isOpen: false }" @click="isOpen = !isOpen" x-cloak>
                <div class="selected-option" style="padding:5px">
                    @if ($selectedValueSearchDojo)
                        <div class="option-content">
                            <div class="dojo-avatar">
                                <i class="{{$selectedIconSearchDojo}}" style="color:black;font-size:20px"></i>
                            </div>
                            <div class="option-text">
                                <div class="option-title">{{ $selectedLabelSearchDojo }}</div>
                            </div>
                        </div>
                    @else
                        <span>Selecciona un dojo</span>
                    @endif
                    <i class="fa-solid fa-angle-down"></i>
                </div>

                <div class="custom-options" x-show="isOpen" x-transition @click.away="isOpen = false" x-cloak style="">
                    @foreach ($optionsSearchDojo as $index => $option)
                        <div class="option {{ $selectedValueSearchDojo == $option['value'] ? 'selected' : '' }}"
                            wire:click="selectOptionDojo({{ $index }})">
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
    <div class="dojos-section">
        @if($dojos->count() == 0)
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
        @foreach($dojos as $dojo)
            <div class="dojo-card">
                @if ($dojo->photo)
                    <img src="{{ asset('storage/' . $dojo->photo) }}" class="dojo-image">
                @else
                    <img src="{{ asset('image/dojo-default.jpg') }}">
                @endif
                <div>
                    <h3><i class="fa-solid fa-vihara"></i> {{$dojo->name}}</h3>
                    <p style=""><i class="fa-solid fa-location-dot text-danger"></i> {{$dojo->location}}</p>
                    <p style=" margin-top:5px; font-style:italic">{{$dojo->description}}</p>
                </div>
            </div>
        @endforeach
    </div>
    <div wire:key="dojos">
        {{ $dojos->links('vendor.livewire.bootstrap') }}
    </div>
</div>
