<div x-data="{ open: false , openStudent: false,activeButton: 'sensei', openConfirm1: false, openSensei: false, openModal:false, openModalEdit: false}" x-cloak @close-modal.window="openModal = false ; openModalEdit = false">

    @push('styles')
        <style>
            :root {
                --primary-blue: rgba(100, 149, 237, 0.8);
                --primary-pink: rgba(219, 112, 147, 0.8);
                --light-bg: rgba(255, 255, 255, 0.85);
                --shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            }

            .dojos-container {
                max-width: 1000px;
                margin: 0 auto;
                padding: 20px;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }

            .dojo-card {
                background: #ffffff3e;
                border-radius: 12px;
                padding: 25px;
                margin-bottom: 30px;
                box-shadow: var(--shadow);
                border: 1px solid rgba(255, 255, 255, 0.5);
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
            }

            .dojo-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 5px;
                background: linear-gradient(90deg, var(--primary-blue), var(--primary-pink));
            }

            .dojo-header {
                display: flex;
                flex-wrap: wrap;
                gap: 0 25px;
                margin-bottom: 20px;
                padding: 10px;
                align-items: flex-start;
                background: linear-gradient(135deg, rgb(59 130 246 / 10%), rgb(220 38 38 / 5%));
                border-left: 4px solid var(--primary-pink);
                border-radius: 10px;
            }

            .dojo-image-view img {
                width: 180px;
                height: 120px;
                object-fit: cover;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                border: 2px solid white;
            }

            .dojo-details h3 {
                color: #2c3e50;
                margin: 0 0 10px 0;
                font-size: 1.6rem;
                font-weight: 700;
            }

            .dojo-meta {
                display: flex;
                gap: 15px;
                margin-bottom: 10px;
                color: #7f8c8d;
                font-size: 15px;
            }

            .dojo-meta i {
                margin-right: 5px;
                color: var(--primary-blue);
            }

            .description {
                color: #555;
                line-height: 1.5;
                margin: 0;
            }

            .sensei-section {
                margin: 20px 0;
               ;
                background: linear-gradient(135deg, rgb(59 130 246 / 10%), rgb(220 38 38 / 5%));
                border-radius: 10px;
                border-left: 4px solid var(--primary-pink);
            }

            .sensei-card {
                display: flex;
                gap: 20px;
                align-items: center;
                flex-wrap: wrap;
            }

            .sensei-image img {
                width: 125px;
                height: 125px;
                border-radius: 50%;
                object-fit: cover;
                border: 3px solid white;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            .sensei-details h4 {
                margin: 0 0 8px 0;
                color: #2c3e50;
                font-size: 20px;
            }

            .sensei-info {
                display: flex;
                gap: 15px;
                margin-bottom: 10px;
                flex-wrap: wrap;
            }

            .sensei-info span {
                display: flex;
                align-items: center;
                gap: 5px;
                font-size: 0.9rem;
                color: #555;
            }

            .badge {
                padding: 3px 10px;
                border-radius: 20px;
                font-weight: 600;
                font-size: 0.8rem;
            }

            .dan-badge {
                background: linear-gradient(135deg, rgb(59 130 246 / 65%), rgb(220 38 38 / 76%));
                color: white;
            }

            .kyu-badge {
                background-color: var(--primary-blue);
                color: white;
            }

            .students-controls {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin: 20px 0 15px 0;
                flex-wrap: wrap;
                gap: 10px 0;
            }

            .btn-toggle,
            .btn-add,
            .btn-change,
            .btn-delete {
                border: none;
                padding: 8px 15px;
                border-radius: 6px;
                cursor: pointer;
                display: flex;
                align-items: center;
                gap: 8px;
                transition: all 0.2s ease;
                font-weight: 500;
            }

            .btn-toggle {
                background: linear-gradient(135deg, var(--primary-blue), var(--primary-pink));
                color: white;
            }

            .btn-toggle:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            }

            .btn-add {
                background-color: #2ecc71;
                color: white;
            }

            .btn-add:hover {
                background-color: #27ae60;
            }

            .btn-change {
                background-color: #f39c12;
                color: white;
                margin-top: 10px;
            }

            .btn-change:hover {
                background-color: #e67e22;
            }

            .btn-delete {
                background-color: #e74c3c;
                color: white;
                padding: 6px 10px;
                border-radius: 50%;
                margin-left: auto;
            }

            .btn-delete:hover {
                background-color: #c0392b;
            }

            .students-container {
                margin-top: 15px;
                padding-top: 15px;
                border-top: 1px dashed rgba(100, 149, 237, 0.3);
            }

            .students-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 15px;
            }

            .student-card {
                display: flex;
                align-items: center;
                gap: 15px;
                background: linear-gradient(135deg, rgb(59 130 246 / 10%), rgb(220 38 38 / 5%));
                padding: 6px;
                border-radius: 8px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
                transition: transform 0.2s ease, box-shadow 0.2s ease;
                border-left: 3px solid var(--primary-blue);
            }

            .student-card:hover {
                transform: translateY(-3px);
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            }

            .student-image img {
                width: 80px;
                height: 80px;
                border-radius: 50%;
                object-fit: cover;
                border: 2px solid white;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            .student-info {
                flex-grow: 1;
            }

            .student-info h5 {
                margin: 0 0 3px 0;
                color: #2c3e50;
                font-size: 18px;
            }

            .student-meta {
                display: flex;
                gap: 10px;
                font-size: 0.85rem;
                color: #7f8c8d;
            }

            
            .schedule-section {
                background: linear-gradient(135deg, rgb(59 130 246 / 10%), rgb(220 38 38 / 5%));
                backdrop-filter: blur(12px);
                border-radius: 20px;
                padding: 15px;
                margin: 20px 0;
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
                border: 1px solid rgba(255, 255, 255, 0.4);
                overflow: hidden;
                position: relative;
                max-width: 900px;
                margin-left: auto;
                margin-right: auto;
            }

            

            .schedule-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .schedule-header h3 {
                color: #2a3f5f;
                font-size: 1.8rem;
                font-weight: 700;
                text-shadow: 0 2px 4px rgba(0,0,0,0.1);
                margin: 0;
            }

            .edit-schedule-btn {
                background: rgba(255, 255, 255, 0.8);
                border: none;
                color: #2a3f5f;
                padding: 10px 20px;
                border-radius: 30px;
                cursor: pointer;
                font-size: 1rem;
                font-weight: 600;
                display: flex;
                align-items: center;
                gap: 8px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;
            }

            .edit-schedule-btn:hover {
                background: rgba(255, 255, 255, 1);
                transform: translateY(-2px);
                box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            }

            .schedule-days {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
                gap: 20px;
                margin-top: 15px;
            }

            .day-card {
                background: rgba(255, 255, 255, 0.75);
                border-radius: 15px;
                padding: 10px 10px;
                text-align: center;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
                transition: all 0.3s ease;
                border: 1px solid rgba(255, 255, 255, 0.5);
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }

            .day-card:hover {
                transform: translateY(-3px);
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
                background: rgba(255, 255, 255, 0.95);
            }

            .day-name {
                font-weight: 700;
                color: #2a3f5f;
                margin-bottom: 10px;
                font-size: 1.8rem;
                letter-spacing: 0.5px;
            }

            .day-description{
                background: linear-gradient(135deg, rgb(59 130 246 / 10%), rgb(220 38 38 / 5%));
                border-radius: 10px;
                margin-bottom: 5px;
                width: 70%;
                padding: 5px;
                transition: all 0.3s ease;

            }

            .day-description:hover{
                background: linear-gradient(135deg, rgb(59 130 246 / 30%), rgb(220 38 38 / 20%));
            }

            .class-time {
                color: #4a5568;
                font-weight: 500;
            }

            .rest-day {
                background: rgba(230, 230, 250, 0.8);
            }

            .rest-day .day-name {
                color: #6b46c1;
            }

            .rest-day .class-time {
                color: #805ad5;
                font-style: italic;
                font-size: 1.5rem;
            }

            .weekend {
                background: rgba(255, 240, 240, 0.8);
            }

            .weekend .day-name {
                color: #c53030;
            }

            .weekend .class-time {
                color: #e53e3e;
            }

            @media (max-width: 768px) {
                .schedule-header {
                    flex-direction: column;
                    gap: 15px;
                }
                
                .schedule-days {
                    grid-template-columns: repeat(2, 1fr));
                }
            }

            @media (max-width: 480px) {
                .schedule-days {
                    grid-template-columns: 1fr;
                }

                .dojo-header {
                    flex-direction: column;
                }
                
                .day-name {
                    font-size: 1.5rem;
                }
                
                .class-time {
                    font-size: 1.3rem;
                }
            }

            /* Efectos y animaciones */
            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(10px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .students-container {
                animation: fadeIn 0.3s ease-out;
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
            }

            /* Responsive */
            @media (max-width: 768px) {

                .dojo-image-view img {
                    width: 100%;
                    height: auto;
                    max-height: 200px;
                }

                .dojo-image-view{
                    flex-basis: 100%;
                    height: auto;
                    max-height: 200px;
                }

                .students-grid {
                    grid-template-columns: 1fr;
                }
            }
        </style>

        <style>
            .time-picker-glass {
                background: linear-gradient(135deg, rgba(100, 150, 255, 0.2), rgba(255, 100, 150, 0.2));
                backdrop-filter: blur(12px);
                border-radius: 20px;
                padding: 25px;
                margin: 20px 0;
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
                border: 1px solid rgba(255, 255, 255, 0.3);
                max-width: 400px;
            }
            
            .time-input-group {
                margin-bottom: 25px;
            }
            
            .time-label {
                display: block;
                color: #2a3f5f;
                font-weight: 600;
                margin-bottom: 10px;
                font-size: 1.5rem;
            }
            
            .time-input {
                width: 100%;
                padding: 12px 15px;
                border-radius: 10px;
                border: 1px solid rgba(100, 150, 255, 0.5);
                background: rgba(255, 255, 255, 0.9);
                font-size: 1rem;
                color: #2a3f5f;
                transition: all 0.3s;
            }
            
            .time-input:focus {
                outline: none;
                border-color: rgba(255, 100, 150, 0.8);
                box-shadow: 0 0 0 2px rgba(255, 100, 150, 0.2);
            }
            
            .time-display {
                margin-top: 10px;
                font-size: 1rem;
                color: #4a5568;
                font-style: italic;
            }
            
            .error-message {
                color: #e53e3e;
                font-size: 0.9rem;
                margin-top: 10px;
                font-weight: 500;
            }
        </style>
    @endpush
    <!-- Titulo de la Pagina -->
    <div class="panel-custom animated zoomIn" style='padding-bottom: 10px; margin: 20px 0;'>
        <div class="modern-container-header" style="justify-content:space-around; flex-wrap:wrap; gap:15px">
            <div class="modern-header">
                <span class="text-center color-title"><i class="fa-solid fa-vihara"></i> {{$user->role == "administrador" ? "Lista de Dojos Registrados" : "Dojo Actual"}}</span>
            </div>
        </div>
    </div>
    <!-- Buscador Y Cartas y Tables -->
    <div class="panel-custom animated zoomIn" style=' margin: 20px 0;'>
        @if($user->role == "administrador")

        <div class="modern-container-header">
            <div class="modern-header" style="margin-bottom:5px;">
                <span class="text-center color-title" style="font-size:25px">{{ __('Buscar Dojos') }}</span>
            </div>
        </div>
        <!-- Buscador -->
        <div class="table-controls" style="margin:0;">
            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass" style="color:#002569"></i>
                <input wire:model.live="search" type="text" placeholder="Buscar dojos..." class="search-input">
            </div>

            <!-- Select -->
            <div class="custom-select-container" wire:ignore.self>
                <div class="custom-select active" x-data="{ isOpen: false }" @click="isOpen = !isOpen" x-cloak>
                    <div class="selected-option">
                        @if ($selectedValue)
                            <div class="option-content">
                                <div class="dojo-avatar">
                                    <i class="{{ $selectedIcon }}" style="color:black;font-size:20px"></i>
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

                    <div class="custom-options" x-show="isOpen" x-transition @click.away="isOpen = false" x-cloak
                        style="">
                        @foreach ($options as $index => $option)
                            <div class="option {{ $selectedValue == $option['value'] ? 'selected' : '' }}"
                                wire:click="selectOption({{ $index }})">
                                <div class="option-content">
                                    <div class="dojo-avatar">
                                        <i class="{{ $option['icon'] }}" style="color:black;font-size:20px"></i>
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

        @endif

        <!-- Card con los Dojos -->
        <div x-data="{ expandedDojo: null }" class="dojos-container" style="padding:5px">
            <!-- Dojo 1 -->
            @if($dojos->count() > 0)
            @foreach($dojos as $dojo)
                <div class="dojo-card" 
                    @if($user->role != 'administrador') 
                        x-data="{ showStudents: true }" 
                    @else 
                        x-data="{ showStudents: false }"
                    @endif>
                    <div class="dojo-header" style="align-items: center">
                        <div class="dojo-image-view">
                            <img src="{{ asset('storage/' . $dojo->photo) }}">
                        </div>
                        <div class="dojo-details">
                            <h2 style="color: black"><i class="fa-solid fa-vihara"></i> {{ $dojo->name }}</h2>
                            <div class="dojo-meta">
                                <span style="color:rgb(197, 51, 51); font-size: 16px"><i class="fas fa-map-marker-alt" style="color:rgb(197, 51, 51)"></i>{{ $dojo->location }}</span>
                            </div>
                            <p class="description">{{ $dojo->description }}</p>
                        </div>
                        <div class="dojo-details">
                            <p style="color: #bd234f; font-size: 18px"><i class="fa-solid fa-calendar-days"></i> Eventos: {{$dojo->event_count}}</p>
                            <p style="color: #bd234f; font-size: 18px"><i class="fa-solid fa-user-graduate"></i> Alumnos: {{$dojo->student_count}}</p>
                        </div>
                    </div>

                    @if($dojo->sensei)
                        <div class="sensei-section">
                            <div class="sensei-card">
                                <div class="sensei-image">
                                    <img src="{{ asset('storage/' . $dojo->sensei->photo) }}" alt="{{ $dojo->sensei->name }}">
                                </div>
                                <div class="sensei-details">
                                    <h4><span style="color:#761212; margin-right:10px"><i class="fa-solid fa-user-ninja"></i> Sensei:</span>{{ $dojo->sensei->name }}</h4>
                                    <div class="sensei-info">
                                        <span class="badge dan-badge" style="font-size:15px"><i class="fa-solid fa-ribbon"></i>{{ $dojo->sensei->dan }}</span>
                                        <span style="font-size:15px"><i class="fas fa-birthday-cake" style="color: #e13c3c"></i>{{\Carbon\Carbon::parse($dojo->sensei->date_of_birth)->age }} años</span>
                                    </div>
                                    @if($user->role == "administrador")
                                        <button type="button" class="edit-btn-ultimate edit-btn-ultimate-table" wire:click='senseisDojo({{$dojo->id}},{{$dojo->sensei->id}}, "addSensei")' @click="openSensei = !openSensei" style="background: linear-gradient(135deg, #219ebc61, #0230473d);">
                                            <i class="fas fa-exchange-alt"></i> Cambiar Sensei
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Horarios -->
                        <div class="schedule-section" x-cloak 
                        @if($user->role != 'administrador') 
                            x-data="{openSchedule: true}" 
                        @else 
                            x-data="{openSchedule: false}"
                        @endif>
                            <div class="schedule-header">
                                <h3>HORARIO DE CLASES</h3>
                                <div class="students-controls" style="gap: 10px 10px; margin:0">
                                    @if($user->role == "administrador" || $user->role == "sensei")
                                        <button class="new-btn-ultimate new-btn-ultimate-table" style="font-size: 12px;" x-show="openSchedule" @click="openModal = !openModal" wire:click='saveScheduleModal({{$dojo->id}})'>
                                            <i class="fa-solid fa-exchange-alt"></i> Crear Horario
                                        </button>
                                    @endif
                                    <button class="edit-btn-ultimate edit-btn-ultimate-table" style="font-size: 12px;background: linear-gradient(135deg, #219ebc61, #0230473d);" @click="openSchedule = !openSchedule">
                                        <i class="fa-solid fa-eye"></i> Ver Horario
                                    </button>
                                </div>
                            </div>
                            
                            <div class="schedule-days" x-show="openSchedule" x-transition>
                                @php
                                    $foundSchedule = false;
                                @endphp
                                @foreach ($daysOfWeek as $dayName)
                                    @php
                                        // Obtenemos todos los horarios para el día actual. 
                                        // Usamos "filter" y comparamos en minúsculas para evitar problemas de formato (tildes, mayúsculas, etc.)
                                        $daySchedules = ($dojo->schedule ?? collect())->filter(function ($item) use ($dayName) {
                                            return mb_strtolower(trim($item->day)) === mb_strtolower(trim($dayName));
                                        });
                                    @endphp
                            
                                    @if($daySchedules->isNotEmpty())
                                        @php $foundSchedule = true; @endphp
                                        <div class="day-card rest-day">
                                            <div class="day-name">{{ $dayName }}</div>
                                            
                                            @foreach ($daySchedules as $schedule)
                                                <div class="edit-btn-ultimate edit-btn-ultimate-table day-description" style="display:block" type="button">
                                                    <div class="class-time text-dark">{{ $schedule->class_type ?? 'Sin tipo' }}</div>
                                                    <div class="class-time">
                                                        {{ \Illuminate\Support\Carbon::parse($schedule->start_time)->format('h:i A') }}
                                                        - 
                                                        {{ \Illuminate\Support\Carbon::parse($schedule->end_time)->format('h:i A') }}
                                                    </div>
                                                    @if($user->role == "administrador" || $user->role == "sensei")
                                                        <div style="display: flex; gap:5px; justify-content:center; margin-top:5px">
                                                            <button class="edit-btn-ultimate edit-btn-ultimate-table" style="font-size: 12px;background: linear-gradient(135deg, #219ebc61, #0230473d);padding: 7px 10px" wire:click='editModalSchedule({{$schedule->id}}, {{$dojo->id}})' @click="openModalEdit = !openModalEdit">
                                                                <i class="fa-solid fa-pen"></i> Editar
                                                            </button>
                                                            <button class="delete-btn-ultimate delete-btn-ultimate-table" style="font-size: 12px;padding: 7px 10px" wire:click='removeScheduleModal("removeSchedule",{{$schedule->id}})' @click="openConfirm1 = !openConfirm1">
                                                                <i class="fa-solid fa-trash"></i> Eliminar
                                                            </button>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                            
                                        </div>
                                    @endif
                                    
                                @endforeach
                                @if(!$foundSchedule)
                                    <h4>No tiene horarios asignados</h4>
                                @endif
                            </div>
                            
                            
                        </div>
                    @else
                        <div class="sensei-section">
                            <div class="sensei-card">
                                <div class="sensei-image">
                                    <img src="{{ asset('image/sensei-default.jpg') }}">
                                </div>
                                <div class="sensei-details">
                                    <h4>No Tiene Sensei Asignado</h4>
                                    <button type="button" class="edit-btn-ultimate edit-btn-ultimate-table" wire:click='senseisDojo({{$dojo->id}},null, "addSensei")' @click="openSensei = !openSensei">
                                        <i class="fas fa-exchange-alt"></i> Asignar Sensei
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    @if(optional($dojo->sensei)->student && $dojo->sensei->student->count() > 0) <!-- ✅ Usar `optional()` para evitar error en `null` -->
                        <div class="students-controls">
                            <button @click="showStudents = !showStudents" class="edit-btn-ultimate edit-btn-ultimate-table" style="background: linear-gradient(135deg, #219ebc61, #0230473d);">
                                <span x-text="showStudents ? 'Ocultar Estudiantes' : 'Mostrar Estudiantes'"></span>
                                <i :class="showStudents ? 'fas fa-chevron-up' : 'fas fa-chevron-down'"></i>
                            </button>

                            @if($user->role == "administrador" || $user->role == "sensei")
                                <button type="button" class="new-btn-ultimate new-btn-ultimate-table" wire:click='studentsSensei({{$dojo->id}},{{$dojo->sensei->id}},"{{$dojo->sensei->status}}")' @click="openStudent = !openStudent">
                                    <i class="fas fa-plus-circle"></i> Agregar Estudiante
                                </button>
                            @endif
                        </div>
                    
                        <div class="students-container" x-show="showStudents" x-transition>
                            @foreach($dojo->sensei->student as $student)
                                <div class="student-card">
                                    <div class="student-image">
                                        <img src="{{ asset('storage/' . $student->photo) }}" alt="{{ $student->name }}">
                                    </div>
                                    <div class="student-info">
                                        <h5>{{ $student->name }}</h5>
                                        <span class="badge dan-badge" style="font-size:13px"><i class="fa-solid fa-ribbon"></i> {{ $student->kyu }}</span>
                                        <span style="font-size:13px"><i class="fas fa-birthday-cake" style="margin-right: 5px"></i>{{\Carbon\Carbon::parse($student->date_of_birth)->age }} años</span>
                                        <div style="font-size:13px"><i class="fas fa-envelope" style="margin-right: 5px; margin-top: 5px"></i>{{$student->user->email}}</div>
                                        @if($user->role == "administrador" || $user->role == "sensei")
                                        <div style="display: flex; gap: 10px; margin-top: 10px">
                                            <button type="button" class="new-btn-ultimate new-btn-ultimate-table" wire:click='kyuStudentModal("upKyuStudent",{{$student->id}})' @click="openConfirm1 = !openConfirm1" style="padding: 5px">
                                                <i class="fa-solid fa-arrow-up" style="font-size: 12px;"></i>Subir Kyu
                                            </button>
                                            <button type="button" class="delete-btn-ultimate delete-btn-ultimate-table" wire:click='kyuStudentModal("downKyuStudent",{{$student->id}})' @click="openConfirm1 = !openConfirm1" style="padding: 5px">
                                                <i class="fa-solid fa-arrow-down" style="font-size: 12px;"></i>Bajar Kyu
                                            </button>
                                        </div>
                                        @endif
                                    </div>
                                    {{-- <button class="delete-btn-ultimate delete-btn-ultimate-table" style="margin-right:10px">
                                        <i class="fa-solid fa-trash"></i>
                                    </button> --}}
                                    @if($user->role == "administrador" || $user->role == "sensei")
                                        <button type="button" class="delete-btn-ultimate delete-btn-ultimate-table" wire:click='modalConfirmStudent("removeStudent", {{$student->id}})' @click="openConfirm1 = !openConfirm1" style="margin-right:10px">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @elseif($dojo->sensei)
                        <div class="students-controls">
                            <h3>No tiene Alumnos Asignados</h3>
                            @if($user->role == "administrador" || $user->role == "sensei")

                                <button type="button" class="new-btn-ultimate new-btn-ultimate-table" wire:click='studentsSensei({{$dojo->id}},{{$dojo->sensei->id}},"{{$dojo->sensei->status}}")' @click="openStudent = !openStudent">
                                    <i class="fas fa-plus-circle"></i> Agregar Estudiante
                                </button>
                            @endif
                        </div>
                    @endif

                </div>
            @endforeach
            @else
                <h2><i class="fa-solid fa-exclamation-circle"></i> No tienes un Dojo Asignado</h2>
                <h4>Comunicate con un Administrador para que te asignen un dojo</h4>
            @endif


            <!-- Fin de los dojos -->
        </div>

    </div>

    <!-- Modal Alumnos-->
    <div class="modal-overlay" x-show='openStudent' @click.self="openStudent = !openStudent" x-transition:leave.duration.500ms x-transition:enter.duration.500ms>
        <div class="modal-container " :class="openStudent ? 'animated fadeInDown' : 'animated zoomOut'" style="max-width:80vw">
            <button class="close-btn-image" @click="openStudent = !openStudent">&times;</button>
            <div class="modern-container-header" style="justify-content:space-around; flex-wrap:wrap; gap:15px; margin-bottom:20px">
                <div class="modern-header">
                    <span class="text-center color-title">{{ __('Estudiantes Disponibles') }}</span>
                    <span class="text-center color-paragraph"
                        style="margin:0px;">{{ __('Agrega o Eliminas estudiantes de un Sensei') }}</span>
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
            <!-- Card Senseis -->
            <div class="grid-container animated zoomIn" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));">
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
                            <div class="dojo-content-ultimate" style="width: 100%;padding: 20px; height: 140px">

                                <i x-show="activeButton == 'sensei'" wire:click='modalConfirmStudent("addStudent", {{$student->id}})' class="fa-solid fa-plus edit-btn-ultimate edit-btn-ultimate-table" style="background-color:white;padding:5px;position:absolute; top:10px; right:7px; font-size:17px;z-index:1000;border-radius:20px" @click="openConfirm1 = !openConfirm1"></i>

                                <div class="dojo-text-content" style="margin:0">
                                    
                                    <h4 class="dojo-title-ultimate">{{ $student->name }}</h4>
                                    <h5 class="dojo-desc-ultimate" style="font-size:15px"><i class="fa-solid fa-ribbon"></i> {{ $student->kyu }}</h5>
                                    <div class="dojo-location-ultimate">
                                        
                                        <span>Edad: {{ \Carbon\Carbon::parse($student->date_of_birth)->age }}</span>
                                    </div>
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
                                <h3 class=" text-center alert alert-danger" style="margin:15px 0;font-size:20px">No hay Alumnos Disponibles en estos momentos</h3>
                            </div>
                        </div>
                    </div>
                @endif
                
            </div>
            {{ $studentsInactive->links('vendor.livewire.bootstrap') }}

        </div>
    </div>

    <!-- Modal Senseis -->
    <div class="modal-overlay" x-show='openSensei' @click.self="openSensei = !openSensei" x-transition:leave.duration.500ms x-transition:enter.duration.500ms>
        <div class="modal-container " :class="openSensei ? 'animated fadeInDown' : 'animated zoomOut'" style="max-width:90vw">
            <button class="close-btn-image" @click="openSensei = !openSensei">&times;</button>
            <div class="modern-container-header" style="justify-content:space-around; flex-wrap:wrap; gap:15px; margin-bottom:20px">
                <div class="modern-header">
                    <span class="text-center color-title">{{ __('Senseis sin Dojo') }}</span>
                    <span class="text-center color-paragraph"
                        style="margin:0px;">{{ __('Cambia de Sensei al Dojo') }}</span>
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
                            <div class="dojo-content-ultimate" style="width: 100%;padding: 20px; height: 140px">

                                <i x-show="activeButton == 'sensei'" wire:click='modalConfirmSensei({{$sensei->id}})' class="fa-solid fa-plus edit-btn-ultimate edit-btn-ultimate-table" style="background-color:white;padding:5px;position:absolute; top:10px; right:7px; font-size:17px;z-index:1000;border-radius:20px" @click="openConfirm1 = !openConfirm1"></i>
                                <div class="dojo-text-content" style="margin:0">
                                    
                                    <h4 class="dojo-title-ultimate">{{ $sensei->name }}</h4>
                                    <h5 class="dojo-desc-ultimate" style="font-size:15px"><i class="fa-solid fa-ribbon"></i> {{ $sensei->dan }}</h5>
                                    <div class="dojo-location-ultimate">
                                        
                                        <span>Edad: {{ \Carbon\Carbon::parse($sensei->date_of_birth)->age }}</span>
                                    </div>
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
                                <h3 class=" text-center alert alert-danger" style="margin:15px 0;font-size:20px">No hay Senseis sin Dojos</h3>
                            </div>
                        </div>
                    </div>
                @endif
                
            </div>
            {{ $senseisInactive->links('vendor.livewire.bootstrap') }}
        </div>
    </div>

    <!-- Modal Horarios -->
    <div class="modal-overlay" x-show='openModal' @click.self="openModal = !openModal" x-transition:leave.duration.500ms x-transition:enter.duration.500ms>
        <div class="modal-container " :class="openModal ? 'animated fadeInDown' : 'animated zoomOut'" style="max-width:90vw">
            <button class="close-btn-image" @click="openModal = !openModal">&times;</button>
            <div class="modern-container-header" style="justify-content:space-around; flex-wrap:wrap; gap:15px; margin-bottom:20px">
                <div class="modern-header">
                    <span class="text-center color-title">{{ __('Horarios del Dojo') }}</span>
                    <span class="text-center color-paragraph"
                        style="margin:0px;">{{ __('Crea un Horario al dojo') }}</span>
                </div>
            </div>
            <div class="panel-body">

                <form wire:submit='saveSchedule()' wire:key="sensei-form">
                    <div class="row">
                        <!-- Ubicación del Dojo -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <!-- Hora de inicio -->
                                <label class="control-label color-paragraph label-form">Hora de inicio</label>
                                <div class="input-group mar-btm">
                                    <span class="input-group-addon"><i class="fa-solid fa-user"></i></span>

                                    <input type="time" 
                                            wire:model.live="startTime"
                                            class="form-control"
                                            step="60">
                                </div>
                                <div class="time-display" style="font-size:15px">
                                    {{ $this->formatAMPM($startTime) }}
                                </div>

                                @error('endTime')
                                    <div class="alert-error animated shake">{{ $message }}</div>
                                @enderror
                                
                                    
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <!-- Hora de finalización -->
                                <label class="control-label color-paragraph label-form">Hora de finalización</label>
                                <div class="input-group mar-btm">
                                    <span class="input-group-addon"><i class="fa-solid fa-user"></i></span>
                                    <input type="time" 
                                        wire:model.live="endTime"
                                        class="form-control"
                                        {{ !$showEndTime ? 'disabled' : '' }}
                                        step="60">
                                </div>

                                <div class="time-display" style="font-size:15px">
                                    {{ $this->formatAMPM($endTime) }}
                                </div>
                            </div>
                        </div>
                        <!-- Campos ocultos para el formato time -->
                        <input type="hidden" name="start_time" value="{{ $startTime ? $startTime . ':00' : '' }}">
                        <input type="hidden" name="end_time" value="{{ $endTime ? $endTime . ':00' : '' }}">
                    </div>
                    <div class="row">
                        <!-- Dias de la Semana -->
                        <div class="col-sm-6">
                            <div class="form-group" style="margin-top:0;position: relative;z-index:2">
                                <label class="control-label color-paragraph label-form" style="@error('$selectedValueDay') color:#e90326; @enderror">Dia de la Semana Disponibles</label>
                                <div class="custom-select-container" wire:ignore.self style="margin:0">
                                    <div class="custom-select active" x-data="{ isOpen: false }" @click="isOpen = !isOpen" x-cloak>
                                        <div class="selected-option">
                                            @if ($selectedValueDay)
                                                <div class="option-content">
                                                    <div class="option-text">
                                                        <div class="option-title">{{ $selectedValueDay }}</div>
                                                    </div>
                                                </div>
                                            @else
                                                <span>Selecciona un Dia</span>
                                            @endif
                                            <i class="fa-solid fa-angle-down"></i>
                                        </div>
                
                                        <div class="custom-options" style="max-height: 150px" x-show="isOpen" x-transition @click.away="isOpen = false" x-cloak style="">
                                            @if($optionsDay)
                                                @foreach ($optionsDay as $index => $option)
                                                    <div class="option {{ $selectedValueDay == $option['value'] ? 'selected' : '' }}"
                                                        wire:click="selectOptionDay({{ $index }})">
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
                            @error('selectedValueDay')
                                <div class="alert-error animated shake">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Descripcion de la clase -->
                        <div class="col-sm-6">
                            <div class="form-group" style="margin-top:0">
                                <label class="control-label color-paragraph label-form" for="description"
                                    style="@error('description') color:#e90326; @enderror">Descripcion de la Clase</label>
                                <div class="input-group mar-btm">
                                    <span class="input-group-addon"><i
                                            class="fa-solid fa-pen-to-square"></i></span>
                                    <textarea class="form-control" id="description" wire:model.live='description'
                                        placeholder="Ingrese una breve descripción" style="height: 120px; overflow-y: auto; resize: none;"></textarea>
                                </div>
                                @error('description')
                                    <div class="alert-error animated shake">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12" style="display: flex; justify-content: end; gap:10px; ">
                            <button class="cancel-btn-ultimate" type="button" @click="openModal = !openModal">
                                <i class="fa-solid fa-xmark"></i>
                                <span>Cancelar</span>
                            </button>
                            <button class="modern-btn-success" type="submit">
                                <i class="fa-solid fa-check"></i>
                                <span>Guardar</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            
            {{ $senseisInactive->links('vendor.livewire.bootstrap') }}
        </div>
    </div>

    <!-- Modal Horarios Edit -->
    <div class="modal-overlay" x-show='openModalEdit' @click.self="openModalEdit = !openModalEdit" x-transition:leave.duration.500ms x-transition:enter.duration.500ms>
        <div class="modal-container " :class="openModalEdit ? 'animated fadeInDown' : 'animated zoomOut'" style="max-width:90vw">
            <button class="close-btn-image" @click="openModalEdit = !openModalEdit">&times;</button>
            <div class="modern-container-header" style="justify-content:space-around; flex-wrap:wrap; gap:15px; margin-bottom:20px">
                <div class="modern-header">
                    <span class="text-center color-title">{{ __('Horarios del Dojo') }}</span>
                    <span class="text-center color-paragraph"
                        style="margin:0px;">{{ __('Edita el Horario') }}</span>
                </div>
            </div>
            <div class="panel-body">

                <form wire:submit='editSchedule()' wire:key="sensei-form">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <!-- Hora de inicio -->
                                <label class="control-label color-paragraph label-form">Hora de inicio</label>
                                <div class="input-group mar-btm">
                                    <span class="input-group-addon"><i class="fa-solid fa-user"></i></span>

                                    <input type="time" 
                                            wire:model.live="startTimeEdit"
                                            class="form-control"
                                            step="60">
                                </div>
                                <div class="time-display" style="font-size:15px">
                                    {{ $this->formatAMPM($startTimeEdit) }}
                                </div>

                                @error('endTimeEdit')
                                    <div class="alert-error animated shake">{{ $message }}</div>
                                @enderror                                
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <!-- Hora de finalización -->
                                <label class="control-label color-paragraph label-form">Hora de finalización</label>
                                <div class="input-group mar-btm">
                                    <span class="input-group-addon"><i class="fa-solid fa-user"></i></span>
                                    <input type="time" 
                                        wire:model.live="endTimeEdit"
                                        class="form-control"
                                        step="60">
                                </div>

                                <div class="time-display" style="font-size:15px">
                                    {{ $this->formatAMPM($endTimeEdit) }}
                                </div>
                            </div>
                        </div>
                        <!-- Campos ocultos para el formato time -->
                        <input type="hidden" name="start_time" value="{{ $startTimeEdit ? $startTimeEdit . ':00' : '' }}">
                        <input type="hidden" name="end_time" value="{{ $endTimeEdit ? $endTimeEdit . ':00' : '' }}">
                    </div>
                    <div class="row">
                        <!-- Dias de la Semana -->
                        <div class="col-sm-6">
                            <div class="form-group" style="margin-top:0;position: relative;z-index:2">
                                <label class="control-label color-paragraph label-form" style="@error('$selectedValueDay') color:#e90326; @enderror">Dia de la Semana Seleccionado</label>
                                <div class="custom-select-container" wire:ignore.self style="margin:0">
                                    <div class="custom-select active" x-data="{ isOpen: false }" @click="isOpen = !isOpen" x-cloak>
                                        <div class="selected-option">
                                            @if ($selectedValueDay)
                                                <div class="option-content">
                                                    <div class="option-text">
                                                        <div class="option-title">{{ $selectedValueDay }}</div>
                                                    </div>
                                                </div>
                                            @else
                                                <span>Selecciona un Dia</span>
                                            @endif
                                            <i class="fa-solid fa-angle-down"></i>
                                        </div>
                
                                        <div class="custom-options" style="max-height: 150px" x-show="isOpen" x-transition @click.away="isOpen = false" x-cloak style="">
                                            @if($optionsDay)
                                                @foreach ($optionsDay as $index => $option)
                                                    <div class="option {{ $selectedValueDay == $option['value'] ? 'selected' : '' }}"
                                                        wire:click="selectOptionDay({{ $index }})">
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
                            @error('selectedValueDay')
                                <div class="alert-error animated shake">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Descripcion de la clase -->
                        <div class="col-sm-6">
                            <div class="form-group" style="margin-top:0">
                                <label class="control-label color-paragraph label-form" for="descriptionEdit"
                                    style="@error('descriptionEdit"') color:#e90326; @enderror">Descripcion de la Clase</label>
                                <div class="input-group mar-btm">
                                    <span class="input-group-addon"><i
                                            class="fa-solid fa-pen-to-square"></i></span>
                                    <textarea class="form-control" id="descriptionEdit" wire:model.live='descriptionEdit'
                                        placeholder="Ingrese una breve descripción" style="height: 120px; overflow-y: auto; resize: none;"></textarea>
                                </div>
                                @error('descriptionEdit"')
                                    <div class="alert-error animated shake">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12" style="display: flex; justify-content: end; gap:10px; ">
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
                </form>
            </div>
            
            {{ $senseisInactive->links('vendor.livewire.bootstrap') }}
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

    <!-- Modal de Confirmacion -->
    <div x-show='openConfirm1' wire:key="destroy-modal" class="modal-overlay" @click.self="openConfirm1 = !openConfirm1" x-transition:leave.duration.500ms x-transition:enter.duration.500ms >
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

                        @if($statusModalConfirm == 'addStudent')
                            <button class="new-btn-ultimate" type="button" wire:click='addStudentSensei' @click="openConfirm1 = !openConfirm1">
                                <i class="fa-solid fa-check" style="font-size:17px"></i>
                                <span style="font-size:17px">Guardar</span>
                            </button>
                        @elseif($statusModalConfirm == 'removeStudent')
                            <button class="new-btn-ultimate" type="button" wire:click='removeStudentSensei' @click="openConfirm1 = !openConfirm1">
                                <i class="fa-solid fa-check" style="font-size:17px"></i>
                                <span style="font-size:17px">Guardar</span>
                            </button>
                        @elseif($statusModalConfirm == 'addSensei')
                            <button class="new-btn-ultimate" type="button" wire:click='addDojoSensei' @click="openConfirm1 = !openConfirm1">
                                <i class="fa-solid fa-check" style="font-size:17px"></i>
                                <span style="font-size:17px">Guardar</span>
                            </button>
                        @elseif($statusModalConfirm == 'removeSchedule')
                            <button class="new-btn-ultimate" type="button" wire:click='removeSchedule' @click="openConfirm1 = !openConfirm1">
                                <i class="fa-solid fa-check" style="font-size:17px"></i>
                                <span style="font-size:17px">Guardar</span>
                            </button>
                        @elseif($statusModalConfirm == 'upKyuStudent')
                            <button class="new-btn-ultimate" type="button" wire:click='upKyuStudent' @click="openConfirm1 = !openConfirm1">
                                <i class="fa-solid fa-check" style="font-size:17px"></i>
                                <span style="font-size:17px">Guardar</span>
                            </button>
                        @elseif($statusModalConfirm == 'downKyuStudent')
                            <button class="new-btn-ultimate" type="button" wire:click='downKyuStudent' @click="openConfirm1 = !openConfirm1">
                                <i class="fa-solid fa-check" style="font-size:17px"></i>
                                <span style="font-size:17px">Guardar</span>
                            </button>
                        @endif
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{ $dojos->links('vendor.livewire.bootstrap') }}
    @push('scripts')
    
    @endpush
</div>
