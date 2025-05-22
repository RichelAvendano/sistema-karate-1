<div>
    @push('styles')
    <style>
        /* Estilo Glass con tonos azules y rojos */
        .event-card-glass {
            display: flex;
            background: linear-gradient(135deg, rgba(200, 220, 255, 0.3), rgba(255, 200, 220, 0.2));
            backdrop-filter: blur(10px);
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            overflow: hidden;
            width: 100%;
            max-width: 100%;
            margin: 20px 0;
            height: 400px;
        }
        
        .event-image-container {
            position: relative;
            width: 40%;
            min-width: 300px;
        }
        
        .event-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: blur(1px);
        }
        
        .event-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
            padding: 10px;
            color: white;
            height: 100%;
            overflow-y: auto;
        }
        
        .event-title {
            font-size: 1.8rem;
            backdrop-filter: blur(5px);
            padding: 4px 8px;
            border-radius: 50px;
            font-weight: 700;
            color: rgb(255, 255, 255);
            text-align: center;
            background: linear-gradient(135deg, rgb(115 166 255 / 52%), rgb(255 121 170 / 49%));
        }

        .description-event{
            font-size: 1.4rem;
            color: #f7fafc;
            backdrop-filter: blur(5px);
            background: #00000057;
            padding: 2px 8px;
            border-radius: 50px;
        }
        
        .event-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }
        
        .event-meta i {
            margin-right: 5px;
            color: #ff6b6b;
        }
        
        .event-rating {
            display: inline-block;
            padding: 5px 15px;
            background: linear-gradient(135deg, rgb(59 130 246 / 59%), rgb(220 38 38 / 60%));
            border-radius: 20px;
            font-weight: 600;
        }
        
        .event-main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            padding: 10px;
        }
        
        .event-tabs {
            display: flex;
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            margin-bottom: 5px;
        }
        
        .tab-btn {
            flex: 1;
            padding: 12px;
            border: none;
            background: transparent;
            color: #4a5568;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        
        .tab-btn i {
            font-size: 1.1rem;
        }
        
        .tab-btn.active {
            color: white;
            position: relative;
        }
        
        .tab-btn.active:after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 3px;
        }
        
        .dojo-tab.active {
            background: rgba(100, 150, 255, 0.3);
        }
        
        .dojo-tab.active:after {
            background: #4a89dc;
        }
        
        .sensei-tab.active {
            background: rgba(255, 100, 100, 0.3);
        }
        
        .sensei-tab.active:after {
            background: #c53030;
        }
        
        .student-tab.active {
            background: rgb(62 209 109 / 32%);
        }
        
        .student-tab.active:after {
            background: #2bac47;
        }
        
        .tab-content {
            flex: 1;
            overflow-y: auto;
            max-height: 330px;
        }
        
        /* Estilos para las secciones */
        .dojos-section, .senseis-section, .students-section {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
            padding: 5px;
        }
        
        .dojo-card, .sensei-card, .student-card {
            display: flex;
            flex-wrap: wrap;
            background: rgba(255, 255, 255, 0.307);
            border-radius: 10px;
            padding: 15px;
            transition: all 0.3s;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .dojo-card:hover, .sensei-card:hover, .student-card:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-3px);
        }
        
        .dojo-image {
            width: 100%;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        
        .sensei-avatar, .student-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: contain;
            border: 2px solid rgba(255, 255, 255, 0.3);
            float: left;
            margin-right: 15px;
        }
        
        .dojo-card h3, .sensei-card h3, .student-card h3 {
            margin: 0 0 5px 0;
            color: #2a3f5f;
            font-size: 2rem;
        }
        
        .dojo-card p, .sensei-card p, .student-card p {
            margin: 0;
            color: #4a5568;
            font-size: 1.3rem;
        }
        
        .dojo-name, .sensei-name {
            font-size: 0.8rem;
            color: #718096;
            margin-top: 5px;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .event-card-glass {
                flex-direction: column;
                height: 650px;
            }
            
            .event-image-container {
                width: 100%;
                min-width: auto;
                height: 300px;
            }

            .event-image{
                filter: blur(1px);

            }

            .tab-content{
                max-height: 280px;
            }
        }
    </style>

    <style>

        .dojo-status-chart {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            max-width: 500px;
            margin: 0 auto;
        }

        .chart-header {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 15px;
            gap: 10px;
        }

        .chart-header h3 {
            margin: 0;
            font-size: 1.6rem;
            font-weight: 600;
            padding: 10px;
            border-radius: 10px;
        }

        .h3-dojos{
            background: linear-gradient(135deg, rgb(255 127 0 / 7%), rgb(220 38 38 / 40%));
            color: #65150f !important;
        }

        .h3-senseis{
            background: linear-gradient(135deg, rgb(0 255 231 / 13%), rgb(38 106 220 / 30%));
            color: #0f1365 !important;
        }

        .h3-students{
            background: linear-gradient(135deg, rgb(161 255 0 / 13%), rgb(78 220 38 / 40%));
            color:#09370d !important;
        }

        .h3-cancel{
            background: linear-gradient(135deg, #a3a8a429, #17181742);
            color:#0c0e0c !important;
        }

        .total-count {
            font-size: 1.7rem;
            font-weight: 600;
            padding: 10px;
            border-radius: 10px;
        }

        .chart-container {
            position: relative;
            height: 100%;
            margin: 10px 0;
        }

        .chart-legend {
            display: flex;
            justify-content: center;
            gap: 10px 20px;
            margin-top: 15px;
            flex-wrap: wrap;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .legend-color {
            width: 20px;
            height: 20px;
            border-radius: 4px;
            display: inline-block;
        }

        .legend-text {
            font-size: 1.3rem;
            color: #495057;
            font-weight: 500;
        }

        @media (max-width: 576px) {
            .chart-legend {
                flex-direction: column;
                align-items: center;
                gap: 10px;
            }
            
        }
    </style>

    <style>
        .btn{
            font-size: 1.5rem; font-weight: 600;
        }

        .no-results-alert {
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, rgba(200, 220, 255, 0.3), rgba(255, 200, 220, 0.2));
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 20px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            grid-column: 1 / -1;
            max-width: 500px;
            margin: 20px auto;
            color: #2a3f5f;
        }

        .alert-icon {
            margin-right: 15px;
        }

        .alert-icon i {
            font-size: 3rem;
            stroke: #c53030;
        }

        .alert-content h3 {
            margin: 0 0 5px 0;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .alert-content p {
            margin: 0;
            font-size: 1.2rem;
            color: #4a5568;
        }

        /* Efecto hover opcional */
        .no-results-alert:hover {
            background: linear-gradient(135deg, rgba(200, 220, 255, 0.4), rgba(255, 200, 220, 0.3));
            transform: translateY(-2px);
            transition: all 0.3s ease;
        }
    </style>
    @endpush

    {{-- titulo de estadisticas --}}
    <div x-data="{ activeButton: '{{$buttonDefaultSearch ?? "all"}}' }" class="row" style="display: flex; justify-content: center" x-cloak>
        <div class="pad-all text-center animated zoomIn" style="background: linear-gradient(135deg, #ff010121, #00aaff26); max-width: 400px; padding: 0; margin: 10px;">
            <h3 id="color-title-glass" style="color: black !important; margin-top: 10px"><i class="fa-solid fa-calendar-days"></i> Eventos: ordenar por</i></h3>
            <div class="chart-header" style="flex-wrap: wrap">
                <button type="button" 
                    class="delete-btn-ultimate delete-btn-ultimate-table btn h3-dojos"
                    :class="{ 'h3-dojos': activeButton !== 'current' }"
                    :style="activeButton === 'current' ? 'color: #fff' : ''"
                    @click="activeButton = 'current'"
                    wire:click="setFilter('current')">
                    En Curso
                </button>

                <button type="button" 
                    class="edit-btn-ultimate edit-btn-ultimate-table btn h3-senseis"
                    :class="{ 'h3-senseis': activeButton !== 'past' }"
                    :style="activeButton === 'past' ? 'color: #fff' : ''"
                    @click="activeButton = 'past'"
                    wire:click="setFilter('past')">
                    Pasados
                </button>

                <button type="button" 
                    class="new-btn-ultimate new-btn-ultimate-table btn h3-students"
                    :class="{ 'h3-students': activeButton !== 'upcoming' }"
                    :style="activeButton === 'upcoming' ? 'color: #fff' : ''"
                    @click="activeButton = 'upcoming'"
                    wire:click="setFilter('upcoming')">
                    Próximos
                </button>

                <button type="button" 
                    class="cancel-btn-ultimate btn h3-cancel"
                    :class="{ 'h3-cancel': activeButton !== 'all' }"
                    :style="activeButton === 'all' ? 'color: #fff' : ''"
                    @click="activeButton = 'all'"
                    wire:click="setFilter('all')">
                    Todos
                </button>
            </div>
        </div>
    </div>


    @foreach($events as $event)
        @php 
            $participantTypes = json_decode($event->participant_type, true) ?? []; 
            $firstType = count($participantTypes) ? $participantTypes[0] : 'student';
        @endphp
        <div class="event-card-glass" x-data="{ activeTab: '{{$firstType}}' }" x-cloak wire:key="event-{{$event->id}}">
            <!-- Imagen del Evento -->
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
                <div class="event-overlay">
                    <div style="display: flex; align-items: center; flex-direction: column;">
                        <h2 class="event-title" style="width: 75%; margin: 5px 0">{{$event->name}}</h2>
                        <h4 class="description-event text-center" style="border-radius:5px; margin-top:5px">{{$event->description}}</h4>
                    </div>
                    <div class="event-meta">
                        <div style="display: flex; gap: 10px; flex-wrap: wrap;width: 100%">
                            <span class="description-event"><i class="fas fa-map-marker-alt"></i> {{$event->location}}</span>
                            <span class="description-event"><i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($event->start_date)->format('d M, Y H:i') }} - 
                                {{ \Carbon\Carbon::parse($event->end_date)->format('d M, Y H:i') }}</span>
                            <span class="description-event"><i class="fas fa-users"></i>N° Total. de Participantes: {{$event->dojo_count + $event->sensei_count + $event->student_count}} / {{$event->max_dojo + $event->max_sensei + $event->max_student}}</span>
                        </div>
                        <div style="display: flex; gap: 10px; flex-wrap: wrap;width: 100%">
                            <span class="description-event" style="background: #0066ff77"><i class="fas fa-users" style="color:#52acff"></i>Participando</span>
                            @foreach($participantTypes as $type)
                                @if($type == 'dojo')
                                    <span class="description-event"><i class="fas fa-users" style="color:#52acff"></i>Dojos: {{$event->dojo_count}} / {{$event->max_dojo}}</span>   
                                @elseif($type == 'sensei')
                                    <span class="description-event"><i class="fas fa-users" style="color:#52acff"></i>Senseis: {{$event->sensei_count}} / {{$event->max_sensei}}</span>
                                @elseif($type == 'student')
                                    <span class="description-event"><i class="fas fa-users" style="color:#52acff"></i>Atletas: {{$event->student_count}} / {{$event->max_student}}</span>
                                @endif
                            @endforeach
                            
                        </div>
                        <div style="display: flex; gap: 10px; flex-wrap: wrap; width: 100%">
                            <span class="description-event" style="background: #00ff7b62"><i class="fas fa-users" style="color:#52ff7d"></i>Para</span>
                            @foreach($participantTypes as $type)
                                @if($type == 'dojo')
                                    <span class="description-event"><i class="fas fa-vihara" style="color:#52ff7d"></i>Dojos</span>
                                @elseif($type == 'sensei')
                                    <span class="description-event"><i class="fas fa-user-ninja" style="color:#52ff7d"></i>Senseis</span>
                                @elseif($type == 'student')
                                    <span class="description-event"><i class="fas fa-user-graduate" style="color:#52ff7d"></i>Atletas</span>
                                @endif
                            @endforeach
                        </div>
                        <div style="display: flex; gap: 10px; flex-wrap: wrap; width: 100%">
                            <span class="description-event" style="background: #e5ff004b"><i class="fas fa-list" style="color:#dcff52"></i>Categoria</span>
                            <span class="description-event"><i class="fa-solid fa-check" style="color:#dcff52"></i> {{$event->event_type}}</span>
                        </div>
                        <div style="display: flex; gap: 10px; flex-wrap: wrap; width: 100%">
                        @if($user->role == "sensei")
                            {{--Sensei--}}
                            @if($user->sensei->dojo)
                                @if($user->sensei->dojo->event)
                                    @if($user->sensei->dojo->event->contains('id', $event->id))
                                        <span style="background: linear-gradient(135deg, rgb(59 130 246 / 59%), rgb(220 38 38 / 60%));color: #fff;font-size: 1.2rem;padding:2px 5px"><i class="fa-solid fa-vihara"></i> Tu Dojo esta participando</span>
                                    @endif
                                @endif
                            @endif
                            @if($user->sensei->event)
                                @if($user->sensei->event->contains('id', $event->id))
                                    <span style="background: linear-gradient(135deg, rgb(59 130 246 / 59%), rgb(220 38 38 / 60%));color: #fff;font-size: 1.2rem;padding:2px 5px"><i class="fa-solid fa-user-ninja"></i> Estas Participando</span>
                                @endif
                            @endif
                            @php
                                $participatingStudents = $user->sensei->student->filter(fn($student) => $student->event->contains('id', $event->id))->count();
                            @endphp
                            @if($participatingStudents > 0)
                                <span style="background: linear-gradient(135deg, rgb(59 130 246 / 59%), rgb(220 38 38 / 60%));color: #fff;font-size: 1.2rem;padding:2px 5px">
                                    <i class="fa-solid fa-user-graduate"></i> {{ $participatingStudents }} de tus estudiantes{{ $participatingStudents > 1 ? 's' : '' }} están participando
                                </span>
                            @endif
                        @endif
                        @if($user->role == "estudiante")
                            {{--student--}}
                            @if($user->student->event)
                                @if($user->student->event->contains('id', $event->id))
                                    <span style="background: linear-gradient(135deg, rgb(59 130 246 / 59%), rgb(220 38 38 / 60%));color: #fff;font-size: 1.2rem;padding:2px 5px"><i class="fa-solid fa-user-graduate"></i> Estas participando</span>
                                @endif
                            @endif
                            @if($user->student->dojo->event)
                                @if($user->student->dojo->event->contains('id', $event->id))
                                    <span style="background: linear-gradient(135deg, rgb(59 130 246 / 59%), rgb(220 38 38 / 60%));color: #fff;font-size: 1.2rem;padding:2px 5px"><i class="fa-solid fa-vihara"></i> Tu Dojo esta participando</span>
                                @endif
                            @endif
                            @if($user->student->sensei->event)
                                @if($user->student->sensei->event->contains('id', $event->id))
                                    <span style="background: linear-gradient(135deg, rgb(59 130 246 / 59%), rgb(220 38 38 / 60%));color: #fff;font-size: 1.2rem;padding:2px 5px"><i class="fa-solid fa-user-ninja"></i> Tu sensei esta Participando</span>
                                @endif
                            @endif
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        
            <!-- Contenido Principal -->
            <div class="event-main-content">
                <!-- Pestañas de Navegación -->
                <div class="event-tabs">
                    @foreach($participantTypes as $type)
                        @if($type == 'dojo')
                            <button @click="activeTab = 'dojo'" 
                                    :class="{ 'active': activeTab === 'dojo' }" 
                                    class="tab-btn dojo-tab">
                                <i class="fas fa-school"></i> Dojos
                            </button>
                        @elseif($type == 'sensei')
                            <button @click="activeTab = 'sensei'" 
                                    :class="{ 'active': activeTab === 'sensei' }" 
                                    class="tab-btn sensei-tab">
                                <i class="fas fa-user-ninja"></i> Senseis
                            </button>
                        @elseif($type == 'student')
                            <button @click="activeTab = 'student'" 
                                    :class="{ 'active': activeTab === 'student' }" 
                                    class="tab-btn student-tab">
                                <i class="fas fa-user-graduate"></i> Atletas
                            </button>
                        @endif
                    @endforeach
                </div>
        
                <!-- Contenido de las Pestañas -->
                <div class="tab-content">
                    <!-- Dojos -->                    
                    <div x-show="activeTab === 'dojo'" x-transition:enter.duration.500ms wire:key="dojo-{{$event->id}}">
                        
                        @if($event->dojo->count() > 0)
                            @livewire('view-event.search-dojo', ['eventId' => $event->id], key('dojo-'.$event->id))    
                        @elseif(!in_array('dojo', $participantTypes))
                            <h3>No pueden Participar Dojos</h3>
                        @elseif($event->dojo->count() == 0)
                            <h3>No hay Dojos Participando</h3>
                        @endif
                    </div>       
        
                    <!-- Senseis -->
                    <div x-show="activeTab === 'sensei'" x-transition:enter.duration.500ms wire:key="sensei-{{$event->id}}">
                        @if($event->sensei->count() > 0)
                            @livewire('view-event.search-sensei', ['eventId' => $event->id], key('sensei-'.$event->id))    
                        @elseif(!in_array('sensei', $participantTypes))
                            <h3>No pueden Participar senseis</h3>
                        @elseif($event->sensei->count() == 0)
                            <h3>No hay Senseis Participando</h3>
                        @endif
                    </div>
        
                    <!-- Atletas -->
                    <div x-show="activeTab === 'student'" x-transition:enter.duration.500ms wire:key="student-{{$event->id}}">
                        @if($event->student->count() > 0)
                            @livewire('view-event.search-student', ['eventId' => $event->id], key('student-'.$event->id))    
                        @elseif(!in_array('student', $participantTypes))
                            <h3>No pueden Participar Atletas</h3>
                        @elseif($event->student->count() == 0)
                            <h3>No hay Atletas Participando</h3>
                        @endif
                    </div>
                </div>
            </div>
            
        </div>
    @endforeach

    <div wire:key="events" >
        {{ $events->links('vendor.livewire.bootstrap') }}
    </div>
</div>
