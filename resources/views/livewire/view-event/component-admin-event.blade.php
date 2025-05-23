<div  x-data="{open: false, openModalDojo: false,openModalSensei: false, openModalStudent: false, openModalDelete: false, activeButton: 'sensei', openConfirm1: false}" x-cloak>

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
            .event-card-glass {
                background: linear-gradient(135deg, rgba(200, 220, 255, 0.123), rgba(255, 200, 220, 0.107));
                border-radius: 16px;
                overflow: hidden;
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
                border: 1px solid rgba(255, 255, 255, 0.3);
                transition: all 0.3s ease;
                max-width: 350px;
                width: 100%;
            }
            
            .event-card-glass:hover {
                transform: translateY(-5px);
                box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
            }
            
            .event-image-container {
                position: relative;
                height: 180px;
                overflow: hidden;
            }
            
            .event-image {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.5s ease;
            }
            
            .event-card-glass:hover .event-image {
                transform: scale(1.05);
            }
            
            .event-type-badge {
                position: absolute;
                top: 15px;
                right: 15px;
                background: linear-gradient(135deg, rgb(59 130 246 / 59%), rgb(220 38 38 / 60%));
                color: white;
                padding: 5px 12px;
                border-radius: 20px;
                font-size: 1.3rem;
                font-weight: 600;
                backdrop-filter: blur(5px);
            }
            
            .event-content {
                padding: 20px;
                padding-top: 0px;
            }
            
            .event-title {
                color: #2a3f5f;
                font-size: 2rem;
                margin-bottom: 10px;
                font-weight: 700;
            }
            
            .event-meta {
                display: flex;
                flex-direction: column;
                gap: 8px;
                margin-bottom: 15px;
            }
            
            .meta-item {
                display: flex;
                align-items: center;
                color: #4a5568;
                font-size: 1.5rem;
            }
            
            .meta-icon {
                width: 18px;
                height: 18px;
                margin-right: 8px;
                color: #c53030;
            }
            
            .event-description {
                color: #4a5568;
                font-size: 1.4rem;
                line-height: 1.5;
                margin-bottom: 20px;
            }
            
            .event-actions {
                display: flex;
                gap: 10px;
            }
            
            .edit-btn, .delete-btn {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 6px;
                padding: 8px 15px;
                border-radius: 8px;
                font-weight: 600;
                font-size: 0.9rem;
                transition: all 0.2s;
                cursor: pointer;
            }
            
            .edit-btn {
                background: rgba(100, 150, 255, 0.2);
                color: #2a3f5f;
                border: 1px solid rgba(100, 150, 255, 0.4);
            }
            
            .edit-btn:hover {
                background: rgba(100, 150, 255, 0.3);
            }
            
            .delete-btn {
                background: rgba(255, 100, 100, 0.2);
                color: #c53030;
                border: 1px solid rgba(255, 100, 100, 0.4);
            }
            
            .delete-btn:hover {
                background: rgba(255, 100, 100, 0.3);
            }
            
            @media (max-width: 768px) {
                .event-card-glass {
                    max-width: 100%;
                }
            }
        </style>
    @endpush
 
    <!-- Buscador Y Cartas y Tables -->
    <div class="panel-custom animated zoomIn" style=' margin: 20px 0;'>
        
        <div class="modern-container-header">
            <div class="modern-header" style="margin-bottom:5px;">
                <span class="text-center color-title" style="font-size:25px">{{ __('Gestionar Eventos') }}</span>
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
            @php $senseiStatus; @endphp
            
            @if($user->role == "sensei")
                @if($user->sensei->dojo)
                    @php $senseiStatus = true; @endphp
                @else
                    @php $senseiStatus = false; @endphp
                @endif
            @else
                @php $senseiStatus = true; @endphp
            @endif

            @if($senseiStatus == true)
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
                                <div class="meta-item">
                                    <span style=" margin-right: 5px">Para: </span>

                                    @foreach($participantTypes as $type)
                                        @if($type == 'dojo')
                                            <span class="description-event" style=" margin-right: 5px"><i class="fas fa-vihara meta-icon" style="margin-right:0"></i> Dojos</span>
                                        @elseif($type == 'sensei')
                                            <span class="description-event" style=" margin-right: 5px"><i class="fas fa-user-ninja meta-icon" style="margin-right:0"></i>Senseis</span>
                                        @elseif($type == 'student')
                                            <span class="description-event"><i class="fas fa-user-graduate meta-icon" style="margin-right:0"></i>Atletas</span>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="meta-item" style="flex-wrap: wrap; gap:3px">
                                    <i class="fa-solid fa-arrows-down-to-people meta-icon"></i>
                                    <span style="margin-right: 6px">N° de Partipantes: </span>
                                    @foreach($participantTypes as $type)
                                        @if($type == 'dojo')
                                            <span class="description-event" style=" margin-right: 5px"><i class="fas fa-vihara meta-icon" style="margin-right:0; color: #c53030ad;"></i> Dojos ({{$event->dojo_count . ' / ' . $event->max_dojo}})</span>
                                        @elseif($type == 'sensei')
                                            <span class="description-event" style=" margin-right: 5px"><i class="fas fa-user-ninja meta-icon" style="margin-right:0;color: #c53030ad;"></i> Senseis ({{$event->sensei_count . ' / ' .$event->max_sensei}})</span>
                                        @elseif($type == 'student')
                                            <span class="description-event" style=" margin-right: 5px"><i class="fas fa-user-graduate meta-icon" style="margin-right:0;color: #c53030ad;"></i> Atletas ({{$event->student_count . ' / ' .$event->max_student}})</span>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <p class="event-description">{{ Str::limit($event->description, 150) }}</p>
                            @if($user->role == "sensei" || $user->role == "estudiante")
                                {{--Sensei--}}
                                @if($user->sensei->dojo->event)
                                    @if($user->sensei->dojo->event->contains('id', $event->id))
                                        <h5 style="background: linear-gradient(135deg, rgb(59 130 246 / 59%), rgb(220 38 38 / 60%));color: #fff; padding: 5px"><i class="fa-solid fa-vihara"></i> Tu Dojo Esta participando</h5>
                                    @endif
                                @endif
                                @if($user->sensei->event)
                                    @if($user->sensei->event->contains('id', $event->id))
                                        <h5 style="background: linear-gradient(135deg, rgb(59 130 246 / 59%), rgb(220 38 38 / 60%));color: #fff; padding: 5px"><i class="fa-solid fa-user-ninja"></i> Estas Participando</h5>
                                    @endif
                                @endif
                                @php
                                    $participatingStudents = $user->sensei->student->filter(fn($student) => $student->event->contains('id', $event->id))->count();
                                @endphp

                                @if($participatingStudents > 0)
                                    <h5 style="background: linear-gradient(135deg, rgb(59 130 246 / 59%), rgb(220 38 38 / 60%)); color: #fff; padding: 5px">
                                        <i class="fa-solid fa-user-graduate"></i> {{ $participatingStudents }} de tus estudiantes{{ $participatingStudents > 1 ? 's' : '' }} están participando
                                    </h5>
                                @endif
                            @endif
                            <!-- Acciones -->
                            @if($user->role == "sensei" || $user->role == "administrador")
                            <div class="event-actions">

                                @foreach($participantTypes as $type)
                                    @if($type == 'dojo')
                                        @if($user->role == "administrador")
                                            <button class="new-btn-ultimate new-btn-ultimate-table" @click="openModalDojo = !openModalDojo" wire:click="addDojo({{ $event->id }}, {{$event->dojo_count}}, {{ $event->max_dojo }})">
                                                <i class="fa-solid fa-vihara" style="font-size:15px"></i>
                                                <span style="font-size:15px">Dojos</span>
                                            </button>
                                        @else
                                            @if($user->sensei->dojo->event)
                                                @if($user->sensei->dojo->event->contains('id', $event->id))
                                                    <button class="delete-btn-ultimate delete-btn-ultimate-table" @click="openConfirm1 = !openConfirm1" wire:click="addDojo({{ $event->id }}, {{$event->dojo_count}}, {{ $event->max_dojo }}, {{$user->sensei->dojo_id}}, 'removeEventDojo')">
                                                        <i class="fa-solid fa-trash" style="font-size:15px"></i>
                                                        <span style="font-size:15px">Dojo</span>
                                                    </button>
                                                @else
                                                    <button class="new-btn-ultimate new-btn-ultimate-table" @click="openConfirm1 = !openConfirm1" wire:click="addDojo({{ $event->id }}, {{$event->dojo_count}}, {{ $event->max_dojo }}, {{$user->sensei->dojo_id}}, 'addDojo')">
                                                        <i class="fa-solid fa-plus" style="font-size:15px"></i>
                                                        <span style="font-size:15px">Dojo</span>
                                                    </button>
                                                @endif
                                            @endif
                                        @endif
                                    @elseif($type == 'sensei')
                                        @if($user->role == "administrador")
                                            <button class="new-btn-ultimate new-btn-ultimate-table" @click="openModalSensei = !openModalSensei" wire:click="addSensei({{ $event->id }}, {{$event->sensei_count}}, {{ $event->max_sensei }})">
                                                <i class="fa-solid fa-user-ninja" style="font-size:15px"></i>
                                                <span style="font-size:15px">Senseis</span>
                                            </button>
                                        @else
                                            @if($user->sensei->event)
                                                @if($user->sensei->event->contains('id', $event->id))
                                                    <button class="delete-btn-ultimate delete-btn-ultimate-table" @click="openConfirm1 = !openConfirm1" wire:click="addSensei({{ $event->id }}, {{$event->sensei_count}}, {{ $event->max_sensei }}, {{$user->sensei->id}}, 'removeEventSensei')">
                                                        <i class="fa-solid fa-trash" style="font-size:15px"></i>
                                                        <span style="font-size:15px">Sensei</span>
                                                    </button>
                                                @else
                                                    <button class="new-btn-ultimate new-btn-ultimate-table" @click="openConfirm1 = !openConfirm1" wire:click="addSensei({{ $event->id }}, {{$event->sensei_count}}, {{ $event->max_sensei }}, {{$user->sensei->id}}, 'addEventSensei')">
                                                        <i class="fa-solid fa-plus" style="font-size:15px"></i>
                                                        <span style="font-size:15px">Sensei</span>
                                                    </button>
                                                @endif
                                            @endif
                                        @endif
                                    @elseif($type == 'student')
                                        <button class="new-btn-ultimate new-btn-ultimate-table" @click="openModalStudent = !openModalStudent" wire:click="addStudent({{ $event->id }}, {{$event->student_count}}, {{ $event->max_student }})">
                                            <i class="fa-solid fa-user-graduate" style="font-size:15px"></i>
                                            <span style="font-size:15px">Atletas</span>
                                        </button>
                                    @endif
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <div class="panel-custom">
                    <h1>No puedes Gestionar Eventos hasta que tengas un Dojo</h1>
                </div>
            @endif
            
        </div>
        @if($senseiStatus == true)
            <div style="padding: 0 10px">{{ $events->links('vendor.livewire.bootstrap') }}</div>
        @endif

    </div>

    <!-- Modal Dojos -->
    <div class="modal-overlay" x-show='openModalDojo' @click.self="openModalDojo = !openModalDojo" x-transition:leave.duration.500ms x-transition:enter.duration.500ms>
        <div class="modal-container " :class="openModalDojo ? 'animated fadeInDown' : 'animated zoomOut'" style="max-width:90vw">
            <button class="close-btn-image" @click="openModalDojo = !openModalDojo">&times;</button>
            <div class="modern-container-header" style="justify-content:space-around; flex-wrap:wrap; gap:15px; margin-bottom:20px">
                <div class="modern-header">
                    <span class="text-center color-title">{{ __('Dojos Disponibles') }}</span>
                    <span class="text-center color-paragraph"
                        style="margin:0px;">{{ __('Agrega o elimina Dojos al Evento') }}</span>
                </div> 
                <div class="modern-header">
                    <span class="text-center color-title">{{ __('Ver Dojos') }}</span>
                    <div class="" style="display: flex;gap: 10px">
                        <button class="edit-btn-ultimate" 
                            wire:click="dojosActive" 
                            @click="activeButton = 'sensei'"
                            :class="activeButton === 'noSensei' ? 'active' : ''">
                            <i class="fa-solid fa-vihara"></i>
                            <span style="font-weight:700">Disponibles</span>
                        </button>

                        <button class="edit-btn-ultimate" 
                            wire:click="dojosInactive" 
                            @click="activeButton = 'noSensei'"
                            :class="activeButton === 'sensei' ? 'active' : ''">
                            <i class="fa-solid fa-vihara"></i>
                            <span style="font-weight:700">Seleccionados</span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Búsqueda -->
            <div class="table-controls">
                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass" style="color:#002569"></i>
                    <input wire:model.live="searchDojo" type="text" placeholder="Buscar Dojos..." class="search-input">
                </div>

                <!-- Select -->
                <div class="custom-select-container" wire:ignore.self>
                    <div class="custom-select active" x-data="{ isOpen: false }" @click="isOpen = !isOpen" x-cloak>
                        <div class="selected-option">
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
            <!-- Card Dojos -->
            <div class="grid-container animated zoomIn" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));">
                @if($dojosActive->count() > 0 && $dojosActiveSelected && $dojoCount < $dojoMaxCount)
                    @foreach ($dojosActive as $dojo)
                        <div class="dojo-card-ultimate @if ($changeTable) animated fadeIn @endif"
                            wire:key='register-{{ $dojo->id }}' style="flex-direction: column;max-width: 180px;min-height: auto;">
                            <div class="dojo-image-container-ultimate" style="width: 100%;height: 180px;min-width: auto;">
                                @if ($dojo->photo)
                                    <div class="dojo-image-ultimate">
                                        <img src="{{ asset('storage/' . $dojo->photo) }}">
                                    </div>
                                @else
                                    <div class="dojo-image-ultimate">
                                        <img src="{{ asset('image/dojo-default.jpg') }}">
                                    </div>
                                @endif
                            </div>
                            <div class="dojo-content-ultimate" style="width: 100%; height: 140px">

                                <i x-show="activeButton == 'sensei'" wire:click='modalConfirmDojo("addDojo", {{$dojo->id}})' class="fa-solid fa-circle-plus new-btn-ultimate new-btn-ultimate-table" style="background-color:white;padding:5px;position:absolute; top:10px; right:7px; font-size:17px;z-index:1000;border-radius:20px" @click="openConfirm1 = !openConfirm1"></i>
                                <div class="dojo-text-content" style="margin:0; color:#2f3134; display:flex; flex-direction:column; gap:5px">
                                    
                                    <h4 class="dojo-title-ultimate">{{ $dojo->name }}</h4>
                                    <div class="" style="font-size:13px"><i class="fa-solid fa-location-dot"></i> {{ $dojo->location }}</div>
                                    <div class="" style="font-size:13px"><i class="fa-solid fa-user-ninja"></i> Sensei: {{$dojo->sensei->name}}</div>
                                    <div class="" style="font-size:13px"><i class="fa-solid fa-users"></i> Alumnos: {{$dojo->student->count()}}</div>
                                </div>  
                            </div>
                        </div>
                    @endforeach
                @elseif($dojosActiveSelected && $dojoCount < $dojoMaxCount)
                    <div style="width:100%">
                        <div class="modal-container" style="max-width:500px; margin:0 auto">
                            <div class="modern-container-header">
                                <div class="modern-header">
                                    <i class="fa-solid fa-triangle-exclamation fa-beat"
                                        style="font-size: 1.8rem; color: #ac2b2b; margin-bottom: 15px; font-size:50px; display:block"></i>
                                    <span class="text-center color-title">{{ __('Algo Ocurrio') }}</span>
                                </div>
                            </div>  
                            <div class="panel-body">
                                <h3 class=" text-center alert alert-danger" style="margin:15px 0;font-size:20px">No se encuentran Dojos Disponibles</h3>
                            </div>
                        </div>
                    </div>
                @elseif($dojosActiveSelected && $dojoCount >= $dojoMaxCount)
                    <div style="width:100%">
                        <div class="modal-container" style="max-width:500px; margin:0 auto">
                            <div class="modern-container-header">
                                <div class="modern-header">
                                    <i class="fa-solid fa-triangle-exclamation fa-beat"
                                        style="font-size: 1.8rem; color: #ac2b2b; margin-bottom: 15px; font-size:50px; display:block"></i>
                                    <span class="text-center color-title">{{ __('Algo Ocurrio') }}</span>
                                </div>
                            </div>  
                            <div class="panel-body">
                                <h3 class=" text-center alert alert-danger" style="margin:15px 0;font-size:20px">El evento llego al numero Maximo de Dojos</h3>
                            </div>
                        </div>
                    </div>
                @endif
                @if($dojosInactive->count() > 0 && $dojosInactiveSelected)
                    @foreach ($dojosInactive as $dojo)
                        <div class="dojo-card-ultimate @if ($changeTable) animated fadeIn @endif"
                            wire:key='register-{{ $dojo->id }}' style="flex-direction: column;max-width: 180px;min-height: auto;">
                            <div class="dojo-image-container-ultimate" style="width: 100%;height: 180px;min-width: auto;">
                                @if ($dojo->photo)
                                    <div class="dojo-image-ultimate">
                                        <img src="{{ asset('storage/' . $dojo->photo) }}">
                                    </div>
                                @else
                                    <div class="dojo-image-ultimate">
                                        <img src="{{ asset('image/dojo-default.jpg') }}">
                                    </div>
                                @endif
                            </div>
                            <div class="dojo-content-ultimate" style="width: 100%; height: 140px">

                                <i x-show="activeButton == 'noSensei'" wire:click='modalConfirmDojo("removeEventDojo", {{$dojo->id}})' class="fa-solid fa-trash delete-btn-ultimate delete-btn-ultimate-table" style="background-color:white;padding:5px;position:absolute; top:10px; right:7px; font-size:17px;z-index:1000;border-radius:20px" @click="openConfirm1 = !openConfirm1"></i>
                                <div class="dojo-text-content" style="margin:0; color:#2f3134">
                                    
                                    <h4 class="dojo-title-ultimate">{{ $dojo->name }}</h4>
                                    <div class="" style="font-size:13px"><i class="fa-solid fa-location-dot"></i> {{ $dojo->location }}</div>
                                    <div class="" style="font-size:13px"><i class="fa-solid fa-user-ninja"></i> Sensei: {{$dojo->sensei->name}}</div>
                                    <div class="" style="font-size:13px"><i class="fa-solid fa-users"></i> Alumnos: {{$dojo->student->count()}}</div>
                                </div>  
                            </div>
                        </div>
                    @endforeach
                @elseif($dojosInactiveSelected)
                    <div style="width:100%">
                        <div class="modal-container" style="max-width:500px; margin:0 auto">
                            <div class="modern-container-header">
                                <div class="modern-header">
                                    <i class="fa-solid fa-triangle-exclamation fa-beat"
                                        style="font-size: 1.8rem; color: #ac2b2b; margin-bottom: 15px; font-size:50px; display:block"></i>
                                    <span class="text-center color-title">{{ __('Algo Ocurrio') }}</span>
                                </div>
                            </div>  
                            <div class="panel-body">
                                <h3 class=" text-center alert alert-danger" style="margin:15px 0;font-size:20px">No se encuentran Dojos Disponibles</h3>
                            </div>
                        </div>
                    </div>
                @endif           
            </div>
            @if($dojosActive && $dojosActiveSelected)
                {{ $dojosActive->links('vendor.livewire.bootstrap') }}
            @elseif($dojosInactive && $dojosInactiveSelected)
                {{ $dojosInactive->links('vendor.livewire.bootstrap') }}
            @endIf
        </div>
    </div>

    <!-- Modal Senseis -->
    <div class="modal-overlay" x-show='openModalSensei' @click.self="openModalSensei = !openModalSensei" x-transition:leave.duration.500ms x-transition:enter.duration.500ms>
        <div class="modal-container " :class="openModalSensei ? 'animated fadeInDown' : 'animated zoomOut'" style="max-width:90vw">
            <button class="close-btn-image" @click="openModalSensei = !openModalSensei">&times;</button>
            <div class="modern-container-header" style="justify-content:space-around; flex-wrap:wrap; gap:15px; margin-bottom:20px">
                <div class="modern-header">
                    <span class="text-center color-title">{{ __('Senseis Disponibles') }}</span>
                    <span class="text-center color-paragraph"
                        style="margin:0px;">{{ __('Agrega o elimina un Senseis al Evento') }}</span>
                </div> 
                <div class="modern-header">
                    <span class="text-center color-title">{{ __('Ver Senseis') }}</span>
                    <div class="" style="display: flex;gap: 10px">
                        <button class="edit-btn-ultimate" 
                            wire:click="senseisActive" 
                            @click="activeButton = 'sensei'"
                            :class="activeButton === 'noSensei' ? 'active' : ''">
                            <i class="fa-solid fa-user-ninja"></i>
                            <span style="font-weight:700">Disponibles</span>
                        </button>

                        <button class="edit-btn-ultimate" 
                            wire:click="senseisInactive" 
                            @click="activeButton = 'noSensei'"
                            :class="activeButton === 'sensei' ? 'active' : ''">
                            <i class="fa-solid fa-user-ninja"></i>
                            <span style="font-weight:700">Seleccionados</span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Búsqueda -->
            <div class="table-controls">
                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass" style="color:#002569"></i>
                    <input wire:model.live="searchSensei" type="text" placeholder="Buscar Senseis..." class="search-input">
                </div>

                <!-- Select -->
                <div class="custom-select-container" wire:ignore.self>
                    <div class="custom-select active" x-data="{ isOpen: false }" @click="isOpen = !isOpen" x-cloak>
                        <div class="selected-option">
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
            
            <!-- Card Senseis -->
            <div class="grid-container animated zoomIn" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));">
                @if($senseisActive->count() > 0 && $senseisActiveSelected && $senseiCount < $senseiMaxCount)
                    @foreach ($senseisActive as $sensei)
                        <div class="dojo-card-ultimate @if ($changeTable) animated fadeIn @endif"
                            wire:key='register-{{ $sensei->id }}' style="flex-direction: column;max-width: 180px;min-height: auto;">
                            <div class="dojo-image-container-ultimate" style="width: 100%;height: 180px;min-width: auto;">
                                @if ($sensei->photo)
                                    <div class="dojo-image-ultimate">
                                        <img src="{{ asset('storage/' . $sensei->photo) }}">
                                    </div>
                                @else
                                    <div class="dojo-image-ultimate">
                                        <img src="{{ asset('image/dojo-default.jpg') }}">
                                    </div>
                                @endif
                            </div>
                            <div class="dojo-content-ultimate" style="width: 100%; height: 140px">

                                <i x-show="activeButton == 'sensei'" wire:click='modalConfirmSensei("addEventSensei", {{$sensei->id}})' class="fa-solid fa-circle-plus new-btn-ultimate new-btn-ultimate-table" style="background-color:white;padding:5px;position:absolute; top:10px; right:7px; font-size:17px;z-index:1000;border-radius:20px" @click="openConfirm1 = !openConfirm1"></i>
                                <div class="dojo-text-content" style="margin:0; color:#2f3134; display:flex; flex-direction:column; gap:5px">
                                    
                                    <h4 class="dojo-title-ultimate">{{ $sensei->name }}</h4>
                                    <div class="" style="font-size:13px"><i class="fa-solid fa-ribbon"></i> {{ $sensei->dan }}</div>
                                    @if($sensei->dojo)
                                        <div class="" style="font-size:13px"><i class="fa-solid fa-user-vihara"></i> Dojo: {{$sensei->dojo->name}}</div>
                                        <div class="" style="font-size:13px"><i class="fa-solid fa-users"></i> Alumnos: {{$sensei->student->count()}}</div>
                                    @else
                                        <div class="" style="font-size:13px"><i class="fa-solid fa-exclamation-circle"></i> Este sensei se encuentra Inactivo</div>
                                    @endif
                                </div>  
                            </div>
                        </div>
                    @endforeach
                @elseif($senseisActiveSelected && $senseiCount < $senseiMaxCount)
                    <div style="width:100%">
                        <div class="modal-container" style="max-width:500px; margin:0 auto">
                            <div class="modern-container-header">
                                <div class="modern-header">
                                    <i class="fa-solid fa-triangle-exclamation fa-beat"
                                        style="font-size: 1.8rem; color: #ac2b2b; margin-bottom: 15px; font-size:50px; display:block"></i>
                                    <span class="text-center color-title">{{ __('Algo Ocurrio') }}</span>
                                </div>
                            </div>  
                            <div class="panel-body">
                                <h3 class=" text-center alert alert-danger" style="margin:15px 0;font-size:20px">No se encuentran Estudiantes Disponibles</h3>
                            </div>
                        </div>
                    </div>
                @elseif($senseisActiveSelected && $senseiCount >= $senseiMaxCount)
                    <div style="width:100%">
                        <div class="modal-container" style="max-width:500px; margin:0 auto">
                            <div class="modern-container-header">
                                <div class="modern-header">
                                    <i class="fa-solid fa-triangle-exclamation fa-beat"
                                        style="font-size: 1.8rem; color: #ac2b2b; margin-bottom: 15px; font-size:50px; display:block"></i>
                                    <span class="text-center color-title">{{ __('Algo Ocurrio') }}</span>
                                </div>
                            </div>  
                            <div class="panel-body">
                                <h3 class=" text-center alert alert-danger" style="margin:15px 0;font-size:20px">El evento llego al numero Maximo de Senseis</h3>
                            </div>
                        </div>
                    </div>
                @endif
                @if($senseisInactive->count() > 0 && $senseisInactiveSelected)
                    @foreach ($senseisInactive as $sensei)
                        <div class="dojo-card-ultimate @if ($changeTable) animated fadeIn @endif"
                            wire:key='register-{{ $sensei->id }}' style="flex-direction: column;max-width: 180px;min-height: auto;">
                            <div class="dojo-image-container-ultimate" style="width: 100%;height: 180px;min-width: auto;">
                                @if ($sensei->photo)
                                    <div class="dojo-image-ultimate">
                                        <img src="{{ asset('storage/' . $sensei->photo) }}">
                                    </div>
                                @else
                                    <div class="dojo-image-ultimate">
                                        <img src="{{ asset('image/dojo-default.jpg') }}">
                                    </div>
                                @endif
                            </div>
                            <div class="dojo-content-ultimate" style="width: 100%; height: 140px">

                                <i x-show="activeButton == 'noSensei'" wire:click='modalConfirmSensei("removeEventSensei", {{$sensei->id}})' class="fa-solid fa-trash delete-btn-ultimate delete-btn-ultimate-table" style="background-color:white;padding:5px;position:absolute; top:10px; right:7px; font-size:17px;z-index:1000;border-radius:20px" @click="openConfirm1 = !openConfirm1"></i>
                                <div class="dojo-text-content" style="margin:0; color:#2f3134">
                                    
                                    <h4 class="dojo-title-ultimate">{{ $sensei->name }}</h4>
                                    <div class="" style="font-size:13px"><i class="fa-solid fa-ribbon"></i> {{ $sensei->dan }}</div>
                                    @if($sensei->dojo)
                                        <div class="" style="font-size:13px"><i class="fa-solid fa-user-vihara"></i> Dojo: {{$sensei->dojo->name}}</div>
                                        <div class="" style="font-size:13px"><i class="fa-solid fa-users"></i> Alumnos: {{$sensei->student->count()}}</div>
                                    @else
                                        <div class="" style="font-size:13px"><i class="fa-solid fa-exclamation-circle"></i> Este sensei se encuentra Inactivo</div>
                                    @endif

                                </div>  
                            </div>
                        </div>
                    @endforeach
                @elseif($senseisInactiveSelected)
                    <div style="width:100%">
                        <div class="modal-container" style="max-width:500px; margin:0 auto">
                            <div class="modern-container-header">
                                <div class="modern-header">
                                    <i class="fa-solid fa-triangle-exclamation fa-beat"
                                        style="font-size: 1.8rem; color: #ac2b2b; margin-bottom: 15px; font-size:50px; display:block"></i>
                                    <span class="text-center color-title">{{ __('Algo Ocurrio') }}</span>
                                </div>
                            </div>  
                            <div class="panel-body">
                                <h3 class=" text-center alert alert-danger" style="margin:15px 0;font-size:20px">No se encuentran Estudiantes Disponibles</h3>
                            </div>
                        </div>
                    </div>
                @endif           
            </div>
            @if($senseisActive && $senseisActiveSelected)
                {{ $senseisActive->links('vendor.livewire.bootstrap') }}
            @elseif($senseisInactive && $senseisInactiveSelected)
                {{ $senseisInactive->links('vendor.livewire.bootstrap') }}
            @endIf
        </div>
    </div>

    <!-- Modal Alumnos -->
    <div class="modal-overlay" x-show='openModalStudent' @click.self="openModalStudent = !openModalStudent" x-transition:leave.duration.500ms x-transition:enter.duration.500ms>
        <div class="modal-container " :class="openModalStudent ? 'animated fadeInDown' : 'animated zoomOut'" style="max-width:90vw">
            <button class="close-btn-image" @click="openModalStudent = !openModalStudent">&times;</button>
            <div class="modern-container-header" style="justify-content:space-around; flex-wrap:wrap; gap:15px; margin-bottom:20px">
                <div class="modern-header">
                    <span class="text-center color-title">{{ __('Estudiantes Disponibles') }}</span>
                    <span class="text-center color-paragraph"
                        style="margin:0px;">{{ __('Agrega o elimina Estudiantes al Evento') }}</span>
                </div> 
                <div class="modern-header">
                    <span class="text-center color-title">{{ __('Ver Estudiantes') }}</span>
                    <div class="" style="display: flex;gap: 10px">
                        <button class="edit-btn-ultimate" 
                            wire:click="studentsActive" 
                            @click="activeButton = 'sensei'"
                            :class="activeButton === 'noSensei' ? 'active' : ''">
                            <i class="fa-solid fa-user-graduate"></i>
                            <span style="font-weight:700">Disponibles</span>
                        </button>

                        <button class="edit-btn-ultimate" 
                            wire:click="studentsInactive" 
                            @click="activeButton = 'noSensei'"
                            :class="activeButton === 'sensei' ? 'active' : ''">
                            <i class="fa-solid fa-user-graduate"></i>
                            <span style="font-weight:700">Seleccionados</span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Búsqueda -->
            <div class="table-controls">
                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass" style="color:#002569"></i>
                    <input wire:model.live="searchStudent" type="text" placeholder="Buscar Alumnos..." class="search-input">
                </div>

                <!-- Select -->
                <div class="custom-select-container" wire:ignore.self>
                    <div class="custom-select active" x-data="{ isOpen: false }" @click="isOpen = !isOpen" x-cloak>
                        <div class="selected-option">
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
            <!-- Card Students -->
            <div class="grid-container animated zoomIn" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));">
                @if($studentsActive->count() > 0 && $studentsActiveSelected && $studentCount < $studentMaxCount)
                    @foreach ($studentsActive as $student)
                        <div class="dojo-card-ultimate @if ($changeTable) animated fadeIn @endif"
                            wire:key='register-{{ $student->id }}' style="flex-direction: column;max-width: 180px;min-height: auto;">
                            <div class="dojo-image-container-ultimate" style="width: 100%;height: 180px;min-width: auto;">
                                @if ($student->photo)
                                    <div class="dojo-image-ultimate">
                                        <img src="{{ asset('storage/' . $student->photo) }}">
                                    </div>
                                @else
                                    <div class="dojo-image-ultimate">
                                        <img src="{{ asset('image/dojo-default.jpg') }}">
                                    </div>
                                @endif
                            </div>
                            <div class="dojo-content-ultimate" style="width: 100%;height: 140px">

                                <i x-show="activeButton == 'sensei'" wire:click='modalConfirmStudent("addEventStudent", {{$student->id}})' class="fa-solid fa-circle-plus new-btn-ultimate new-btn-ultimate-table" style="background-color:white;padding:5px;position:absolute; top:10px; right:7px; font-size:17px;z-index:1000;border-radius:20px" @click="openConfirm1 = !openConfirm1"></i>
                                <div class="dojo-text-content" style="margin:0; color:#2f3134; display:flex; flex-direction:column; gap:5px">
                                    
                                    <h4 class="dojo-title-ultimate">{{ $student->name }}</h4>
                                    <div class="" style="font-size:13px"><i class="fa-solid fa-ribbon"></i> {{ $student->kyu }}</div>

                                    @if($student->dojo_id)
                                        <div class="" style="font-size:13px"><i class="fa-solid fa-user-vihara"></i> Dojo: {{$student->dojo->name}}</div>
                                        <div class="" style="font-size:13px"><i class="fa-solid fa-user-ninja"></i> Sensei: {{$student->sensei->name ?? 'no tiene sensei asignado'}}</div>
                                    @else
                                        <div class="" style="font-size:13px"><i class="fa-solid fa-exclamation-circle"></i> Este estudiante se encuentra Inactivo</div>
                                    @endif
                                </div>  
                            </div>
                        </div>
                    @endforeach
                @elseif($studentsActiveSelected && $studentCount < $studentMaxCount)
                    <div style="width:100%">
                        <div class="modal-container" style="max-width:500px; margin:0 auto">
                            <div class="modern-container-header">
                                <div class="modern-header">
                                    <i class="fa-solid fa-triangle-exclamation fa-beat"
                                        style="font-size: 1.8rem; color: #ac2b2b; margin-bottom: 15px; font-size:50px; display:block"></i>
                                    <span class="text-center color-title">{{ __('Algo Ocurrio') }}</span>
                                </div>
                            </div>  
                            <div class="panel-body">
                                <h3 class=" text-center alert alert-danger" style="margin:15px 0;font-size:20px">No se encuentran Estudiantes Disponibles</h3>
                            </div>
                        </div>
                    </div>
                @elseif($studentsActiveSelected && $studentCount >= $studentMaxCount)
                    <div style="width:100%">
                        <div class="modal-container" style="max-width:500px; margin:0 auto">
                            <div class="modern-container-header">
                                <div class="modern-header">
                                    <i class="fa-solid fa-triangle-exclamation fa-beat"
                                        style="font-size: 1.8rem; color: #ac2b2b; margin-bottom: 15px; font-size:50px; display:block"></i>
                                    <span class="text-center color-title">{{ __('Algo Ocurrio') }}</span>
                                </div>
                            </div>  
                            <div class="panel-body">
                                <h3 class=" text-center alert alert-danger" style="margin:15px 0;font-size:20px">El evento llego al numero Maximo de Atletas</h3>
                            </div>
                        </div>
                    </div>
                @endif
                @if($studentsInactive->count() > 0 && $studentsInactiveSelected)
                    @foreach ($studentsInactive as $student)
                        <div class="dojo-card-ultimate @if ($changeTable) animated fadeIn @endif"
                            wire:key='register-{{ $student->id }}' style="flex-direction: column;max-width: 180px;min-height: auto;">
                            <div class="dojo-image-container-ultimate" style="width: 100%;height: 180px;min-width: auto;">
                                @if ($student->photo)
                                    <div class="dojo-image-ultimate">
                                        <img src="{{ asset('storage/' . $student->photo) }}">
                                    </div>
                                @else
                                    <div class="dojo-image-ultimate">
                                        <img src="{{ asset('image/dojo-default.jpg') }}">
                                    </div>
                                @endif
                            </div>
                            <div class="dojo-content-ultimate" style="width: 100%;height: 140px">

                                <i x-show="activeButton == 'noSensei'" wire:click='modalConfirmStudent("removeEventStudent", {{$student->id}})' class="fa-solid fa-trash delete-btn-ultimate delete-btn-ultimate-table" style="background-color:white;padding:5px;position:absolute; top:10px; right:7px; font-size:17px;z-index:1000;border-radius:20px" @click="openConfirm1 = !openConfirm1"></i>
                                <div class="dojo-text-content" style="margin:0; color:#2f3134">
                                    
                                    <h4 class="dojo-title-ultimate">{{ $student->name }}</h4>
                                    <div class="" style="font-size:13px"><i class="fa-solid fa-ribbon"></i> {{ $student->kyu }}</div>
                                    @if($student->dojo_id)
                                        <div class="" style="font-size:13px"><i class="fa-solid fa-user-vihara"></i> Dojo: {{$student->dojo->name}}</div>
                                        <div class="" style="font-size:13px"><i class="fa-solid fa-user-ninja"></i> Sensei: {{$student->sensei->name ?? 'no tiene sensei asignado'}}</div>
                                    @else
                                        <div class="" style="font-size:13px"><i class="fa-solid fa-exclamation-circle"></i> Este estudiante se encuentra Inactivo</div>
                                    @endif
                                </div>  
                            </div>
                        </div>
                    @endforeach
                @elseif($studentsInactiveSelected)
                    <div style="width:100%">
                        <div class="modal-container" style="max-width:500px; margin:0 auto">
                            <div class="modern-container-header">
                                <div class="modern-header">
                                    <i class="fa-solid fa-triangle-exclamation fa-beat"
                                        style="font-size: 1.8rem; color: #ac2b2b; margin-bottom: 15px; font-size:50px; display:block"></i>
                                    <span class="text-center color-title">{{ __('Algo Ocurrio') }}</span>
                                </div>
                            </div>  
                            <div class="panel-body">
                                <h3 class=" text-center alert alert-danger" style="margin:15px 0;font-size:20px">No se encuentran Estudiantes Disponibles</h3>
                            </div>
                        </div>
                    </div>
                @endif           
            </div>
            @if($studentsActive && $studentsActiveSelected)
                {{ $studentsActive->links('vendor.livewire.bootstrap') }}
            @elseif($studentsInactive && $studentsInactiveSelected)
                {{ $studentsInactive->links('vendor.livewire.bootstrap') }}
            @endIf
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
                    {{ $message ?? ''}}
                </h3>
            </div>
        </div>
    </div>

    <!-- Confirmar Agregar Dojo -->
    <div x-show='openConfirm1' wire:key="destroy-modal" class="modal-overlay" @click.self="openConfirm1 = !openConfirm1" x-transition:leave.duration.500ms x-transition:enter.duration.500ms>
        <div class="modal-container" style="max-width:400px" :class="openConfirm1 ? 'animated fadeInDown' : 'animated zoomOut'">
            <div class="modern-container-header">
                <div class="modern-header">
                    <i class="fa-solid fa-gears fa-beat"
                        style="font-size: 1.8rem; color: #219dbcdd; margin-bottom: 15px; font-size:50px; display:block"></i>
                    <span class="text-center color-title" style="font-size: 2rem">{{ __('¿Esta Seguro que quiere hacer los cambios?') }}</span>
                </div>
            </div>
            <div class="panel-body">
                <div class="row" style="margin-top:20px">
                    <div class="col-sm-12" style="display: flex; justify-content: center; gap:10px;">
                        <button class="cancel-btn-ultimate" type="button" @click="openConfirm1 = !openConfirm1">
                            <i style="font-size:17px" class="fa-solid fa-xmark"></i>
                            <span style="font-size:17px">Cancelar</span>
                        </button>

                        @if($statusModalConfirm == 'addDojo')
                            <button class="new-btn-ultimate" type="button" wire:click='addEventDojo' @click="openConfirm1 = !openConfirm1">
                                <i class="fa-solid fa-check" style="font-size:17px"></i>
                                <span style="font-size:17px">Guardar</span>
                            </button>
                        @elseif($statusModalConfirm == 'removeEventDojo')
                            <button class="new-btn-ultimate" type="button" wire:click='removeEventDojo' @click="openConfirm1 = !openConfirm1">
                                <i class="fa-solid fa-check" style="font-size:17px"></i>
                                <span style="font-size:17px">Guardar</span>
                            </button>
                        @elseif($statusModalConfirm == 'addEventSensei')
                        <button class="new-btn-ultimate" type="button" wire:click='addEventSensei' @click="openConfirm1 = !openConfirm1">
                            <i class="fa-solid fa-check" style="font-size:17px"></i>
                            <span style="font-size:17px">Guardar</span>
                        </button>
                        @elseif($statusModalConfirm == 'removeEventSensei')
                            <button class="new-btn-ultimate" type="button" wire:click='removeEventSensei' @click="openConfirm1 = !openConfirm1">
                                <i class="fa-solid fa-check" style="font-size:17px"></i>
                                <span style="font-size:17px">Guardar</span>
                            </button>
                        @elseif($statusModalConfirm == 'addEventStudent')
                        <button class="new-btn-ultimate" type="button" wire:click='addEventStudent' @click="openConfirm1 = !openConfirm1">
                            <i class="fa-solid fa-check" style="font-size:17px"></i>
                            <span style="font-size:17px">Guardar</span>
                        </button>
                        @elseif($statusModalConfirm == 'removeEventStudent')
                            <button class="new-btn-ultimate" type="button" wire:click='removeEventStudent' @click="openConfirm1 = !openConfirm1">
                                <i class="fa-solid fa-check" style="font-size:17px"></i>
                                <span style="font-size:17px">Guardar</span>
                            </button>
                        @endif
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
