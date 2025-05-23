<div>
    <!--Buscador de Dojos-->
    <div class="table-controls" style="margin-bottom:0px;">
        <div class="search-box" style="max-width: 200px;">
            <i class="fa-solid fa-magnifying-glass" style="color:#002569"></i>
            <input wire:model.live="searchStudent" type="text" placeholder="Buscar Atletas..." class="search-input">
        </div>
        <!-- Select -->
        <div class="custom-select-container" wire:ignore.self style="max-width: 150px">
            <div class="custom-select active" x-data="{ isOpen: false }" @click="isOpen = !isOpen" x-cloak wire:ignore>
                <div class="selected-option" style="padding:5px">
                    @if ($selectedValueSearchStudent)
                        <div class="option-content">
                            <div class="dojo-avatar">
                                <i class="{{$selectedIconSearchStudent}}" style="color:black;font-size:20px"></i>
                            </div>
                            <div class="option-text">
                                <div class="option-title">{{ $selectedLabelSearchStudent }}</div>
                            </div>
                        </div>
                    @else
                        <span>Selecciona un dojo</span>
                    @endif
                    <i class="fa-solid fa-angle-down"></i>
                </div>

                <div class="custom-options" x-show="isOpen" x-transition @click.away="isOpen = false" x-cloak style="">
                    @foreach ($optionsSearchStudent as $index => $option)
                        <div class="option {{ $selectedValueSearchStudent == $option['value'] ? 'selected' : '' }}"
                            wire:click="selectOptionStudent({{ $index }})">
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

    <!-- Student -->
    <div class="students-section">
        @if($students->count() == 0)
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
        @foreach($students as $student)
            <div class="student-card">
                @if ($student->photo)
                    <img src="{{ asset('storage/' . $student->photo) }}" class="student-avatar">
                @else
                    <img src="{{ asset('image/sensei-default.jpg') }}">
                @endif
                <div>
                    <h3>{{$student->name}}</h3>
                    <p><i class="fa-solid fa-ribbon"></i> {{$student->kyu}} • <i class="fas fa-cake-candles"></i> {{ \Carbon\Carbon::parse($student->date_of_birth)->age }} años</p>
                    <p class="sensei-name" style="margin-top: 3px"><i class="fa-solid fa-vihara"></i> {{$student->dojo->name ?? 'no tiene dojo asignado'}}</p>

                    @if($student->sensei)
                        <p class="sensei-name" style="margin-top: 3px"><i class="fa-solid fa-user-ninja"></i> {{$student->sensei->name}}</p>
                    @else
                        <p class="sensei-name" style="margin-top: 3px"><i class="fa-solid fa-exclamation-circle"></i> Este Atleta se encuentra Inactivo</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    <div wire:key="student">

        {{ $students->links('vendor.livewire.bootstrap') }}
    </div>
</div>
