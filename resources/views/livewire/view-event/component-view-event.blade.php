<div  x-data="{open: false, openModalEdit: false, openModalDelete: false, openModalSuccess: false}" x-cloak>

    @push('styles')
        @vite(['resources/css/event-card.css'])

        <style>
            input[type="number"]::-webkit-outer-spin-button,
            input[type="number"]::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }

            /* Para Firefox */
            input[type="number"] {
                -moz-appearance: textfield;
            }
        </style>

        <style>
            .checkbox-label {
                display: flex;
                align-items: center;
                cursor: pointer;
                font-family: 'Segoe UI', sans-serif;
                color: #2a3f5f;
                position: relative;
            }
            
            .checkbox-input {
                position: absolute;
                opacity: 0;
                cursor: pointer;
                height: 0;
                width: 0;
            }
            
            .checkbox-custom {
                height: 20px;
                width: 20px;
                background-color: rgba(255, 255, 255, 0.8);
                border: 2px solid rgb(27 138 167);
                ;
                border-radius: 4px;
                margin-right: 10px;
                transition: all 0.3s;
                backdrop-filter: blur(5px);
                position: relative;
            }
            
            .checkbox-label:hover .checkbox-custom {
                background-color: rgba(27, 139, 167, 0.445);
                border-color:2px solid rgba(11, 74, 90, 0.904);

            }
            
            .checkbox-input:checked ~ .checkbox-custom {
                background-color: rgb(27 138 167);
            }
            
            .checkbox-custom:after {
                content: "";
                position: absolute;
                display: none;
                left: 6px;
                top: 2px;
                width: 5px;
                height: 10px;
                border: solid white;
                border-width: 0 2px 2px 0;
                transform: rotate(45deg);
            }
            
            .checkbox-input:checked ~ .checkbox-custom:after {
                display: block;
            }
            
            .checkbox-text {
                font-size: 1.5rem;
                font-weight: 500;
            }
            
        </style>
    
    @endpush

    <div class="panel-custom animated zoomIn" style=' margin: 20px 0;'>
        
        <div class="modern-container-header" style="gap:20px">
            <div class="modern-header" style="margin-bottom:5px;">
                <span class="text-center color-title" style="font-size:25px">{{ __('Eventos') }}</span>
                <span class="text-center color-paragraph" style="margin:0px;">{{ __('Aqui puedes crear, editar o eliminar cualquier evento') }}</span>
            </div>
            <div class="modern-header">
                <button @click="open = !open" class="new-btn-ultimate new-btn-responsive" style="font-size:22px; height: 60px; margin: auto 0">

                    <i x-show="!open" class="fa-solid fa-plus" style="font-size:25px"></i>
                    <i x-show="open" class="fa-solid fa-xmark" style="font-size:25px"></i>
                    
                    <span x-text="open ? 'Cerrar' : 'Nuevo Evento'"></span>
                </button>
            </div>
        </div>
    </div>
    

    <!-- Modal crear Evento -->
    <div x-show="open" x-transition.duration.500ms>
        <div class="panel-custom">
            <div class="modern-container-header">
                <div class="modern-header">
                    <span class="text-center color-title">{{ __('Nuevo Evento') }}</span>
                    <span class="text-center color-paragraph"
                        style="margin:0px;">{{ __('Agrega un Nuevo Evento al sistema') }}</span>
                </div>
            </div>

            <!--Icons Addons-->
            <!--===================================================-->
            <form wire:submit='saveEvent' wire:key="dojo-form-save">
                <div class="panel-body" style="padding-top: 0">
                    <div class="row">
                        <!-- Nombre del Dojo -->
                        <div class="col-sm-6">
                            <div class="form-group">

                                <label class="control-label color-paragraph label-form" for="name"
                                    style="@error('name') color:#e90326; @enderror">Nombre del Evento</label>
                                <div class="input-group mar-btm">
                                    <label class="input-group-addon" for="name"><i
                                            class="fa-solid fa-calendar"></i></label>
                                    <input type="text" class="form-control" id="name" wire:model.live='name'
                                        placeholder="Ingrese el nombre" autocomplete="off" required>
                                </div>
                                @error('name')
                                    <div class="alert-error animated shake">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Ubicación del Dojo -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label color-paragraph label-form" for="location"
                                    style="@error('location') color:#e90326; @enderror">Ubicación</label>
                                <div class="input-group mar-btm">
                                    <label class="input-group-addon" for="location"><i
                                            class="fa-solid fa-location-dot"></i></label>
                                    <input type="text" class="form-control" id="location" wire:model.live='location'
                                        placeholder="Ingrese la ubicación" autocomplete="off" required>
                                </div>
                                @error('location')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Tipo de Evento -->
                        <div class="col-sm-6">
                            <div class="form-group" style="margin:0;position: relative;z-index:2">
                                <label class="control-label color-paragraph label-form" style="@error('$selectedValueEventType') color:#e90326; @enderror">Tipo de Evento</label>
                                <div class="custom-select-container" wire:ignore.self style="margin:0">
                                    <div class="custom-select active" x-data="{ isOpen: false }" @click="isOpen = !isOpen" x-cloak>
                                        <div class="selected-option">
                                            @if ($selectedValueEventType)
                                                <div class="option-content">
                                                    <div class="option-text">
                                                        <div class="option-title">{{ $selectedValueEventType }}</div>
                                                    </div>
                                                </div>
                                            @else
                                                <span>Selecciona un Evento</span>
                                            @endif
                                            <i class="fa-solid fa-angle-down"></i>
                                        </div>
                
                                        <div class="custom-options" style="max-height: 150px" x-show="isOpen" x-transition @click.away="isOpen = false" x-cloak style="">
                                            @if($optionsEventType)
                                                @foreach ($optionsEventType as $index => $option)
                                                    <div class="option {{ $selectedValueEventType == $option['value'] ? 'selected' : '' }}"
                                                        wire:click="selectOptionEventType({{ $index }})">
                                                        <div class="option-content">
                                                            <div class="option-text">
                                                                <div class="option-title">{{ $option['value'] }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                
                                    </div>
                                </div>
                            </div>
                            @error('selectedValueEventType')
                                <div class="alert-error animated shake">{{ $message }}</div>
                            @enderror
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <!-- Hora de inicio -->
                                <label class="control-label color-paragraph label-form" style="@error('startTime') color:#e90326; @enderror">Hora de inicio</label>
                                <div class="input-group mar-btm">
                                    <span class="input-group-addon"><i class="fa-solid fa-calendar-days"></i></span>
                                    <input type="datetime-local" 
                                            wire:model.live="startTime"
                                            class="form-control"
                                            style="z-index: 0" style="z-index:0">
                                </div>
                                {{-- <div class="time-display" style="font-size:15px">
                                    {{ $this->formatAMPM($startTime) }}
                                </div> --}}
                                @error('startTime')
                                    <div class="alert-error animated shake">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <!-- Hora de finalización -->
                                <label class="control-label color-paragraph label-form" style="@error('endTime') color:#e90326; @enderror">Hora de finalización</label>
                                <div class="input-group mar-btm">
                                    <span class="input-group-addon"><i class="fa-solid fa-calendar-days"></i></span>
                                    <input type="datetime-local" 
                                        wire:model.live="endTime"
                                        class="form-control" style="z-index:0">
                                </div>

                                {{-- <div class="time-display" style="font-size:15px">
                                    {{ $this->formatAMPM($endTime) }}
                                </div> --}}

                                @error('endTime')
                                    <div class="alert-error animated shake">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- Campos ocultos para el formato time -->
                        <input type="hidden" name="start_time" value="{{ $startTime ? $startTime . ':00' : '' }}">
                        <input type="hidden" name="end_time" value="{{ $endTime ? $endTime . ':00' : '' }}">
                    </div>

                    <div class="row">
                        <!-- Participantes -->
                        <div class="col-sm-6">
                            
                            <div class="form-group" style="margin-top:0">
                                <label class="control-label color-paragraph label-form" style="@error('participant_type') color:#e90326; @enderror">Entidades a Participar</label>
                                <div style="display:flex;flex-wrap:wrap; align-items: center;background:#1b8aa714; padding:5px;border-radius:5px; gap: 10px 20px;  margin-bottom:10px" x-data="{openEnable: false, text:''}">
                                    <label class="checkbox-label" style="margin:0" >
                                        <input type="checkbox" class="checkbox-input" wire:model='participant_type' value='dojo' x-model="openEnable">
                                        <span class="checkbox-custom"></span>
                                        <span class="checkbox-text">Dojos</span>
                                    </label>
                                    <div class="checkbox-label">
                                        <input type="number" class="form-control" id="maxDojo" wire:model.live='maxDojo' placeholder="max" autocomplete="off" required min="0" style="z-index:0;height: 20px;border: 2px solid #177b97; width: 40px; padding:2px" :disabled="!openEnable" x-model='text' oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                        <label class="control-label color-paragraph label-form" style="@error('participant_type') color:#e90326;@enderror font-size:12px;border:none; margin:0;font-family: 'Segoe UI', sans-serif" for="maxDojo">N° maximo de Dojos</label>
                                    </div>
                                    <div x-effect="if (!openEnable) text = ''"></div>
                                    <div x-effect="openEnable = $wire.participant_type.includes('dojo')"></div>          
                                </div>
                                @error('maxDojo')
                                    <div class="alert-error animated shake" style="margin:10px">{{ $message }}</div>
                                @enderror
                                
                                <div style="display:flex;flex-wrap:wrap; align-items: center;background:#1b8aa714; padding:5px;border-radius:5px; gap: 10px 20px; margin-bottom:10px" x-data="{openEnable: false, text:''}">
                                    <label class="checkbox-label" style="margin:0" >
                                        <input type="checkbox" class="checkbox-input" wire:model='participant_type' value='sensei' x-model="openEnable">
                                        <span class="checkbox-custom"></span>
                                        <span class="checkbox-text">Senseis</span>
                                    </label>
                                    <div class="checkbox-label">
                                        <input type="number" class="form-control" id="maxSensei" wire:model.live='maxSensei' placeholder="max" autocomplete="off" required min="0" style="z-index:0;height: 20px;border: 2px solid #177b97; width: 40px; padding:2px" :disabled="!openEnable" x-model='text' oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                        <label class="control-label color-paragraph label-form" style="@error('participant_type') color:#e90326;@enderror font-size:12px;border:none; margin:0;font-family: 'Segoe UI', sans-serif" for="maxSensei">N° maximo de Senseis</label>
                                    </div>
                                    <div x-effect="openEnable = $wire.participant_type.includes('sensei')"></div>          
                                    <div x-effect="if (!openEnable) text = ''"></div>          
                                </div>
                                @error('maxSensei')
                                    <div class="alert-error animated shake" style="margin:10px">{{ $message }}</div>
                                @enderror
                                
                                <div style="display:flex;flex-wrap:wrap; align-items: center;background:#1b8aa714; padding:5px;border-radius:5px; gap: 10px 20px; margin-bottom:10px" x-data="{openEnable: false, text:''}">
                                    <label class="checkbox-label" style="margin:0" >
                                        <input type="checkbox" class="checkbox-input" wire:model='participant_type' value='student' x-model="openEnable">
                                        <span class="checkbox-custom"></span>
                                        <span class="checkbox-text">Atletas</span>
                                    </label>
                                    <div class="checkbox-label">
                                        <input type="number" class="form-control" id="maxStudent" wire:model.live='maxStudent' placeholder="max" autocomplete="off" required min="0" style="z-index:0;height: 20px;border: 2px solid #177b97; width: 40px; padding:2px" :disabled="!openEnable" x-model='text' oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                        <label class="control-label color-paragraph label-form" style="@error('participant_type') color:#e90326;@enderror font-size:12px;border:none; margin:0;font-family: 'Segoe UI', sans-serif" for="maxStudent">N° maximo de Atletas</label>
                                    </div>
                                    <div x-effect="if (!openEnable) text = ''"></div>
                                    <div x-effect="openEnable = $wire.participant_type.includes('student')"></div>          
                                </div>
                                @error('maxStudent')
                                    <div class="alert-error animated shake" style="margin:10px">{{ $message }}</div>
                                @enderror 

                            </div>
                        </div>
                        <!-- Descripciónsad -->
                        <div class="col-sm-6">
                            <div class="form-group" style="margin-top:0">
                                <label class="control-label color-paragraph label-form" for="description"
                                    style="@error('description') color:#e90326; @enderror">Breve Descripción</label>
                                <div class="input-group mar-btm">
                                    <label class="input-group-addon" for="description"><i
                                            class="fa-solid fa-pen-to-square"></i></label>
                                    <textarea class="form-control" id="description" wire:model.live='description'
                                        placeholder="Ingrese una breve descripción" style="height: 120px; overflow-y: auto; resize: none;z-index:0" required></textarea>
                                </div>
                                @error('description')
                                    <div class="alert-error animated shake">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12" style="display: flex; justify-content: center">
                            <button class="modern-btn-success" type="submit" >
                                <i class="fa-solid fa-check"></i>
                                <span>Guardar</span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            <!--===================================================-->
            <!--End Icons Addons-->
        </div>
    </div>

    <!-- Buscador Y Cartas y Tables -->
    <div class="panel-custom animated zoomIn" style=' margin: 20px 0;'>
        
        <div class="modern-container-header">
            <div class="modern-header" style="margin-bottom:5px;">
                <span class="text-center color-title" style="font-size:25px">{{ __('Buscar Eventos') }}</span>
            </div>
        </div>
        <!-- Buscador -->
        <div class="table-controls" style="margin:0;">
            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass" style="color:#002569"></i>
                <input wire:model.live="search" type="text" placeholder="Buscar eventos..." class="search-input">
            </div>

            <!-- Select -->
            <div class="custom-select-container" wire:ignore.self>
                <div class="custom-select active" x-data="{ isOpen: false }" @click="isOpen = !isOpen" x-cloak>
                    <div class="selected-option">
                        @if ($selectedValue)
                            <div class="option-content">
                                <div class="dojo-avatar">
                                    <i class="{{$selectedIcon}}" style="color:black;font-size:20px"></i>
                                </div>
                                <div class="option-text">
                                    <div class="option-title">{{ $selectedLabel }}</div>
                                </div>
                            </div>
                        @else
                            <span>Selecciona un dojo</span>
                        @endif
                        <i class="fa-solid fa-angle-down"></i>
                    </div>

                    <div class="custom-options" x-show="isOpen" x-transition @click.away="isOpen = false" x-cloak style="">
                        @foreach ($options as $index => $option)
                            <div class="option {{ $selectedValue == $option['value'] ? 'selected' : '' }}"
                                wire:click="selectOption({{ $index }})">
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

                <!-- Select oculto para formularios -->
                <select class="hidden-select" wire:model="selectedValue" required>
                    <option value="" disabled selected>Selecciona un dojo</option>
                    @foreach ($options as $option)
                        <option value="{{ $option['value'] }}">{{ $option['title'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Card con los Eventos -->
        <div class="" style=' margin: 20px 0;display: flex;flex-wrap: wrap;gap: 20px;flex-grow:1; justify-content:center'>
            @foreach($events as $event)
                @php $participantTypes = json_decode($event->participant_type, true) ?? []; @endphp

                <div class="event-card-glass">
                    <!-- Imagen del evento -->
                    <div class="event-image-container">
                        @if ($event->event_type == 'competencia')
                            <img src="{{asset('image/event/competencia.jpg')}}" class="event-image">
                        @elseif($event->event_type == 'entrenamiento')
                            <img src="{{asset('image/event/entrenamiento.jpg')}}" class="event-image">
                        @elseif($event->event_type == 'otro')
                            <img src="{{asset('image/event/otro.jpg')}}" class="event-image">
                        @elseif($event->event_type == 'seminario')
                            <img src="{{asset('image/event/seminario.jpeg')}}" class="event-image">
                        @else
                            <img src="{{asset('image/event/social.jpeg')}}" class="event-image">
                        @endif
                        <div class="event-type-badge">
                            {{ $event->event_type }}
                        </div>
                    </div>
                    
                    <!-- Contenido de la tarjeta -->
                    <div class="event-content">
                        <h3 class="event-title">{{ $event->name }}</h3>
                        
                        <div class="event-meta">
                            <div class="meta-item">
                                <id class="fa-solid fa-location-dot meta-icon" style="text-align:center"></id><span>{{ $event->location }}</span>
                            </div>
                            <div class="meta-item">
                                <i class="fa-solid fa-calendar-day meta-icon"></i>
                                <span>
                                    {{ \Carbon\Carbon::parse($event->start_date)->format('d M, Y H:i') }} - 
                                    {{ \Carbon\Carbon::parse($event->end_date)->format('d M, Y H:i') }}
                                </span>
                            </div>
                            <div class="meta-item" style="flex-wrap: wrap; gap:3px">
                                <i class="fa-solid fa-arrows-down-to-people meta-icon"></i>
                                <span style="margin-right: 6px">N° Max. de Participantes: </span>
                                @foreach($participantTypes as $type)
                                    @if($type == 'dojo')
                                        <span class="description-event" style=" margin-right: 5px"><i class="fas fa-vihara meta-icon" style="margin-right:0; color: #c53030ad;"></i> Dojos({{$event->max_dojo}})</span>
                                    @elseif($type == 'sensei')
                                        <span class="description-event" style=" margin-right: 5px"><i class="fas fa-user-ninja meta-icon" style="margin-right:0;color: #c53030ad;"></i> Senseis({{$event->max_sensei}})</span>
                                    @elseif($type == 'student')
                                        <span class="description-event" style=" margin-right: 5px"><i class="fas fa-user-graduate meta-icon" style="margin-right:0;color: #c53030ad;"></i> Atletas({{$event->max_student}})</span>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <p class="event-description">{{ Str::limit($event->description, 150) }}</p>
                        
                        <!-- Acciones -->
                        <div class="event-actions">
                            <button class="edit-btn-ultimate edit-btn-ultimate-table" @click="openModalEdit = !openModalEdit" wire:click="editEventModal({{ $event->id }}, {{$event->dojo_count}}, {{$event->sensei_count}}, {{$event->student_count}})">
                                <i class="fa-solid fa-pen" style="font-size:15px"></i>
                                <span style="font-size:15px">Editar</span>
                            </button>
                            <button class="delete-btn-ultimate delete-btn-ultimate-table" @click="openModalDelete = !openModalDelete" wire:click="deleteEventModal({{ $event->id }})">
                                <i class="fa-solid fa-trash" style="font-size:15px"></i>
                                <span style="font-size:15px">Eliminar</span>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div style="padding: 0 10px">{{ $events->links('vendor.livewire.bootstrap') }}</div>

    </div>



    <!-- Modal Eventos Edit -->
    <div class="modal-overlay" x-show='openModalEdit' @click.self="openModalEdit = !openModalEdit" x-transition:leave.duration.500ms x-transition:enter.duration.500ms>
        <div class="modal-container " :class="openModalEdit ? 'animated fadeInDown' : 'animated zoomOut'" style="max-width:90vw">
            <button class="close-btn-image" @click="openModalEdit = !openModalEdit">&times;</button>
            <div class="modern-container-header" style="justify-content:space-around; flex-wrap:wrap; gap:15px; margin-bottom:20px">
                <div class="modern-header">
                    <span class="text-center color-title">{{ __('Edita el Evento') }}</span>
                </div>
            </div>
            <div class="panel-body">

                <form wire:submit='editEvent' wire:key="dojo-form-save">
                    <div class="panel-body" style="padding-top: 0">
                        <div class="row">
                            <!-- Nombre del Dojo -->
                            <div class="col-sm-6">
                                <div class="form-group">

                                    <label class="control-label color-paragraph label-form" for="nameEdit"
                                        style="@error('nameEdit') color:#e90326; @enderror">Nombre del Evento</label>
                                    <div class="input-group mar-btm">
                                        <label class="input-group-addon" for="nameEdit"><i
                                                class="fa-solid fa-calendar"></i></label>
                                        <input type="text" class="form-control" id="nameEdit" wire:model.live='nameEdit'
                                            placeholder="Ingrese el nombre" autocomplete="off" required>
                                    </div>
                                    @error('nameEdit')
                                        <div class="alert-error animated shake">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Ubicación del Dojo -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label color-paragraph label-form" for="locationEdit"
                                        style="@error('locationEdit') color:#e90326; @enderror">Ubicación</label>
                                    <div class="input-group mar-btm">
                                        <label class="input-group-addon" for="locationEdit"><i
                                                class="fa-solid fa-location-dot"></i></label>
                                        <input type="text" class="form-control" id="locationEdit" wire:model.live='locationEdit'
                                            placeholder="Ingrese la ubicación" autocomplete="off" required>
                                    </div>
                                    @error('locationEdit')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Tipo de Evento -->
                            <div class="col-sm-6">
                                <div class="form-group" style="margin: 0;position: relative;z-index:2">
                                    <label class="control-label color-paragraph label-form" style="@error('$selectedValueEventTypeEdit') color:#e90326; @enderror">Tipo de Evento</label>
                                    <div class="custom-select-container" wire:ignore.self style="margin:0">
                                        <div class="custom-select active" x-data="{ isOpen: false }" @click="isOpen = !isOpen" x-cloak>
                                            <div class="selected-option">
                                                @if ($selectedValueEventTypeEdit)
                                                    <div class="option-content">
                                                        <div class="option-text">
                                                            <div class="option-title">{{ $selectedValueEventTypeEdit }}</div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <span>Selecciona un Evento</span>
                                                @endif
                                                <i class="fa-solid fa-angle-down"></i>
                                            </div>
                    
                                            <div class="custom-options" style="max-height: 150px" x-show="isOpen" x-transition @click.away="isOpen = false" x-cloak style="">
                                                @if($optionsEventType)
                                                    @foreach ($optionsEventType as $index => $option)
                                                        <div class="option {{ $selectedValueEventTypeEdit == $option['value'] ? 'selected' : '' }}"
                                                            wire:click="selectOptionEventTypeEdit({{ $index }})">
                                                            <div class="option-content">
                                                                <div class="option-text">
                                                                    <div class="option-title">{{ $option['value'] }}</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                    
                                        </div>
                                    </div>
                                </div>
                                @error('selectedValueEventTypeEdit')
                                    <div class="alert-error animated shake">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <!-- Hora de inicio -->
                                    <label class="control-label color-paragraph label-form" style="@error('startTimeEdit') color:#e90326; @enderror">Hora de inicio</label>
                                    <div class="input-group mar-btm">
                                        <span class="input-group-addon"><i class="fa-solid fa-calendar-days"></i></span>
                                        <input type="datetime-local" 
                                                wire:model.live="startTimeEdit"
                                                class="form-control"
                                                style="z-index: 0" style="z-index:0">
                                    </div>
                                    {{-- <div class="time-display" style="font-size:15px">
                                        {{ $this->formatAMPM($startTimeEdit) }}
                                    </div> --}}
                                    @error('startTimeEdit')
                                        <div class="alert-error animated shake">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <!-- Hora de finalización -->
                                    <label class="control-label color-paragraph label-form" style="@error('endTimeEdit') color:#e90326; @enderror">Hora de finalización</label>
                                    <div class="input-group mar-btm">
                                        <span class="input-group-addon"><i class="fa-solid fa-calendar-days"></i></span>
                                        <input type="datetime-local" 
                                            wire:model.live="endTimeEdit"
                                            class="form-control" style="z-index:0">
                                    </div>
    
                                    {{-- <div class="time-display" style="font-size:15px">
                                        {{ $this->formatAMPM($endTimeEdit) }}
                                    </div> --}}

                                    @error('endTimeEdit')
                                        <div class="alert-error animated shake">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Campos ocultos para el formato time -->
                            <input type="hidden" name="start_time" value="{{ $startTimeEdit ? $startTimeEdit . ':00' : '' }}">
                            <input type="hidden" name="end_time" value="{{ $endTimeEdit ? $endTimeEdit . ':00' : '' }}">
                        </div>

                        <div class="row">
                            <!-- MAX Participants -->
                            <div class="col-sm-6">
                                
                                <div class="form-group" style="margin-top:0">
                                    <label class="control-label color-paragraph label-form" style="@error('participant_typeEdit') color:#e90326; @enderror">Entidades a Participar</label>
                                    <div style="display:flex;flex-wrap:wrap; align-items: center;background:#1b8aa714; padding:5px;border-radius:5px; gap: 10px 20px;  margin-bottom:10px" x-data="{openEnable: false, text:''}">
                                        <label class="checkbox-label" style="margin:0" >
                                            <input type="checkbox" class="checkbox-input" wire:model='participant_typeEdit' value='dojo' x-model="openEnable">
                                            <span class="checkbox-custom"></span>
                                            <span class="checkbox-text">Dojos</span>
                                        </label>
                                        <div class="checkbox-label">
                                            <input type="number" class="form-control" id="maxDojoEdit" wire:model.live='maxDojoEdit' placeholder="max" autocomplete="off" required min="0" style="z-index:0;height: 20px;border: 2px solid #177b97; width: 40px; padding:2px" :disabled="!openEnable" x-model='text' oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                            <label class="control-label color-paragraph label-form" style="@error('participant_typeEdit') color:#e90326;@enderror font-size:12px;border:none; margin:0;font-family: 'Segoe UI', sans-serif" for="maxDojoEdit">N° maximo de Dojos</label>
                                        </div>
                                        @if($dojoCount > 0)
                                            <span>N° de Dojos Registrados: {{$dojoCount}}</span>
                                            <span x-show="!openEnable" class="text-danger"><i class="fa-solid fa-circle-exclamation"></i> Se borraran los Dojos Registrados al Evento</span>
                                        @endif
                                        <div x-effect="if (!openEnable) text = ''"></div>
                                        <div x-effect="openEnable = $wire.participant_typeEdit.includes('dojo')"></div>          
                                    </div>
                                    @error('maxDojoEdit')
                                        <div class="alert-error animated shake" style="margin:10px">{{ $message }}</div>
                                    @enderror
                                    
                                    <div style="display:flex;flex-wrap:wrap; align-items: center;background:#1b8aa714; padding:5px;border-radius:5px; gap: 10px 20px; margin-bottom:10px" x-data="{openEnable: false, text:''}">
                                        <label class="checkbox-label" style="margin:0" >
                                            <input type="checkbox" class="checkbox-input" wire:model='participant_typeEdit' value='sensei' x-model="openEnable">
                                            <span class="checkbox-custom"></span>
                                            <span class="checkbox-text">Senseis</span>
                                        </label>
                                        <div class="checkbox-label">
                                            <input type="number" class="form-control" id="maxSenseiEdit" wire:model.live='maxSenseiEdit' placeholder="max" autocomplete="off" required min="0" style="z-index:0;height: 20px;border: 2px solid #177b97; width: 40px; padding:2px" :disabled="!openEnable" x-model='text' oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                            <label class="control-label color-paragraph label-form" style="@error('participant_typeEdit') color:#e90326;@enderror font-size:12px;border:none; margin:0;font-family: 'Segoe UI', sans-serif" for="maxSenseiEdit">N° maximo de Senseis</label>
                                        </div>
                                        @if($senseiCount > 0)
                                            <span>N° de Senseis Registrados: {{$senseiCount}}</span>
                                            <span x-show="!openEnable" class="text-danger"><i class="fa-solid fa-circle-exclamation"></i> Se borraran los Senseis Registrados al Evento</span>
                                        @endif
                                        <div x-effect="openEnable = $wire.participant_typeEdit.includes('sensei')"></div>          
                                        <div x-effect="if (!openEnable) text = ''"></div>          
                                    </div>
                                    @error('maxSenseiEdit')
                                        <div class="alert-error animated shake" style="margin:10px">{{ $message }}</div>
                                    @enderror
                                    
                                    <div style="display:flex;flex-wrap:wrap; align-items: center;background:#1b8aa714; padding:5px;border-radius:5px; gap: 10px 20px; margin-bottom:10px" x-data="{openEnable: false, text:''}">
                                        <label class="checkbox-label" style="margin:0" >
                                            <input type="checkbox" class="checkbox-input" wire:model='participant_typeEdit' value='student' x-model="openEnable">
                                            <span class="checkbox-custom"></span>
                                            <span class="checkbox-text">Atletas</span>
                                        </label>
                                        <div class="checkbox-label">
                                            <input type="number" class="form-control" id="maxStudentEdit" wire:model.live='maxStudentEdit' placeholder="max" autocomplete="off" required min="0" style="z-index:0;height: 20px;border: 2px solid #177b97; width: 40px; padding:2px" :disabled="!openEnable" x-model='text' oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                            <label class="control-label color-paragraph label-form" style="@error('participant_typeEdit') color:#e90326;@enderror font-size:12px;border:none; margin:0;font-family: 'Segoe UI', sans-serif" for="maxStudentEdit">N° maximo de Atletas</label>
                                        </div>
                                        @if($studentCount > 0)
                                            <span>N° de Atletas Registrados: {{$studentCount}}</span>
                                            <span x-show="!openEnable" class="text-danger"><i class="fa-solid fa-circle-exclamation"></i> Se borraran los Atletas Registrados al Evento</span>
                                        @endif
                                        <div x-effect="if (!openEnable) text = ''"></div>
                                        <div x-effect="openEnable = $wire.participant_typeEdit.includes('student')"></div>          
                                    </div>
                                    @error('maxStudentEdit')
                                        <div class="alert-error animated shake" style="margin:10px">{{ $message }}</div>
                                    @enderror 

                                </div>
                                @error('participant_typeEdit')
                                    <div class="alert-error animated shake" style="margin:10px">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Descripciónsad -->
                            <div class="col-sm-6">
                                <div class="form-group" style="margin-top:0">
                                    <label class="control-label color-paragraph label-form" for="descriptionEdit"
                                        style="@error('descriptionEdit') color:#e90326; @enderror">Breve Descripción</label>
                                    <div class="input-group mar-btm">
                                        <label class="input-group-addon" for="descriptionEdit"><i
                                                class="fa-solid fa-pen-to-square"></i></label>
                                        <textarea class="form-control" id="descriptionEdit" wire:model.live='descriptionEdit'
                                            placeholder="Ingrese una breve descripción" style="height: 120px; overflow-y: auto; resize: none;z-index:0" required></textarea>
                                    </div>
                                    @error('descriptionEdit')
                                        <div class="alert-error animated shake">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12" style="display: flex; justify-content: end; gap:10px">
                                <button class="cancel-btn-ultimate" type="button" @click="openModalEdit = !openModalEdit">
                                    <i class="fa-solid fa-xmark"></i>
                                    <span>Cancelar</span>
                                </button>
                                <button class="modern-btn-success" type="submit">
                                    <i class="fa-solid fa-check"></i>
                                    <span>Guardar</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                </form>
                
            </div>
            
        </div>
    </div>

    <!-- Modal Eliminar -->
    <div x-show='openModalDelete' wire:key="destroy-modal" class="modal-overlay" @click.self="openModalDelete = !openModalDelete" x-transition:leave.duration.500ms x-transition:enter.duration.500ms>
        <div class="modal-container" style="max-width:500px" :class="openModalDelete ? 'animated fadeInDown' : 'animated zoomOut'">
            <button class="close-btn-image" @click="openModalDelete = !openModalDelete">&times;</button>
            <div class="modern-container-header">
                <div class="modern-header">
                    <i class="fa-solid fa-triangle-exclamation fa-beat"
                        style="font-size: 1.8rem; color: #ac2b2b; margin-bottom: 15px; font-size:50px; display:block"></i>
                    <span class="text-center color-title">{{ __('Eliminar Evento') }}</span>
                </div>
            </div>

            <div class="panel-body">
                <h3 class=" text-center alert alert-danger" style="margin:15px 0;font-size:20px">
                    {{ $message ?? '' }}</h3>
                <div class="row" style="margin-top:20px">
                    <div class="col-sm-12" style="display: flex; justify-content: center; gap:10px;">
                        <button class="cancel-btn-ultimate" type="button" @click="openModalDelete = !openModalDelete">
                            <i style="font-size:17px" class="fa-solid fa-xmark"></i>
                            <span style="font-size:17px">Cancelar</span>
                        </button>
                        <button class="delete-btn-ultimate" type="button" wire:click='deleteEvent()' @click="openModalDelete = !openModalDelete ; openModalSuccess = !openModalSuccess">
                            <i class="fa-solid fa-trash" style="font-size:17px"></i>
                            <span style="font-size:17px">Eliminar</span>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>


    {{-- Evento de Success --}}

    <div x-data="{
        openModalSuccess: false,
        openModal() {
            // Abre la modal
            this.openModalSuccess = true;
            // Programa el cierre en 5 segundos
            setTimeout(() => {
                this.openModalSuccess = false;
            }, 5000);
            }
        }"
        @open-modal-success.window="openModal()">
        
        <div class="modal-overlay"
             x-show="openModalSuccess"
             x-transition:enter.duration.500ms
             x-transition:leave.duration.500ms
             x-cloak
             @click.self="openModalSuccess = false">
            <div class="modal-container animated bounceIn" style="max-width:500px">
                <button class="close-btn-image" @click="openModalSuccess = false">&times;</button>
                <div class="modern-container-header">
                    <div class="modern-header">
                        <i class="fa-solid fa-circle-check fa-beat"
                           style="font-size: 50px; color: #2bac47; margin-bottom: 15px; display:block"></i>
                        <span class="text-center color-title">{{ __('Proceso Exitoso') }}</span>
                    </div>
                </div>
                <h3 class="text-center alert alert-success" style="margin: 20px 0; font-size:20px">
                    {{ $message ?? '' }}
                </h3>
            </div>
        </div>
    </div>
</div>
