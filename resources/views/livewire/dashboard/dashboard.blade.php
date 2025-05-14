
<div>
    @push('styles')
        <style>
            .event-image-container {
                position: relative;
                height: 180px;
                overflow: hidden;
            }
            
            .event-image {
                width: 100%;
                height: 100%;
                object-fit: contain;
                transition: transform 0.5s ease;
            }

            .btn-carousel-mid{
                background: linear-gradient(135deg, #ff0101b5, #00aaffa8);
                border-radius: 10px;
                padding: 3px;
                font-size: 25px;
                font-weight: 900;
                color: #fdfdfd;
            }

            .btn-carousel-mid:hover{
                background: linear-gradient(135deg, #ff0101e2, #00aaffd4);
            }
        </style>

        <style>
            .col-sm-4, .col-sm-7, .col-sm-12, .col-sm-5 , .col-sm-6{
                opacity: 0; /* Oculta al inicio */
                transform: translateY(20px);
                transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
            }

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
                font-size: 2.3rem;
                backdrop-filter: blur(5px);
                padding: 4px 8px;
                border-radius: 50px;
                font-weight: 700;
                color: rgb(255, 255, 255);
                text-align: center;
                background: linear-gradient(135deg, rgba(200, 220, 255, 0.538), rgba(255, 200, 220, 0.587));
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
                    height: 600px;
                }
                
                .event-image-container {
                    width: 100%;
                    min-width: auto;
                    height: 550px;
                }

                .event-image{
                    filter: blur(1px);

                }
            }
        </style>
    @endpush
    {{-- titulo de estadisticas --}}
    <div id="page-head" style="margin-bottom: 10px;">
        <div class="pad-all text-center animated zoomIn" style="background: linear-gradient(135deg, #ff010121, #00aaff26);  max-width: 400px; padding:0; margin: 10px">
            <h3 id="color-title-glass" style=" color: black !important; margin-top: 10px">Entidades Registradas</h3>
            <div class="chart-header">
                <a href="{{route('view-dojos')}}" style="font-size: 1.5rem; font-weight: 600" class="delete-btn-ultimate delete-btn-ultimate-table h3-dojos"><i class="fa-solid fa-vihara"></i>Dojo</a>
                @if($user->role == "administrador")
                    <a href="{{route('view-sensei')}}" style="font-size: 1.5rem; font-weight: 600" class="edit-btn-ultimate edit-btn-ultimate-table h3-senseis"><i class="fa-solid fa-user-ninja"></i>Senseis</a>
                    <a href="{{route('view-student')}}" style="font-size: 1.5rem; font-weight: 600" class="new-btn-ultimate new-btn-ultimate-table h3-students"><i class="fa-solid fa-user-graduate"></i>Atletas</a>
                @endif
            </div>
        </div>
    </div>

    {{-- Estadisticas de ENTIDADES --}}
    <div class="row">
        {{-- Dojos Chart --}}
        <div class="col-sm-4" style="margin-bottom: 15px">
            <div class="panel-custom" style="padding: 10px;background: linear-gradient(135deg, rgb(255 127 0 / 7%), rgb(220 38 38 / 10%));">
                
                <div class="chart-header">
                    <h3 class="h3-dojos"><i class="fa-solid fa-vihara"></i> Dojos Registrados</h3>
                    <h3 class="total-count h3-dojos">Total: {{ $totalDojos }} <i class="fa-solid fa-vihara"></i></h3>
                </div>
                
                <div class="chart-container">
                    <canvas id="dojosChart" style="max-height: 130px"></canvas>
                </div>
                
                <div class="chart-legend">
                    <div class="legend-item">
                        <span class="legend-color" style="background: linear-gradient(135deg, #ff131380, #dc5a268f);"></span>
                        <span class="legend-text" style="color: #65150f;font-weight: 600">{{$chartLabelDojo[0]}}</span>
                    </div>
                    @if($user->role == "administrador")
                        <div class="legend-item">
                            <span class="legend-color" style="background: linear-gradient(135deg, #555555de, #674d4d9c);"></span>
                            <span class="legend-text" style="color: #65150f;font-weight: 600">{{$chartLabelDojo[1]}}</span>
                        </div>
                    @endif
                </div>

                <div id="chartDataContainer" 
                    data-chart='@json($chartDataDojo)' 
                    data-labels='@json($chartLabelDojo)'
                    data-colors='@json($colors)'
                    style="display:none;"></div>
            </div>
        </div>

        {{-- Sensei Chart --}}
        <div class="col-sm-4" style="margin-bottom: 15px">
            <div class="panel-custom" style="padding: 10px;background: linear-gradient(135deg, rgb(0 255 231 / 6%), rgb(38 106 220 / 11%));">
                
                <div class="chart-header">
                    <h3 class="h3-senseis"><i class="fa-solid fa-user-ninja"></i> Senseis Registrados</h3>
                    <h3 class="total-count h3-senseis">Total: {{ $totalSenseis }} <i class="fa-solid fa-user-ninja"></i></h3>
                </div>
                
                <div class="chart-container">
                    <canvas id="senseisChart" style="max-height: 130px"></canvas>
                </div>
                
                <div class="chart-legend">
                    <div class="legend-item">
                        <span class="legend-color" style="background: linear-gradient(135deg, #266adc87, #266adc87);"></span>
                        <span class="legend-text" style="color: #0f1365;font-weight: 600">{{$chartLabelSensei[0]}}</span>
                    </div>
                    @if($user->role == "administrador")
                        <div class="legend-item">
                            <span class="legend-color" style="background: linear-gradient(135deg, #555555de, #674d4d9c);"></span>
                            <span class="legend-text" style="color: #0f1365;font-weight: 600">{{$chartLabelSensei[1]}}</span>
                        </div>
                    @endif
                </div>

                <div id="chartDataContainerSensei" 
                    data-chart='@json($chartDataSensei)' 
                    data-labels='@json($chartLabelSensei)'
                    data-colors='@json($colorSensei)'
                    style="display:none;"></div>
            </div>
        </div>

        {{-- Student Chart --}}
        <div class="col-sm-4" style="margin-bottom: 15px">
            <div class="panel-custom" style="padding: 10px;background: linear-gradient(135deg, rgb(161 255 0 / 4%), rgb(78 220 38 / 8%));">
                
                <div class="chart-header">
                    <h3 class="h3-students"><i class="fa-solid fa-user-graduate"></i> Atletas Registrados</h3>
                    <h3 class="total-count h3-students">Total: {{ $totalStudents }} <i class="fa-solid fa-user-graduate"></i></h3>
                </div>
                
                <div class="chart-container">
                    <canvas id="studentsChart" style="max-height: 130px"></canvas>
                </div>
                
                <div class="chart-legend">
                    <div class="legend-item">
                        <span class="legend-color" style="background: linear-gradient(135deg, #64f63bed, #c9e95ed9);"></span>
                        <span class="legend-text" style="color:#09370d;font-weight: 600">{{$chartLabelStudent[0]}}</span>
                    </div>

                    @if($user->role == "administrador")
                        <div class="legend-item">
                            <span class="legend-color" style="background: linear-gradient(135deg, #555555de, #674d4d9c);"></span>
                            <span class="legend-text" style="color:#09370d;font-weight: 600">{{$chartLabelStudent[1]}}</span>
                        </div>
                    @endif
                </div>

                <div id="chartDataContainerStudent" 
                    data-chart='@json($chartDataStudent)' 
                    data-labels='@json($chartLabelStudent)'
                    data-colors='@json($colorStudent)'
                    style="display:none;"></div>
            </div>
        </div>
    <div>
    
        {{-- Titulo Eventos --}}
    <div class="row">
        <div class="{{$eventsCurrentCount > 0 ? 'col-sm-7' : 'col-sm-12'}}">
            <div id="page-head" style="margin-bottom: 10px;">
                <div class="pad-all text-center animated zoomIn" style="background: linear-gradient(135deg, #ff010121, #00aaff26);  max-width: 350px; padding:0; margin: 10px">
                    <h3 id="color-title-glass" style=" color: black !important; margin-top: 10px">Proximos Eventos</h3>
                    <div class="chart-header">
                        @if($user->role == "administrador")
                            <a href="{{route('admin-event')}}" style="font-size: 1.5rem; font-weight: 600" class="delete-btn-ultimate delete-btn-ultimate-table h3-dojos"><i class="fa-solid fa-gears"></i>Gestionar</a>
                        @endif
                        <button type="button" wire:click='sendSearchEventCurrent("upcoming")' style="font-size: 1.5rem; font-weight: 600" class="edit-btn-ultimate edit-btn-ultimate-table h3-senseis"><i class="fa-solid fa-eye"></i>Ver</button>
                    </div>
                </div>
            </div>
        </div>
        @if($eventsCurrentCount > 0)
        <div class="col-sm-5">
            <div id="page-head" style="margin-bottom: 10px;">
                <div class="pad-all text-center animated zoomIn" style="background: linear-gradient(135deg, #ff010121, #00aaff26);  max-width: 250px; padding:0; margin: 10px">
                    <h3 id="color-title-glass" style=" color: black !important; margin-top: 10px">Eventos en Curso</h3>
                    <div class="chart-header">
                        <button type="button" wire:click='sendSearchEventCurrent("current")' style="font-size: 1.5rem; font-weight: 600" class="edit-btn-ultimate edit-btn-ultimate-table h3-senseis"><i class="fa-solid fa-eye"></i>Ver</button>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    {{-- Carrusel de Eventos --}}
    <div class="row">
        <div class="{{$eventsCurrentCount > 0 ? 'col-sm-7' : 'col-sm-12'}}">
            <div class="panel">
                <!--Carousel - Dark Theme -->
                <!--===================================================-->
                <div id="demo-carousel-auto-hide" class="carousel slide" data-ride="carousel" >
                    <!-- Square Indicators-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="carousel-indicators square out">

                        @for ($i = 0; $i < $eventsUpcomingCount; $i++)
                            @if($i == 0)
                                <li class="active" data-slide-to="1" data-target="#demo-carousel-auto-hide" style="width: 15px;"></li>
                            @else
                                <li data-slide-to="{{$i}}" data-target="#demo-carousel-auto-hide" style="width: 15px;"></li>
                            @endif
                        @endfor
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div class="carousel-inner text-center" style="margin:0;padding:0">
                        <!-- Card con los Eventos -->
                        @php $flag = 0; @endphp
                        @foreach($eventsUpcoming as $event)
                            @php $participantTypes = json_decode($event->participant_type, true) ?? []; $flag++;@endphp


                            <div class="item {{$flag == 1 ? 'active' : ''}} event-card-glass" style="margin:0;padding:0; height: 350px">
                                <!-- Imagen del Evento -->
                                <div class="event-image-container" style="width:100%;height: 350px">
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
                                                <span class="description-event" style="background: #0066ff57"><i class="fas fa-users" style="color:#52acff"></i>Participando</span>
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
                                                <span class="description-event" style="background: #00ff7b54"><i class="fas fa-users" style="color:#52ff7d"></i>Para</span>
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
                                                <span class="description-event" style="background: #e5ff0052"><i class="fas fa-list" style="color:#dcff52"></i>Categoria</span>
                                                <span class="description-event">{{$event->event_type}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        @endforeach

                    </div>
                    <!--Auto hide carousel control-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <a class="carousel-control auto-hide left " data-slide="prev" href="#demo-carousel-auto-hide"><i class="fa-solid fa-angles-left btn-carousel-mid"></i></a>
                    <a class="carousel-control auto-hide right" data-slide="next" href="#demo-carousel-auto-hide"><i class="fa-solid fa-angles-right btn-carousel-mid"></i></a>
                </div>
                <!--===================================================-->
                <!--End Carousel - Dark Theme -->
    
            </div>
        </div>
        @if($eventsCurrentCount > 0)
        <div class="col-sm-5">
            <div class="panel">
                <!--Carousel - Dark Theme -->
                <!--===================================================-->
                <div id="demo-carousel-auto" class="carousel slide" data-ride="carousel" >
                    <!-- Square Indicators-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="carousel-indicators square out">
                        @for ($i = 0; $i < $eventsCurrentCount; $i++)
                            @if($i == 0)
                                <li class="active" data-slide-to="1" data-target="#demo-carousel-auto-hide" style="width: 15px;"></li>
                            @else
                                <li data-slide-to="{{$i}}" data-target="#demo-carousel-auto-hide" style="width: 15px;"></li>
                            @endif
                        @endfor
                        
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div class="carousel-inner text-center" style="margin:0;padding:0">
                        <!-- Card con los Eventos -->
                        @php $flag = 0; @endphp
                        @foreach($eventsCurrent as $event)
                            @php $participantTypes = json_decode($event->participant_type, true) ?? []; $flag++;@endphp

                            <div class="item {{$flag == 1 ? 'active' : ''}} event-card-glass" style="margin:0;padding:0; height: 350px">
                                <!-- Imagen del Evento -->
                                <div class="event-image-container" style="width:100%;height: 350px">
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
                                                <span class="description-event" style="background: #0066ff40"><i class="fas fa-users" style="color:#52acff"></i>Participando</span>
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
                                                <span class="description-event" style="background: #00ff7b4f"><i class="fas fa-users" style="color:#52ff7d"></i>Para</span>
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
                                                <span class="description-event" style="background: #e5ff004f"><i class="fas fa-list" style="color:#dcff52"></i>Categoria</span>
                                                <span class="description-event">{{$event->event_type}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        @endforeach

                    </div>
                    <!--Auto hide carousel control-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <a class="carousel-control auto-hide left" data-slide="prev" href="#demo-carousel-auto"><i class="fa-solid fa-angles-left btn-carousel-mid"></i></a>
                    <a class="carousel-control auto-hide right" data-slide="next" href="#demo-carousel-auto"><i class="fa-solid fa-angles-right btn-carousel-mid"></i></a>
                </div>
                <!--===================================================-->
                <!--End Carousel - Dark Theme -->
    
            </div>
        </div>
        @endif
    </div>
    
    {{-- titulos de Dojos, eventos y calendario --}}
    <div class="row">
        <div class="col-sm-12">
            <div id="page-head" style="margin-bottom: 10px;">
                <div class="pad-all text-center animated zoomIn" style="background: linear-gradient(135deg, #ff010121, #00aaff26);  max-width: 200px; padding:0; margin: 10px">
                    <h3 id="color-title-glass" style=" color: black !important; margin-top: 10px">Estadisticas de Dojos y Eventos</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- Dojos Student Chart --}}
        <div class="col-sm-6" style="margin-bottom: 15px">
            <div class="panel-custom" style="padding: 10px;background: linear-gradient(135deg, rgb(255 127 0 / 7%), rgb(220 38 38 / 10%));">
                
                <div class="chart-header">
                    <h3 class="h3-dojos"><i class="fa-solid fa-vihara"></i>Distribucion de Atletas por Dojo</h3>
                </div>
                
                <div class="chart-container">
                    <canvas id="dojosStudentChart" style="max-height: 130px"></canvas>
                </div>
                
                <div class="chart-legend">
                    <div class="legend-item">
                        <span class="legend-color" style="background:#FAD2E1;"></span>
                        <span class="legend-text" style="color: #65150f;font-weight: 600">{{$chartLabelDojoStudent[0]}}:{{$chartDataDojoStudent[0]}}</span>
                    </div>
                    <div class="legend-item">
                        <span class="legend-color" style="background: #B5EAD7"></span>
                        <span class="legend-text" style="color: #65150f;font-weight: 600">{{$chartLabelDojoStudent[1]}}:{{$chartDataDojoStudent[1]}}</span>
                    </div>
                    <div class="legend-item">
                        <span class="legend-color" style="background:#FFDAC1"></span>
                        <span class="legend-text" style="color: #65150f;font-weight: 600">{{$chartLabelDojoStudent[2]}}:{{$chartDataDojoStudent[2]}}</span>
                    </div>
                    <div class="legend-item">
                        <span class="legend-color" style="background: linear-gradient(135deg, #555555de, #674d4d9c);"></span>
                        <span class="legend-text" style="color: #65150f;font-weight: 600">{{$chartLabelDojoStudent[3]}}:{{$chartDataDojoStudent[3]}}</span>
                    </div>
                </div>

                <div id="chartDataContainerDojoStudent" 
                    data-chart='@json($chartDataDojoStudent)' 
                    data-labels='@json($chartLabelDojoStudent)'
                    data-colors='@json($colorsDojoStudent)'
                    style="display:none;"></div>
            </div>
        </div>

        {{-- Event Chart --}}
        <div class="col-sm-6" style="margin-bottom: 15px">
            <div class="panel-custom" style="padding: 10px;background: linear-gradient(135deg, rgb(0 255 231 / 6%), rgb(38 106 220 / 11%));">
                
                <div class="chart-header">
                    <h3 class="h3-senseis"><i class="fa-solid fa-calendar-days"></i> Eventos Registrados</h3>
                </div>
                
                <div class="chart-container">
                    <canvas id="eventChart" style="max-height: 130px"></canvas>
                </div>
                
                <div class="chart-legend">
                    <div class="legend-item">
                        <span class="legend-color" style="background: #555555de"></span>
                        <span class="legend-text" style="color: #0f1365;font-weight: 600">{{$chartLabelEvent[0]}}</span>
                    </div>
                    <div class="legend-item">
                        <span class="legend-color" style="background:#B5EAD7"></span>
                        <span class="legend-text" style="color: #0f1365;font-weight: 600">{{$chartLabelEvent[1]}}</span>
                    </div>
                    <div class="legend-item">
                        <span class="legend-color" style="background: #FFDAC1"></span>
                        <span class="legend-text" style="color: #0f1365;font-weight: 600">{{$chartLabelEvent[2]}}</span>
                    </div>
                </div>

                <div id="chartDataContainerEvent" 
                    data-chart='@json($chartDataEvent)' 
                    data-labels='@json($chartLabelEvent)'
                    data-colors='@json($colorEvent)'
                    style="display:none;"></div>
            </div>
        </div>
    </div>

    @if($user->role == "administrador")
    {{-- titulo de registros recientes --}}
    <div class="row">
        <div class="col-sm-12">
            <div id="page-head" style="margin-bottom: 10px;">
                <div class="pad-all text-center animated zoomIn" style="background: linear-gradient(135deg, #ff010121, #00aaff26);  max-width: 200px; padding:0; margin: 10px">
                    <h3 id="color-title-glass" style=" color: black !important; margin-top: 10px">Registros Recientes</h3>
                    <div class="chart-header">
                        <a href="{{route('display-event')}}" style="font-size: 1.5rem; font-weight: 600" class="edit-btn-ultimate edit-btn-ultimate-table h3-senseis"><i class="fa-solid fa-eye"></i>Ver Más</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Tabla con usuarios Recientes --}}
    <div class="row">
        <div class="col-sm-12">
            <div class="panel-custom animated zoomIn" style=' margin: 0;padding:10px'>
                <!-- Tabla -->
                <div class="table-container">
                    <table class="glass-table" style="min-width: 550px">
                        <thead>
                            <tr>
                                <th style="text-align: center"><i class="fa-solid fa-question" style="font-size: 20px"></i></th>
                                <th class="sortable">
                                    <span>Tipo de Registro</span>
                                </th>
                                <th class="sortable">
                                    <span>Nombre</span>
                                </th>
                                
                                <th class="sortable">
                                    <span>Correo / Ubicación</span>
                                </th>
                                <th class="sortable">
                                    <span>Fecha de Creacion</span>
                                </th>
                                <th class="sortable">
                                    <span>Ultima Actualizacion</span>
                                </th>
                                <th style="text-align: center">Ver</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recents as $recent)
                                
                                <tr wire:key="recent-{{ $recent->id }}"
                                    class="{{ $loop->odd ? 'odd-row' : 'even-row' }} hoverable-row">
                                    <td style="text-align: center">
                                        @if($recent->user)
                                            @if ($recent->user->role == "administrador")
                                                <i class="fa-solid fa-user-tie fa-xl" style="color: #4f0000"></i>
                                            @elseif($recent->user->role == "sensei")
                                                <i class="fa-solid fa-user-ninja fa-xl" style="color: #4f0000"></i>
                                            @else
                                                <i class="fa-solid fa-user-graduate fa-xl" style="color: #4f0000"></i>
                                            @endif
                                        @else
                                            @if($recent->type == "Dojo")
                                                <i class="fa-solid fa-vihara fa-xl" style="color: #4f0000"></i>
                                            @else   
                                                <i class="fa-solid fa-calendar-days fa-xl" style="color: #4f0000"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        @if($recent->user)
                                            {{ Str::ucfirst($recent->user->role) }}
                                        @elseif($recent->type)
                                            {{$recent->type}}
                                        @endif
                                    </td>
                                    <td>{{ $recent->name }}</td>
                                    <td>{{ $recent->user->email ?? $recent->location}}</td>
                                    <td>{{ $recent->user->created_at ?? $recent->created_at }}</td>
                                    <td>{{ $recent->updated_at ?? $recent->user->updated_at}}</td>
                                    <td style="display: flex; justify-content:center">
                                        @if($recent->user)
                                            <button type="button" wire:click='sendSearchUser("{{$recent->user->email}}", "{{ $recent->user ? $recent->user->role : "" }}")' style="font-size: 1.5rem; font-weight: 600; width:50px" class="edit-btn-ultimate edit-btn-ultimate-table h3-senseis"><i class="fa-solid fa-eye"></i></button>
                                        @else
                                            @if($recent->type == "Dojo")
                                                <button type="button" wire:click='sendSearchUser("{{$recent->name}}", "{{$recent->type}}")' style="font-size: 1.5rem; font-weight: 600; width:50px" class="edit-btn-ultimate edit-btn-ultimate-table h3-senseis"><i class="fa-solid fa-eye"></i></button>
                                            @else   
                                                <button type="button" wire:click='sendSearchUser("{{$recent->name}}", "{{$recent->type}}")' style="font-size: 1.5rem; font-weight: 600; width:50px" class="edit-btn-ultimate edit-btn-ultimate-table h3-senseis"><i class="fa-solid fa-eye"></i></button>
                                            @endif
                                        @endif
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    <div>
    @endif

    @push('scripts')
        {{-- Dojos Chart --}}
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const container = document.getElementById('chartDataContainer');
                const chartDataDojo = JSON.parse(container.getAttribute('data-chart'));
                const chartLabelDojo = JSON.parse(container.getAttribute('data-labels'));
                const colors = JSON.parse(container.getAttribute('data-colors'));
                
                const ctx = document.getElementById('dojosChart').getContext('2d');

                // Función para crear un degradado
                function createGradient(ctx, colorStart, colorEnd) {
                    const gradient = ctx.createLinearGradient(0, 0, 400, 0);
                    gradient.addColorStop(0, colorStart);
                    gradient.addColorStop(1, colorEnd);
                    return gradient;
                }

                // Lista de degradados únicos para cada sección del gráfico
                const gradientColors = [
                    createGradient(ctx, '#ff131380', '#dc5a268f'),
                    createGradient(ctx, '#555555de', '#674d4d9c'),
                ];
                
                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: chartLabelDojo,
                        datasets: [{
                            data: chartDataDojo,
                            backgroundColor: gradientColors,
                            borderColor: '#ffffff',
                            borderWidth: 2,
                            hoverBorderWidth: 2,
                            hoverBackgroundColor: colors.map(color => `${color}DD`),
                            cutout: '70%'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false // Usamos nuestra propia leyenda
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const label = '';
                                        const value = context.raw;
                                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        const percentage = Math.round((value / total) * 100);
                                        return `${label} (${percentage}%)`;
                                    }
                                },
                                bodyFont: {
                                    size: 14,
                                    weight: 'bold'
                                },
                                padding: 12,
                                displayColors: false
                            }
                        },
                        animation: {
                            animateScale: true,
                            animateRotate: true
                        }
                    }
                });
            });
        </script>

        {{-- Sensei Chart --}}
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const container = document.getElementById('chartDataContainerSensei');
                const chartDataSensei = JSON.parse(container.getAttribute('data-chart'));
                const chartLabelSensei = JSON.parse(container.getAttribute('data-labels'));
                const colorSensei = JSON.parse(container.getAttribute('data-colors'));
                
                const ctx = document.getElementById('senseisChart').getContext('2d');

                // Función para crear un degradado
                function createGradient(ctx, colorStart, colorEnd) {
                    const gradient = ctx.createLinearGradient(0, 0, 400, 0);
                    gradient.addColorStop(0, colorStart);
                    gradient.addColorStop(1, colorEnd);
                    return gradient;
                }

                // Lista de degradados únicos para cada sección del gráfico
                const gradientColors = [
                    createGradient(ctx, '#266adc87', '#266adc87'), //activos
                    createGradient(ctx, '#555555de', '#674d4d9c'), //inactivos
                ];
                
                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: chartLabelSensei,
                        datasets: [{
                            data: chartDataSensei,
                            backgroundColor: gradientColors,
                            borderColor: '#ffffff',
                            borderWidth: 2,
                            hoverBorderWidth: 2,
                            hoverBackgroundColor: colorSensei.map(color => `${color}DD`),
                            cutout: '70%'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false // Usamos nuestra propia leyenda
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const label = '';
                                        const value = context.raw;
                                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        const percentage = Math.round((value / total) * 100);
                                        return `${label} (${percentage}%)`;
                                    }
                                },
                                bodyFont: {
                                    size: 14,
                                    weight: 'bold'
                                },
                                padding: 12,
                                displayColors: false
                            }
                        },
                        animation: {
                            animateScale: true,
                            animateRotate: true
                        }
                    }
                });
            });
        </script>

        {{-- Student Chart --}}
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const container = document.getElementById('chartDataContainerStudent');
                const chartDataStudent = JSON.parse(container.getAttribute('data-chart'));
                const chartLabelStudent = JSON.parse(container.getAttribute('data-labels'));
                const colorStudent = JSON.parse(container.getAttribute('data-colors'));
                
                const ctx = document.getElementById('studentsChart').getContext('2d');

                // Función para crear un degradado
                function createGradient(ctx, colorStart, colorEnd) {
                    const gradient = ctx.createLinearGradient(0, 0, 400, 0);
                    gradient.addColorStop(0, colorStart);
                    gradient.addColorStop(1, colorEnd);
                    return gradient;
                }

                // Lista de degradados únicos para cada sección del gráfico
                const gradientColors = [
                    createGradient(ctx, '#64f63bed', '#c9e95ed9'),
                    createGradient(ctx, '#555555de', '#674d4d9c'),
                ];
                
                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: chartLabelStudent,
                        datasets: [{
                            data: chartDataStudent,
                            backgroundColor: gradientColors,
                            borderColor: '#ffffff',
                            borderWidth: 2,
                            hoverBorderWidth: 2,
                            hoverBackgroundColor: colorStudent.map(color => `${color}DD`),
                            cutout: '70%'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false // Usamos nuestra propia leyenda
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const label = '';
                                        const value = context.raw;
                                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        const percentage = Math.round((value / total) * 100);
                                        return `${label} (${percentage}%)`;
                                    }
                                },
                                bodyFont: {
                                    size: 14,
                                    weight: 'bold'
                                },
                                padding: 12,
                                displayColors: false
                            }
                        },
                        animation: {
                            animateScale: true,
                            animateRotate: true
                        }
                    }
                });
            });
        </script>

        {{-- Dojo Student Chart --}}
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const container = document.getElementById('chartDataContainerDojoStudent');
                const chartDataStudent = JSON.parse(container.getAttribute('data-chart'));
                const chartLabelStudent = JSON.parse(container.getAttribute('data-labels'));
                const colorStudent = JSON.parse(container.getAttribute('data-colors'));
                
                const ctx = document.getElementById('dojosStudentChart').getContext('2d');

                // Función para crear un degradado
                function createGradient(ctx, colorStart, colorEnd) {
                    const gradient = ctx.createLinearGradient(0, 0, 400, 0);
                    gradient.addColorStop(0, colorStart);
                    gradient.addColorStop(1, colorEnd);
                    return gradient;
                }

                // Lista de degradados únicos para cada sección del gráfico
                const gradientColors = [
                    createGradient(ctx, '#FDE4EA', '#FDE4EA'),
                    createGradient(ctx, '#D1F7EB', '#D1F7EB'),
                    createGradient(ctx, '#FFEED9', '#FFEED9'),
                    createGradient(ctx, '#555555de', '#674d4d9c'),
                ];
                
                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: chartLabelStudent,
                        datasets: [{
                            data: chartDataStudent,
                            backgroundColor: gradientColors,
                            borderColor: '#ffffff',
                            borderWidth: 2,
                            hoverBorderWidth: 2,
                            hoverBackgroundColor: colorStudent.map(color => `${color}DD`),
                            cutout: '70%'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false // Usamos nuestra propia leyenda
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const label = '';
                                        const value = context.raw;
                                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        const percentage = Math.round((value / total) * 100);
                                        return `${label} (${percentage}%)`;
                                    }
                                },
                                bodyFont: {
                                    size: 14,
                                    weight: 'bold'
                                },
                                padding: 12,
                                displayColors: false
                            }
                        },
                        animation: {
                            animateScale: true,
                            animateRotate: true
                        }
                    }
                });
            });
        </script>

        {{-- Event Chart --}}
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const container = document.getElementById('chartDataContainerEvent');
                const chartDataStudent = JSON.parse(container.getAttribute('data-chart'));
                const chartLabelStudent = JSON.parse(container.getAttribute('data-labels'));
                const colorStudent = JSON.parse(container.getAttribute('data-colors'));
                
                const ctx = document.getElementById('eventChart').getContext('2d');

                // Función para crear un degradado
                function createGradient(ctx, colorStart, colorEnd) {
                    const gradient = ctx.createLinearGradient(0, 0, 400, 0);
                    gradient.addColorStop(0, colorStart);
                    gradient.addColorStop(1, colorEnd);
                    return gradient;
                }

                // Lista de degradados únicos para cada sección del gráfico
                const gradientColors = [
                    createGradient(ctx, '#555555de', '#555555de'),
                    createGradient(ctx, '#B5EAD7', '#B5EAD7'),
                    createGradient(ctx, '#FFDAC1', '#FFDAC1'),
                ];
                
                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: chartLabelStudent,
                        datasets: [{
                            data: chartDataStudent,
                            backgroundColor: gradientColors,
                            borderColor: '#ffffff',
                            borderWidth: 2,
                            hoverBorderWidth: 2,
                            hoverBackgroundColor: colorStudent.map(color => `${color}DD`),
                            cutout: '70%'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false // Usamos nuestra propia leyenda
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const label = '';
                                        const value = context.raw;
                                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        const percentage = Math.round((value / total) * 100);
                                        return `${label} (${percentage}%)`;
                                    }
                                },
                                bodyFont: {
                                    size: 14,
                                    weight: 'bold'
                                },
                                padding: 12,
                                displayColors: false
                            }
                        },
                        animation: {
                            animateScale: true,
                            animateRotate: true
                        }
                    }
                });
            });
        </script>

        {{-- Animaciones de Aparicion --}}
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const cajas = document.querySelectorAll(".col-sm-4, .col-sm-7, .col-sm-12, .col-sm-5, .col-sm-6"); 
                console.log(cajas);// Selecciona todas las cajas
                const observer = new IntersectionObserver(entries => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.style.opacity = 1;
                            entry.target.style.transform = "translateY(0)";
                        }
                    });
                }, { threshold: 0.5 });

                cajas.forEach(caja => observer.observe(caja)); // Observa cada caja
            });
        </script>
    @endpush
</div>

