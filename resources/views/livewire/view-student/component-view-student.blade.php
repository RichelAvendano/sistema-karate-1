<div>

    

    <!-- Buscador y Tabla -->
    <div x-data='{openEdit:false, openDestroy: false, openStudent: false, activeButton: "sensei", openConfirm1: false, openStudentActive:true, openStudentInactive: false}' x-cloak>
        <div class="panel-custom animated zoomIn" style=' margin: 20px 0;padding:10px'>

            <div class="modern-container-header" style="justify-content:space-around; flex-wrap:wrap; gap:15px">
                <div class="modern-header" style="margin-bottom:5px;">
                    <span class="text-center color-title" style="font-size:25px">{{ __('Buscar Estudiantes') }}</span>
                    <span class="text-center color-paragraph" style="margin:0px;">{{ __('aqui se puede buscar, editar y eliminar estudiantes') }}</span>
                </div>
            </div>
            <!-- Búsqueda -->
            <div class="table-controls">
                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass" style="color:#002569"></i>
                    <input wire:model.live="search" type="text" placeholder="Buscar Estudiantes..." class="search-input">
                </div>

                <!-- Select -->
                <div class="custom-select-container" wire:ignore.self>
                    <div class="custom-select active" x-data="{ isOpen: false }" @click="isOpen = !isOpen" x-cloak>
                        <div class="selected-option">
                            @if ($selectedValueSearch)
                                <div class="option-content">
                                    <div class="dojo-avatar">
                                        <i class="{{$selectedIconSearch}}" style="color:black;font-size:20px"></i>
                                    </div>
                                    <div class="option-text">
                                        <div class="option-title">{{ $selectedLabelSearch }}</div>
                                    </div>
                                </div>
                            @else
                                <span>Selecciona un dojo</span>
                            @endif
                            <i class="fa-solid fa-angle-down"></i>
                        </div>

                        <div class="custom-options" x-show="isOpen" x-transition @click.away="isOpen = false" x-cloak style="">
                            @foreach ($optionsSearch as $index => $option)
                                <div class="option {{ $selectedValueSearch == $option['value'] ? 'selected' : '' }}"
                                    wire:click="selectOptionSearch({{ $index }})">
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
                    <select class="hidden-select" wire:model="selectedValueSearch" required>
                        <option value="" disabled selected>Selecciona un dojo</option>
                        @foreach ($optionsSearch as $option)
                            <option value="{{ $option['value'] }}">{{ $option['title'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Tabla -->
            <div class="table-container" >
                <table class="glass-table animated fadeIn @if ($changeTable) animated fadeIn @endif" style="min-width:700px">
                    <thead>
                        <tr>
                            <th><span>Foto</span></th>
                            <th wire:click="sortByModel('students.name')" class="sortable">
                                <span>Nombre</span>
                                <span>
                                    @if ($sortBy === 'students.name')
                                        <i class="fa-solid fa-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </span>
                            </th>
                            <th wire:click="sortByModel('users.email')" class="sortable">
                                <span>Correo Electronico</span>
                                <span>
                                    @if ($sortBy === 'users.email')
                                        <i class="fa-solid fa-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </span>
                            </th>
                            <th wire:click="sortByModel('students.date_of_birth')" class="sortable">
                                <span>Edad</span>
                                <span>
                                    @if ($sortBy === 'students.date_of_birth')
                                        <i class="fa-solid fa-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </span>
                            </th>
                            <th wire:click="sortByModel('students.kyu')" class="sortable">
                                <span>Kyu</span>
                                <span>
                                    @if ($sortBy === 'students.kyu')
                                        <i class="fa-solid fa-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </span>
                            </th>
                            <th wire:click="sortByModel('students.status')" class="sortable">
                                <span>Estatus</span>
                                <span>
                                    @if ($sortBy === 'students.status')
                                        <i class="fa-solid fa-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </span>
                            </th>
                            <th wire:click="sortByModel('dojos.name')" class="sortable">
                                <span>Dojo</span>
                                <span>
                                    @if ($sortBy === 'dojos.name')
                                        <i class="fa-solid fa-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </span>
                            </th>
                            <th wire:click="sortByModel('senseis.name')" class="sortable">
                                <span>Sensei</span>
                                <span>
                                    @if ($sortBy === 'senseis.name')
                                        <i class="fa-solid fa-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </span>
                            </th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($studentsTotal as $student)
                            <tr wire:key="user-{{ $student->id }}"
                                class="{{ $loop->odd ? 'odd-row' : 'even-row' }} hoverable-row">
                                <td style="display: flex; justify-content:center;">
                                    @if ($student->photo)
                                        <div class="dojo-photo">
                                            <img src="{{ asset('storage/' . $student->photo) }}" alt="{{ $student->studentName }}"
                                                class="dojo-image">
                                        </div>
                                    @else
                                        <div class="dojo-photo">
                                            <img src="{{ asset('image/dojo-default.jpg') }}" class="dojo-image"
                                                alt="dojo-image">
                                        </div>
                                    @endif
                                </td>
                                <td>{{ $student->studentName }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ \Carbon\Carbon::parse($student->dateOfBirth)->age }} años</td>
                                <td>{{ $student->kyu }}</td>
                                <td>
                                    @if($student->status === 'activo')
                                        <div class="text-center alert-error" style="max-width:70px; background: linear-gradient(135deg, #20c53d, #13702d);padding: 2px 5px;">{{$student->status}}</div>
                                    @else
                                        <div class="text-center alert-error" style="max-width:70px;padding: 2px 5px;">{{ $student->status }}</div>
                                    @endif
                                    
                                </td>
                                <td>{{$student->dojoName}}</td>
                                <td>{{$student->senseiName}}</td>
                                <td>
                                    <div class="dojo-actions-ultimate">
                                        @if($student->dojoId)
                                            <button wire:click='studentsSensei({{$student->dojoId}},"{{$student->status}}", {{ $student->id }})' @click="openStudent = !openStudent" class="new-btn-ultimate new-btn-ultimate-table">
                                                <i class="fa-solid fa-user-ninja"></i>
                                            </button>
                                        @else
                                            <button wire:click='studentsSensei(0,"{{$student->status}}",{{ $student->id }})' @click="openStudent = !openStudent" class="new-btn-ultimate new-btn-ultimate-table">
                                                <i class="fa-solid fa-user-ninja"></i>
                                            </button>
                                        @endif
                                        
                                        <button wire:click='editModal({{ $student->id }})' @click="openEdit = !openEdit" class="edit-btn-ultimate edit-btn-ultimate-table">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                        <button wire:click='destroyModal({{ $student->id }},{{$student->user_id}})' @click="openDestroy = !openDestroy" class="delete-btn-ultimate delete-btn-ultimate-table">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                    
                </table>
                {{-- <div wire:loading.flex style="height: 315px; align-items:center; justify-content:center" >
                    <i class="fa-solid fa-circle-notch fa-spin" style="font-size: 100px;width: 100px; height: 100px; color: #da40409f"></i>
                <div> --}}
            </div>
                

        </div>


        <!-- Modal Editar -->
        <div class="modal-overlay" x-show='openEdit' @click.self="openEdit = !openEdit" x-transition:leave.duration.500ms x-transition:enter.duration.500ms>
            <div class="modal-container " :class="openEdit ? 'animated fadeInDown' : 'animated zoomOut'">
                <button class="close-btn-image" @click="openEdit = !openEdit">&times;</button>
                <div class="modern-container-header">
                    <div class="modern-header">
                        <span class="text-center color-title">{{ __('Editar Estudiantes') }}</span>
                        <span class="text-center color-paragraph"
                            style="margin:0px;">{{ __('Edita los Estudiantes') }}</span>
                    </div>
                </div>
                <form wire:submit='updateSensei()' wire:key="sensei-form">
                    <div class="panel-body" style="padding-top: 0">
                        <div class="row">
                            <!-- Nombre del Sensei -->
                            <div class="col-sm-6">
                                <div class="form-group">

                                    <label class="control-label color-paragraph label-form" for="nameSensei"
                                        style="@error('nameSensei') color:#e90326; @enderror">Nombre Completo</label>
                                    <div class="input-group mar-btm">
                                        <label class="input-group-addon" for="nameSensei"><i class="fa-solid fa-user"></i></label>
                                        <input type="text" class="form-control" id="nameSensei" value="{{ old('nameSensei') }}" wire:model.live='nameSensei' placeholder="Ingrese el nombre" autocomplete="off" required>
                                    </div>
                                    @error('nameSensei')
                                        <div class="alert-error animated shake">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email del Sensei -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label color-paragraph label-form" for="emailSensei"
                                        style="@error('emailSensei') color:#e90326; @enderror">Correo Electronico</label>
                                    <div class="input-group mar-btm">
                                        <label class="input-group-addon" for="emailSensei"><i class="fa-solid fa-envelope"></i></label>
                                        <input type="emailSensei" class="form-control" id="emailSensei" value="{{ old('emailSensei') }}" wire:model.live='emailSensei' placeholder="Ingrese el correo electronico" required>
                                    </div>
                                    @error('emailSensei')
                                        <div class="alert-error animated shake">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <!-- Dan -->
                            <div class="col-sm-6">
                                <div class="form-group" style="margin-top:0;position: relative;z-index:2">
                                    <label class="control-label color-paragraph label-form" for="dojo_id" style="@error('$selectedValueDan') color:#e90326; @enderror">Dan</label>
                                    <div class="custom-select-container" wire:ignore.self style="margin:0">
                                        <div class="custom-select active" x-data="{ isOpen: false }" @click="isOpen = !isOpen" x-cloak>
                                            <div class="selected-option">
                                                @if ($selectedValueDan)
                                                    <div class="option-content">
                                                        <div class="dojo-avatar">
                                                            <i class="{{$selectedIconDan}}" style="color:black;font-size:20px"></i>
                                                        </div>
                                                        <div class="option-text">
                                                            <div class="option-title">{{ $selectedValueDan }}</div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <span>Selecciona un Dan</span>
                                                @endif
                                                <i class="fa-solid fa-angle-down"></i>
                                            </div>
                    
                                            <div class="custom-options" x-show="isOpen" x-transition @click.away="isOpen = false" x-cloak style="">
                                                @foreach ($optionsDan as $index => $option)
                                                    <div class="option {{ $selectedValueDan == $option['value'] ? 'selected' : '' }}"
                                                        wire:click="selectOptionDan({{ $index }})">
                                                        <div class="option-content">
                                                            <div class="dojo-avatar">
                                                                <i class="fa-solid fa-ribbon" style="color:black;font-size:20px"></i>
                                                            </div>
                                                            <div class="option-text">
                                                                <div class="option-title">{{ $option['value'] }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                    
                                        </div>
                    
                                        <!-- Select oculto para formularios -->
                                        <select class="hidden-select" wire:model="selectedValueDan" required>
                                            <option value="" disabled selected>Selecciona un dojo</option>
                                            @foreach ($optionsDan as $option)
                                                <option value="{{ $option['value'] }}"></option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('selectedValueDan')
                                    <div class="alert-error animated shake">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Date Of Birth --}}
                            <div class="col-sm-6">
                                <label class="control-label color-paragraph label-form" for="display-date" style="@error('dateOfBirthSensei') color:#e90326; @enderror">Fecha de Nacimiento</label>
                                <div class="form-group" style="margin-top:0">    
                                    <div class="input-group mar-btm custom-datepicker">
                                        <label class="input-group-addon" for="display-date"><i class="fa-solid fa-calendar"></i></label>
                                        <input type="text" class="date-input" id="display-date" placeholder="Selecciona tu fecha de nacimiento" readonly>
                                        <!-- Input oculto para el valor SQL -->
                                        <input type="hidden" id="sql-date" name="birthdate" wire:model.live='dateOfBirthSensei' value="{{ old('dateOfBirthSensei') }}">
                                        
                                        <div class="calendar-container" id="calendar">
                                            <div class="calendar-header">
                                                <div class="month-year">
                                                    <select id="month-select" style="max-height: 100px !important"></select>
                                                    <select id="year-select"></select>
                                                </div>
                                                <div class="nav-buttons">
                                                    <button type="button" class="nav-button" id="prev-month">‹</button>
                                                    <button type="button" class="nav-button" id="next-month">›</button>
                                                </div>
                                            </div>
                                            
                                            <div class="weekdays">
                                                <div>Lun</div>
                                                <div>Mar</div>
                                                <div>Mié</div>
                                                <div>Jue</div>
                                                <div>Vie</div>
                                                <div>Sáb</div>
                                                <div>Dom</div>
                                            </div>
                                            
                                            <div class="days-grid" id="days-grid"></div>
                                            
                                            <div class="calendar-footer">
                                                <button type="button" class="today-button" id="today-btn">Hoy</button>
                                                <button type="button" class="clear-button" id="clear-btn">Limpiar</button>
                                            </div>
                                        </div>
                                    </div>
                                    @error('dateOfBirthSensei')
                                        <div class="alert-error animated shake">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Organizacion del Sensei -->
                            <div class="col-sm-6">
                                <div class="form-group" style="margin-top:0">
                                    <label class="control-label color-paragraph label-form" for="organizationSensei"
                                        style="@error('organizationSensei') color:#e90326; @enderror">Organización</label>
                                    <div class="input-group mar-btm">
                                        <label class="input-group-addon" for="organizationSensei"><i class="fa-solid fa-users"></i></label>
                                        <input type="organization" class="form-control" id="organizationSensei" value="{{ old('organizationSensei') }}" wire:model.live='organizationSensei' placeholder="Ingrese la organizacion" autocomplete="off" required style="z-index:0">
                                    </div>
                                    @error('organizationSensei')
                                        <div class="alert-error animated shake">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- Select Dojo --}}
                            <div class="col-sm-6">
                                <label class="control-label color-paragraph label-form" for="dojo_id" style="@error('$dojoIdSensei') color:#e90326; @enderror">Sensei Asignado</label>
                                <div class="form-group" style="margin-top:0; position:relative; z-index:1">
                                    <div class="custom-select-container" wire:ignore.self style="margin:0">
                                        <div class="custom-select active" x-data="{ isOpen: false }" @click="isOpen = !isOpen" x-cloak id="dojo_id">
                                            <div class="selected-option">
                                                @if ($dojoIdSensei)
                                                    <div class="option-content">
                                                        <div class="dojo-avatar">
                                                            @if($selectedPhoto)
                                                                <img class="dojo-image" src="{{ asset('storage/'.$selectedPhoto) }}">
                                                            @else
                                                                <img class="dojo-image" src="{{ asset('image/dojo-default.jpg') }}">
                                                            @endif                                 
                                                        </div>
                                                        <div class="option-text">
                                                            <div class="option-title">{{ $selectedLabel }}</div>
                                                            <div class="option-subtitle"><i class="fa-solid fa-vihara" style="color:black"></i>{{ $selectedSubtitle }}</div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="option-content">
                                                        <div class="dojo-avatar">
                                                            <span class="fa-stack fa-2x">
                                                                <i class="fa-solid fa-user-ninja fa-stack-1x" style="color:black"></i>
                                                                <i class="fa-solid fa-ban fa-stack-2x" style="color:tomato"></i>
                                                            </span>
                                                        </div>
                                                        <div class="option-text">
                                                            <div class="option-title">Sin Sensei</div>
                                                        </div>
                                                    </div>     
                                                @endif
                                                <i class="fa-solid fa-angle-down"></i>
                                            </div>
        
                                            <div class="custom-options" x-show="isOpen" x-transition @click.away="isOpen = false" x-cloak>
                                                @if ($optionsDojos)
                                                    <!-- Dejar sin Sensei el Dojo -->
                                                    @if($dojoIdSensei) 
                                                        <div class="option" wire:click="selectOption('inactivo')">
                                                            <div class="option-content">
                                                                <div class="option-content">
                                                                    <div class="dojo-avatar">
                                                                        <span class="fa-stack fa-2x">
                                                                            <i class="fa-solid fa-user-ninja fa-stack-1x" style="color:black"></i>
                                                                            <i class="fa-solid fa-ban fa-stack-2x" style="color:tomato"></i>
                                                                        </span>
                                                                    </div>
                                                                    <div class="option-text">
                                                                        <div class="option-title">No asignar Sensei</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <!--Hay dojos Disponibles -->
                                                    @foreach ($optionsDojos as $index => $option)
                                                        <div class="option {{ $dojoIdSensei == $option['value'] ? 'selected' : '' }}"
                                                            wire:click="selectOption({{ $index }})">
                                                            <div class="option-content">
                                                                <div class="dojo-avatar">
                                                                    @if($option['photo'])
                                                                        <img class="dojo-image" src="{{ asset('storage/'.$option['photo']) }}">
                                                                    @else
                                                                        <img class="dojo-image" src="{{ asset('image/dojo-default.jpg') }}">
                                                                    @endif
                                                                    
                                                                </div>
                                                                <div class="option-text">
                                                                    <div class="option-title">{{ $option['title'] }}</div>
                                                                    <i class="fa-solid fa-vihara" style="color:black"></i> <span class="option-subtitle">{{ $option['subtitle'] }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <!-- No hay dojos disponibles --> 
                                                    <div class="option">
                                                        <div class="option-content">
                                                            <div class="option-content">
                                                                <div class="dojo-avatar">
                                                                    
                                                                    <i class="fa-solid fa-triangle-exclamation fa-4x" style="color:Tomato"></i>
                                                                </div>
                                                                <div class="option-text">
                                                                    <div class="option-title">No hay Dojos Disponibles</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif        
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @error('dojoIdSensei')
                                    <div class="alert-error animated shake">{{ $message }}</div>
                                @enderror                             
                            </div>
                        </div>
                        {{-- Photo Sensei --}}
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group" style="margin-top:0">
                                    <label class="control-label color-paragraph label-form"
                                        for="file-upload">Agrega una Imagen</label>
                                    <div class="modern-file-input-container"> {{-- Contenedor para el input de archivo --}}

                                        @if ($photoSensei)
                                            <div class="close-btn-image" 
                                                wire:click="removephotoSensei"><i class="fa-solid fa-trash"
                                                    style="font-size: 18px"></i></div>
                                            {{-- La previsualización de imagen --}}
                                            {{-- Asegúrate de tener un public property $photoSensei y usar Livewire\Features\SupportFileUploads\WithFileUploads --}}
                                            {{-- Y si guardas la imagen, ajusta la URL src --}}
                                            @if (is_a($photoSensei, \Livewire\Features\SupportFileUploads\TemporaryUploadedFile::class))
                                                <div class="modern-image-container">
                                                    <img id="image-preview" class="modern-image-preview"
                                                        src="{{ $photoSensei->temporaryUrl() }}"
                                                        alt="Imagen seleccionada" wire:click='viewImage'>
                                                    <div class="image-overlay-text">
                                                        Ver
                                                    </div>
                                                </div>
                                            @else
                                                {{-- Si $photoSensei es la ruta de la imagen guardada --}}
                                                <img id="image-preview" class="modern-image-preview"
                                                    src="{{ asset('storage/' . $photoSensei) }}" alt="Imagen del dojo">
                                            @endif
                                        @else
                                            {{-- Icono placeholder si no hay imagen --}}
                                            <i class="fa-solid fa-camera modern-image-preview"
                                                style="font-size: 3rem; color: #1d4ea9; border: none;"></i>
                                        @endif

                                        {{-- La etiqueta que actúa como botón --}}
                                        <label for="file-upload" class="file-label">
                                            <i class="fas fa-upload"></i>
                                            {{-- Muestra el nombre del archivo o un texto por defecto --}}
                                            <span
                                                class="file-name">{{ $photoSensei ? ($photoSensei instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile ? $photoSensei->getClientOriginalName() : basename($photoSensei)) : 'Subir Imagen...' }}</span>
                                        </label>

                                        {{-- El input de archivo real (oculto) --}}
                                        {{-- wire:model.live="photoSensei" es correcto para Livewire file uploads --}}
                                        {{-- wire:key='{{$photoSenseiKey}}' ayuda a Livewire a manejar el input file --}}
                                        <input type="file" id="file-upload" class="file-input"
                                            wire:model.live="photoSensei" wire:key='{{ $photoSenseiKey }}'
                                            style="display:none" accept="image/*">
                                    </div>
                                    @error('photoSensei')
                                        <div class="alert-error animated shake">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
 
                        <div class="row">
                            <!-- Password -->
                            <div class="col-sm-6">
                                <div class="form-group" style="margin-top:0">
                                    <label class="control-label color-paragraph label-form" for="passwordSensei"
                                        style="@error('passwordSensei') color:#e90326; @enderror">Contraseña</label>
                                    <div class="input-group mar-btm">
                                        <label class="input-group-addon" for="passwordSensei"><i class="fa-solid fa-lock"></i></label>
                                        <input type="password" class="form-control" id="passwordSensei" value="{{ old('passwordSensei') }}" wire:model.live='passwordSensei' placeholder="Ingrese la contraseña" autocomplete="off" style="z-index:0">
                                    </div>
                                    @error('passwordSensei')
                                        <div class="alert-error animated shake">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- Password Confirmation --}}
                            <div class="col-sm-6">
                                <div class="form-group" style="margin-top:0">
                                    <label class="control-label color-paragraph label-form" for="passwordConfirmationSensei"
                                        style="@error('passwordConfirmationSensei') color:#e90326; @enderror">Repetir Contraseña</label>
                                    <div class="input-group mar-btm">
                                        <label class="input-group-addon" for="passwordConfirmationSensei"><i class="fa-solid fa-lock"></i></label>
                                        <input type="password" class="form-control" id="passwordConfirmationSensei" value="{{ old('passwordConfirmationSensei') }}" wire:model.live='passwordConfirmationSensei' placeholder="Repita la contraseña" autocomplete="off" style="z-index:0">
                                    </div>
                                    @error('passwordConfirmationSensei')
                                        <div class="alert-error animated shake">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12" style="display: flex; justify-content: end; gap:10px; ">
                                <button class="cancel-btn-ultimate" type="button"
                                    @click="openEdit = !openEdit">
                                    <i class="fa-solid fa-xmark"></i>
                                    <span>Cancelar</span>
                                </button>
                                <button class="modern-btn-success" type="submit" >
                                    <i class="fa-solid fa-check"></i>
                                    <span>Guardar</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>

        <!-- Modal Alumnos -->
        <div class="modal-overlay" x-show='openStudent' @click.self="openStudent = !openStudent" x-transition:leave.duration.500ms x-transition:enter.duration.500ms>
            <div class="modal-container " :class="openStudent ? 'animated fadeInDown' : 'animated zoomOut'" style="max-width:90vw">
                <button class="close-btn-image" @click="openStudent = !openStudent" style="z-index:100">&times;</button>
                <div class="modern-container-header" style="justify-content:space-around; flex-wrap:wrap; gap:15px; margin-bottom:20px">
                    <div class="modern-header">
                        <span class="text-center color-title">{{ __('Sensei del Alumno') }}</span>
                        <span class="text-center color-paragraph"
                            style="margin:0px;">{{ __('Modifica el Sensei del Estudiante') }}</span>
                    </div>
                    @if($statusSensei == 'activo')
                        <div class="modern-header">
                            <span class="text-center color-title">{{ __('Ver Senseis') }}</span>
                            <div class="" style="display: flex;gap: 10px">
                                <button class="edit-btn-ultimate" 
                                    wire:click="studentsActive" 
                                    @click="activeButton = 'sensei'"
                                    :class="activeButton === 'noSensei' ? 'active' : ''">
                                    <i class="fa-solid fa-user-ninja"></i>
                                    <span style="font-weight:700">Del Alumno</span>
                                </button>

                                <button class="edit-btn-ultimate" 
                                    wire:click="studentsInactive" 
                                    @click="activeButton = 'noSensei'"
                                    :class="activeButton === 'sensei' ? 'active' : ''">
                                    <i class="fa-solid fa-user-ninja"></i>
                                    <span style="font-weight:700">Senseis Disponibles</span>
                                </button>
                            </div>
                        </div>
                    @elseif($statusSensei == 'inactivo')
                        <div class="modern-header">
                            <span class="text-center color-title">{{ __('Ver Senseis') }}</span>
                            <div class="" style="display: flex;gap: 10px">
                                <button class="edit-btn-ultimate" 
                                    wire:click="studentsInactive" 
                                    @click="activeButton = 'noSensei'"
                                    :class="activeButton === 'sensei' ? 'active' : ''">
                                    <i class="fa-solid fa-user-ninja"></i>
                                    <span style="font-weight:700">Senseis Disponibles</span>
                                </button>
                            </div>
                        </div>
                    @endif
                    
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

                        <!-- Select oculto para formularios -->
                        <select class="hidden-select" wire:model="selectedValueSearch" required>
                            <option value="" disabled selected>Selecciona un dojo</option>
                            @foreach ($optionsSearchStudent as $option)
                                <option value="{{ $option['value'] }}">{{ $option['title'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div> 
                <!-- Card Dojos -->
                <div class="grid-container animated zoomIn" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));">
                    @if($studentsActive->count() > 0 && $studentsActiveSelected)
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
                                <div class="dojo-content-ultimate" style="width: 100%;padding: 20px; height: 140px">

                                    <i x-show="activeButton == 'sensei'" wire:click='modalConfirmStudent("removeStudent", {{$student->id}})' class="fa-solid fa-trash close-btn-image" style="background-color:white;padding:5px;position:absolute; top:10px; right:7px; font-size:17px;z-index:1000;border-radius:20px" @click="openConfirm1 = !openConfirm1"></i>
                                    <div class="dojo-text-content" style="margin:0">
                                        
                                        <h4 class="dojo-title-ultimate">{{ $student->name }}</h4>
                                        <h5 class="dojo-desc-ultimate" style="font-size:15px">
                                            <i class="fa-solid fa-vihara"></i>
                                            @if($student->dojo->name)
                                                {{ $student->dojo->name }}
                                            @endif
                                        </h5>
                                        <div class="dojo-location-ultimate">
                                            
                                            <span>Edad: {{ \Carbon\Carbon::parse($student->date_of_birth)->age }}</span>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                        @endforeach
                    @elseif($studentsActiveSelected)
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
                                    <h3 class=" text-center alert alert-danger" style="margin:15px 0;font-size:20px">Este Alumno no tiene Senseis Asignados</h3>
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
                                <div class="dojo-content-ultimate" style="width: 100%;padding: 20px; height: 140px">

                                    <i x-show="activeButton == 'noSensei'" wire:click='modalConfirmStudent("addStudent", {{$student->id}})' class="fa-solid fa-plus close-btn-image" style="background-color:white;padding:5px;position:absolute; top:10px; right:7px; font-size:17px;z-index:1000;border-radius:20px" @click="openConfirm1 = !openConfirm1"></i>
                                    <div class="dojo-text-content" style="margin:0">
                                        
                                        <h4 class="dojo-title-ultimate">{{ $student->name }}</h4>
                                        <h5 class="dojo-desc-ultimate" style="font-size:15px"><i class="fa-solid fa-vihara"></i> {{ $student->dojo->name }}</h5>
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
                                    <h3 class=" text-center alert alert-danger" style="margin:15px 0;font-size:20px">No hay Senseis Disponibles en estos momentos</h3>
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

        <!-- Confirmar Cambio de Estudiante -->
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

                            @if($statusModalConfirm == 'addStudent')
                                <button class="new-btn-ultimate" type="button" wire:click='addStudentSensei' @click="openConfirm1 = !openConfirm1, openStudent = !openStudent">
                                    <i class="fa-solid fa-check" style="font-size:17px"></i>
                                    <span style="font-size:17px">Guardar</span>
                                </button>
                            @elseif($statusModalConfirm == 'removeStudent')
                                <button class="new-btn-ultimate" type="button" wire:click='removeStudentSensei' @click="openConfirm1 = !openConfirm1, openStudent = !openStudent">
                                    <i class="fa-solid fa-check" style="font-size:17px"></i>
                                    <span style="font-size:17px">Guardar</span>
                                </button>
                            @endif
                            
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Modal Eliminar -->
        <div x-show='openDestroy' wire:key="destroy-modal" class="modal-overlay" @click.self="openDestroy = !openDestroy" x-transition:leave.duration.500ms x-transition:enter.duration.500ms>
            <div class="modal-container" style="max-width:500px" :class="openDestroy ? 'animated fadeInDown' : 'animated zoomOut'">
                <button class="close-btn-image" @click="openDestroy = !openDestroy">&times;</button>
                <div class="modern-container-header">
                    <div class="modern-header">
                        <i class="fa-solid fa-triangle-exclamation fa-beat"
                            style="font-size: 1.8rem; color: #ac2b2b; margin-bottom: 15px; font-size:50px; display:block"></i>
                        <span class="text-center color-title">{{ __('Eliminar Sensei') }}</span>
                    </div>
                </div>

                <div class="panel-body">
                    <h3 class=" text-center alert alert-danger" style="margin:15px 0;font-size:20px">
                        {{ $message }}</h3>
                    <div class="row" style="margin-top:20px">
                        <div class="col-sm-12" style="display: flex; justify-content: center; gap:10px;">
                            <button class="cancel-btn-ultimate" type="button" @click="openDestroy = !openDestroy">
                                <i style="font-size:17px" class="fa-solid fa-xmark"></i>
                                <span style="font-size:17px">Cancelar</span>
                            </button>
                            <button class="delete-btn-ultimate" type="button" wire:click='destroy({{ $id_selected }},{{$user_id_selected}})' @click="openDestroy = !openDestroy">
                                <i class="fa-solid fa-trash" style="font-size:17px"></i>
                                <span style="font-size:17px">Eliminar</span>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
    
    @if ($successMessage)
        <div wire:key="success-modal" x-data="{ open: true }" x-show="open" x-init="setTimeout(() => {
            open = false;
        }, 5000);
        {{-- Temporizador de 10 segundos --}}
        $watch('open', value => {
            if (!value) {
                {{-- Si 'open' cambia a false --}}
                $wire.call('clearSuccessMessage');
                {{-- Llama al método Livewire --}}
            }
        })"
            wire:click.self="clearSuccessMessage" {{-- Cierra y llama Livewire al hacer clic en el overlay --}} class="modal-overlay"
            :class="{ 'active': open }">
            <div class="modal-container animated bounceIn @if ($closeAnimation) animated zoomOut @endif"
                style="max-width:500px">
                <button class="close-btn-image" wire:click="clearSuccessMessage">&times;</button>
                <div class="modern-container-header">
                    <div class="modern-header">
                        <i class="fa-solid fa-circle-check fa-beat"
                            style="font-size: 1.8rem; color: #2bac47; margin-bottom: 15px; font-size:50px; display:block"></i>
                        <span class="text-center color-title">{{ __('Proceso Exitoso') }}</span>
                    </div>
                </div>

                <h3 class="text-center alert alert-success" style="margin: 20px 0;font-size:20px">{{ $message }}
                </h3>

            </div>
        </div>
    @endif
    

    {{ $studentsTotal->links('vendor.livewire.bootstrap') }}
    
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elementos del DOM con verificación de existencia
            const elements = {
                displayDateInput: document.getElementById('display-date'),
                sqlDateInput: document.getElementById('sql-date'),
                calendar: document.getElementById('calendar'),
                daysGrid: document.getElementById('days-grid'),
                monthSelect: document.getElementById('month-select'),
                yearSelect: document.getElementById('year-select'),
                prevMonthBtn: document.getElementById('prev-month'),
                nextMonthBtn: document.getElementById('next-month'),
                todayBtn: document.getElementById('today-btn'),
                clearBtn: document.getElementById('clear-btn')
            };
        
            // Verificar que todos los elementos existan
            if (Object.values(elements).some(el => !el)) {
                console.error('Algunos elementos del datepicker no se encontraron');
                return;
            }
        
            // Variables de estado
            let currentDate = new Date();
            let selectedDate = null;
            let isUpdatingFromLivewire = false;
            let isUserInteraction = false;
        
            // Función para sincronizar desde Livewire
            function syncFromLivewire() {
                if (!elements.sqlDateInput.value || isUserInteraction) return;
                
                isUpdatingFromLivewire = true;
                
                try {
                    const [year, month, day] = elements.sqlDateInput.value.split('-');
                    selectedDate = new Date(year, month - 1, day);
                    currentDate = new Date(selectedDate);
                    
                    updateInputsFromSelectedDate(false);
                    initSelects();
                    renderCalendar();
                } catch (error) {
                    console.error('Error al procesar fecha:', error);
                }
                
                setTimeout(() => isUpdatingFromLivewire = false, 100);
            }
        
            // Observador de cambios seguro
            function setupLivewireListener() {
                const observer = new MutationObserver(mutations => {
                    if (!isUserInteraction && !isUpdatingFromLivewire) {
                        syncFromLivewire();
                    }
                });
        
                observer.observe(elements.sqlDateInput, { 
                    attributes: true, 
                    attributeFilter: ['value'],
                    childList: false,
                    subtree: false
                });
        
                return observer;
            }
        
            // Formatear fecha a SQL
            function formatDateToSQL(date) {
                if (!date) return '';
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const day = String(date.getDate()).padStart(2, '0');
                return `${year}-${month}-${day}`;
            }
        
            // Inicializar selects
            function initSelects() {
                const months = [
                    'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                    'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                ];
                
                elements.monthSelect.innerHTML = '';
                months.forEach((month, index) => {
                    const option = document.createElement('option');
                    option.value = index;
                    option.textContent = month;
                    option.selected = selectedDate ? index === selectedDate.getMonth() : index === currentDate.getMonth();
                    elements.monthSelect.appendChild(option);
                });
                
                elements.yearSelect.innerHTML = '';
                const currentYear = new Date().getFullYear();
                for (let i = currentYear - 120; i <= currentYear; i++) {
                    const option = document.createElement('option');
                    option.value = i;
                    option.textContent = i;
                    option.selected = selectedDate ? i === selectedDate.getFullYear() : i === currentDate.getFullYear();
                    elements.yearSelect.appendChild(option);
                }
            }
        
            // Actualizar inputs
            function updateInputsFromSelectedDate(triggerEvent = true) {
                if (!selectedDate) return;
                
                currentDate = new Date(selectedDate);
                updateSelectsFromCurrentDate();
                
                const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                elements.displayDateInput.value = selectedDate.toLocaleDateString('es-ES', options);
                elements.sqlDateInput.value = formatDateToSQL(selectedDate);
                
                if (triggerEvent && !isUpdatingFromLivewire) {
                    triggerLivewireUpdate();
                }
            }
        
            // Actualizar selects
            function updateSelectsFromCurrentDate() {
                elements.monthSelect.value = currentDate.getMonth();
                elements.yearSelect.value = currentDate.getFullYear();
            }
        
            // Trigger para Livewire
            function triggerLivewireUpdate() {
                isUserInteraction = true;
                
                setTimeout(() => {
                    const event = new Event('input', { bubbles: true });
                    Object.defineProperty(event, 'target', { value: elements.sqlDateInput });
                    elements.sqlDateInput.dispatchEvent(event);
                    
                    setTimeout(() => isUserInteraction = false, 200);
                }, 50);
            }
        
            // Renderizar calendario
            function renderCalendar() {
                elements.daysGrid.innerHTML = '';
                
                const year = currentDate.getFullYear();
                const month = currentDate.getMonth();
                const firstDay = new Date(year, month, 1);
                const lastDay = new Date(year, month + 1, 0);
                const daysInMonth = lastDay.getDate();
                const startingDay = firstDay.getDay() === 0 ? 6 : firstDay.getDay() - 1;
                const prevMonthLastDay = new Date(year, month, 0).getDate();
                const today = new Date();
        
                // Días del mes anterior
                for (let i = 0; i < startingDay; i++) {
                    const day = document.createElement('div');
                    day.className = 'day other-month';
                    day.textContent = prevMonthLastDay - startingDay + i + 1;
                    elements.daysGrid.appendChild(day);
                }
                
                // Días del mes actual
                for (let i = 1; i <= daysInMonth; i++) {
                    const day = document.createElement('div');
                    const date = new Date(year, month, i);
                    
                    day.className = 'day';
                    day.textContent = i;
                    
                    if (date.toDateString() === today.toDateString()) {
                        day.classList.add('today');
                    }
                    
                    if (selectedDate && date.toDateString() === selectedDate.toDateString()) {
                        day.classList.add('selected');
                    }
                    
                    day.addEventListener('click', () => {
                        selectedDate = date;
                        updateInputsFromSelectedDate(true);
                        elements.calendar.style.display = 'none';
                    });
                    
                    elements.daysGrid.appendChild(day);
                }
                
                // Días del próximo mes (solo 5 semanas)
                const totalCells = 35;
                const remainingDays = totalCells - (startingDay + daysInMonth);
                for (let i = 1; i <= remainingDays; i++) {
                    const day = document.createElement('div');
                    day.className = 'day other-month';
                    day.textContent = i;
                    elements.daysGrid.appendChild(day);
                }
            }
        
            // Event Listeners
            elements.displayDateInput.addEventListener('click', (e) => {
                e.stopPropagation();
                elements.calendar.style.display = elements.calendar.style.display === 'block' ? 'none' : 'block';
                if (elements.calendar.style.display === 'block') {
                    if (selectedDate) currentDate = new Date(selectedDate);
                    initSelects();
                    renderCalendar();
                }
            });
            
            elements.monthSelect.addEventListener('change', () => {
                currentDate.setMonth(parseInt(elements.monthSelect.value));
                renderCalendar();
            });
            
            elements.yearSelect.addEventListener('change', () => {
                currentDate.setFullYear(parseInt(elements.yearSelect.value));
                renderCalendar();
            });
            
            elements.prevMonthBtn.addEventListener('click', () => {
                currentDate.setMonth(currentDate.getMonth() - 1);
                updateSelectsFromCurrentDate();
                renderCalendar();
            });
            
            elements.nextMonthBtn.addEventListener('click', () => {
                currentDate.setMonth(currentDate.getMonth() + 1);
                updateSelectsFromCurrentDate();
                renderCalendar();
            });
            
            elements.todayBtn.addEventListener('click', () => {
                currentDate = new Date();
                selectedDate = new Date();
                updateSelectsFromCurrentDate();
                updateInputsFromSelectedDate(true);
                renderCalendar();
            });
            
            elements.clearBtn.addEventListener('click', () => {
                selectedDate = null;
                elements.displayDateInput.value = '';
                elements.sqlDateInput.value = '';
                triggerLivewireUpdate();
            });
            
            document.addEventListener('click', () => {
                elements.calendar.style.display = 'none';
            });
            
            elements.calendar.addEventListener('click', (e) => {
                e.stopPropagation();
            });
        
            // Inicialización
            const observer = setupLivewireListener();
            syncFromLivewire();
            
            // Limpieza al navegar
            if (typeof Livewire !== 'undefined') {
                document.addEventListener('livewire:navigated', () => {
                    observer.disconnect();
                    setTimeout(() => {
                        setupLivewireListener();
                        syncFromLivewire();
                    }, 50);
                });
            }
        });
    </script>

    <script>
        Livewire.on('refreshComponent', () => {
            location.reload(); // ✅ Fuerza una actualización de la página
        });
    </script>

    @endpush
</div>

