<div x-data='{open: false, openModalDelete: false}' x-cloak>
    
    @push('styles')
        <style>
            /* Estilos generales para las cards */
            .rank-card-container {
                display: flex;
                gap: 20px;
                flex-wrap: wrap;
                justify-content: center;
            }

            .rank-card {
                border-radius: 12px;
                box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
                overflow: hidden;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                background: white;
            }

            .rank-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
            }

            /* Estilos específicos para Kyu */
            .ky-card {
                border-top: 4px solid #e74c3c;
            }

            /* Estilos específicos para Dan */
            .dan-card {
                border-top: 4px solid #2c3e50;
            }

            /* Encabezado de la card */
            .rank-header {
                display: flex;
                align-items: center;
                padding: 10px;
                background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            }

            .ribbon-icon {
                font-size: 32px;
                margin-right: 15px;
                display: flex;
                align-items: center;
                justify-content: center;
                width: 50px;
                height: 50px;
                background: white;
                border-radius: 50%;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            .rank-title {
                margin: 0;
                font-size: 1.8rem;
                color: #343a40;
                font-weight: 600;
            }

            /* Cuerpo de la card */
            .rank-body {
                padding: 20px;
            }

            .rank-description {
                margin: 0 0 15px 0;
                color: #6c757d;
                font-size: 0.9rem;
            }

            .progress-container {
                height: 8px;
                background: #e9ecef;
                border-radius: 4px;
                margin-bottom: 8px;
                overflow: hidden;
            }

            .progress-bar {
                height: 100%;
                border-radius: 4px;
                transition: width 0.6s ease;
            }

            .progress-text {
                font-size: 0.8rem;
                color: #6c757d;
                display: block;
                text-align: right;
            }

            /* Efecto de brillo en el icono */
            .ribbon-icon i {
                filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
            }

            /* Animación para la cinta */
            @keyframes ribbonFloat {
                0% { transform: translateY(0px); }
                50% { transform: translateY(-5px); }
                100% { transform: translateY(0px); }
            }

            .rank-card:hover .ribbon-icon i {
                animation: ribbonFloat 2s ease-in-out infinite;
            }
        </style>
    @endpush

    <!-- Profile Administrador -->
    @if($user->role == "administrador")
        <div class="col-sm-12">
            <div class="panel-custom">
                <div class="modern-container-header">
                    <div class="modern-header">
                        <span class="text-center color-title">{{ __('Editar Perfil') }}</span>
                        <span class="text-center color-paragraph"
                            style="margin:0px;">{{ __('administrador') }}</span>
                    </div>
                </div>

                <!--Icons Addons-->
                <!--===================================================-->
                <form wire:submit='updateUser' wire:key="dojo-form-save">
                    <div class="panel-body" style="padding-top: 0">
                        <div class="row">
                            <!-- Nombre del Dojo -->
                            <div class="col-sm-6">
                                <div class="form-group">

                                    <label class="control-label color-paragraph label-form" for="name"
                                        style="@error('name') color:#e90326; @enderror">Nombre</label>
                                    <div class="input-group mar-btm">
                                        <label class="input-group-addon" for="name"><i
                                                class="fa-solid fa-user"></i></label>
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
                                    <label class="control-label color-paragraph label-form" for="email"
                                        style="@error('email') color:#e90326; @enderror">Correo Electronico</label>
                                    <div class="input-group mar-btm">
                                        <label class="input-group-addon" for="email"><i
                                                class="fa-solid fa-envelope"></i></label>
                                        <input type="text" class="form-control" id="email" wire:model.live='email'
                                            placeholder="Ingrese la ubicación" autocomplete="off" required>
                                    </div>
                                    @error('email')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row"><h4 style="margin:0">Cambio de Contraseña (opcional)</h4></div>
                        <div class="row">
                            {{-- Password --}}
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label color-paragraph label-form" for="password"
                                        style="@error('password') color:#e90326; @enderror">Nueva Contraseña</label>
                                    <div class="input-group mar-btm">
                                        <label class="input-group-addon" for="password"><i
                                                class="fa-solid fa-lock"></i></label>
                                        <input type="password" class="form-control" id="password" wire:model.live='password'
                                            placeholder="Ingrese la contraseña" autocomplete="off">
                                    </div>
                                    @error('password')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- Password Confirmation --}}
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label color-paragraph label-form" for="password_confirmation"
                                        style="@error('password_confirmation') color:#e90326; @enderror">Confirmar Contraseña</label>
                                    <div class="input-group mar-btm">
                                        <label class="input-group-addon" for="password_confirmation"><i
                                                class="fa-solid fa-lock"></i></label>
                                        <input type="password" class="form-control" id="password_confirmation" wire:model.live='password_confirmation'
                                            placeholder="Confirme la contraseña" autocomplete="off">
                                    </div>
                                    @error('password_confirmation')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12" style="display: flex; justify-content: center">
                                <button class="modern-btn-success" type="submit">
                                    <i class="fa-solid fa-check"></i>
                                    <span>Guardar</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    @error('photo')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </form>

                <!--===================================================-->
                <!--End Icons Addons-->
            </div>

            
        </div>
    @endif

    @if($user->role == "sensei")
        <div class="col-sm-12">
            <div class="panel-custom">
                <div class="modern-container-header" style="gap: 10px">
                    <div class="modern-header">
                        <span class="text-center color-title">{{ __('Editar Perfil') }}</span>
                        <span class="text-center color-paragraph"
                            style="margin:0px;">{{ __('sensei') }}</span>
                    </div>
                    <div class="rank-card-container">
                        <!-- Card para Kyu (Estudiantes) -->
                        <div class="rank-card ky-card">
                            <div class="rank-header">
                                <div class="ribbon-icon">
                                    <i class="fas fa-ribbon"></i>
                                </div>
                                <h3 class="rank-title">{{$user->sensei->dan}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                

                <form wire:submit='updateUser()' wire:key="sensei-form">
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

                        {{-- Photo Sensei --}}
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group" style="margin-top:0">
                                    <label class="control-label color-paragraph label-form"
                                        for="file-upload">Agrega una Imagen</label>
                                    <div class="modern-file-input-container"> {{-- Contenedor para el input de archivo --}}

                                        @if ($photoSensei)
                                            <button class="close-btn-image" type="button"
                                                wire:click="removephotoSensei"><i class="fa-solid fa-trash"
                                                    style="font-size: 18px"></i></button>
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
                                </div>
                            </div>
                        </div>
                        <div class="row"><h4 style="margin-bottom:10px">Cambio de Contraseña (opcional)</h4></div>
                        <div class="row">
                            <!-- Password -->
                            <div class="col-sm-6">
                                <div class="form-group" style="margin-top:0">
                                    <label class="control-label color-paragraph label-form" for="passwordSensei"
                                        style="@error('password') color:#e90326; @enderror">Contraseña</label>
                                    <div class="input-group mar-btm">
                                        <label class="input-group-addon" for="passwordSensei"><i class="fa-solid fa-lock"></i></label>
                                        <input type="password" class="form-control" id="passwordSensei" value="{{ old('password') }}" wire:model.live='password' placeholder="Ingrese la contraseña" autocomplete="off" style="z-index:0">
                                    </div>
                                    @error('password')
                                        <div class="alert-error animated shake">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- Password Confirmation --}}
                            <div class="col-sm-6">
                                <div class="form-group" style="margin-top:0">
                                    <label class="control-label color-paragraph label-form" for="passwordConfirmationSensei"
                                        style="@error('password_confirmation') color:#e90326; @enderror">Repetir Contraseña</label>
                                    <div class="input-group mar-btm">
                                        <label class="input-group-addon" for="passwordConfirmationSensei"><i class="fa-solid fa-lock"></i></label>
                                        <input type="password" class="form-control" id="passwordConfirmationSensei" value="{{ old('password_confirmation') }}" wire:model.live='password_confirmation' placeholder="Repita la contraseña" autocomplete="off" style="z-index:0">
                                    </div>
                                    @error('password_confirmation')
                                        <div class="alert-error animated shake">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12" style="display: flex; justify-content: end; gap:10px; ">
                                <button class="cancel-btn-ultimate" type="button">
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
    @endif

    @if($user->role == "estudiante")
        <div class="col-sm-12">
            <div class="panel-custom">
                <div class="modern-container-header" style="gap: 10px">
                    <div class="modern-header">
                        <span class="text-center color-title">{{ __('Editar Perfil') }}</span>
                        <span class="text-center color-paragraph"
                            style="margin:0px;">Atleta</span>
                    </div>
                    <div class="rank-card-container">
                        <!-- Card para Kyu (Estudiantes) -->
                        <div class="rank-card ky-card">
                            <div class="rank-header">
                                <div class="ribbon-icon">
                                    <i class="fas fa-ribbon"></i>
                                </div>
                                <h3 class="rank-title">{{$user->student->kyu}}</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <form wire:submit='updateUser()' wire:key="student-form">
                    <div class="panel-body" style="padding-top: 0">
                        <div class="row">
                            <!-- Nombre del Sensei -->
                            <div class="col-sm-6">
                                <div class="form-group">

                                    <label class="control-label color-paragraph label-form" for="nameStudent"
                                        style="@error('nameStudent') color:#e90326; @enderror">Nombre Completo</label>
                                    <div class="input-group mar-btm">
                                        <label class="input-group-addon" for="nameStudent"><i class="fa-solid fa-user"></i></label>
                                        <input type="text" class="form-control" id="nameStudent" value="{{ old('nameStudent') }}" wire:model.live='nameStudent' placeholder="Ingrese el nombre" autocomplete="off" required>
                                    </div>
                                    @error('nameStudent')
                                        <div class="alert-error animated shake">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email del Sensei -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label color-paragraph label-form" for="emailStudent"
                                        style="@error('emailStudent') color:#e90326; @enderror">Correo Electronico</label>
                                    <div class="input-group mar-btm">
                                        <label class="input-group-addon" for="emailStudent"><i class="fa-solid fa-envelope"></i></label>
                                        <input type="emailStudent" class="form-control" id="emailStudent" value="{{ old('emailStudent') }}" wire:model.live='emailStudent' placeholder="Ingrese el correo electronico" required>
                                    </div>
                                    @error('emailStudent')
                                        <div class="alert-error animated shake">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">

                            <!-- Organizacion del Student -->
                            <div class="col-sm-6">
                                <div class="form-group" style="margin-top:0">
                                    <label class="control-label color-paragraph label-form" for="organizationStudent"
                                        style="@error('organizationStudent') color:#e90326; @enderror">Organización</label>
                                    <div class="input-group mar-btm">
                                        <label class="input-group-addon" for="organizationStudent"><i class="fa-solid fa-users"></i></label>
                                        <input type="organization" class="form-control" id="organizationStudent" value="{{ old('organizationStudent') }}" wire:model.live='organizationStudent' placeholder="Ingrese la organizacion" autocomplete="off" required style="z-index:0">
                                    </div>
                                    @error('organizationStudent')
                                        <div class="alert-error animated shake">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- Date Of Birth --}}
                            <div class="col-sm-6">
                                <label class="control-label color-paragraph label-form" for="display-date" style="@error('dateOfBirthStudent') color:#e90326; @enderror">Fecha de Nacimiento</label>
                                <div class="form-group" style="margin-top:0">    
                                    <div class="input-group mar-btm custom-datepicker">
                                        <label class="input-group-addon" for="display-date"><i class="fa-solid fa-calendar"></i></label>
                                        <input type="text" class="date-input" id="display-date" placeholder="Selecciona tu fecha de nacimiento" readonly>
                                        <!-- Input oculto para el valor SQL -->
                                        <input type="hidden" id="sql-date" name="birthdate" wire:model.live='dateOfBirthStudent' value="{{ old('dateOfBirthStudent') }}">
                                        
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
                                    @error('dateOfBirthStudent')
                                        <div class="alert-error animated shake">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Photo Student --}}
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group" style="margin-top:0">
                                    <label class="control-label color-paragraph label-form"
                                        for="file-upload">Agrega una Imagen</label>
                                    <div class="modern-file-input-container"> {{-- Contenedor para el input de archivo --}}

                                        @if ($photoStudent)
                                            <button class="close-btn-image" type="button"
                                                wire:click="removephotoStudent"><i class="fa-solid fa-trash"
                                                    style="font-size: 18px"></i></button>
                                            {{-- La previsualización de imagen --}}
                                            {{-- Asegúrate de tener un public property $photoStudent y usar Livewire\Features\SupportFileUploads\WithFileUploads --}}
                                            {{-- Y si guardas la imagen, ajusta la URL src --}}
                                            @if (is_a($photoStudent, \Livewire\Features\SupportFileUploads\TemporaryUploadedFile::class))
                                                <div class="modern-image-container">
                                                    <img id="image-preview" class="modern-image-preview"
                                                        src="{{ $photoStudent->temporaryUrl() }}"
                                                        alt="Imagen seleccionada" wire:click='viewImage'>
                                                    <div class="image-overlay-text">
                                                        Ver
                                                    </div>
                                                </div>
                                            @else
                                                {{-- Si $photoStudent es la ruta de la imagen guardada --}}
                                                <img id="image-preview" class="modern-image-preview"
                                                    src="{{ asset('storage/' . $photoStudent) }}" alt="Imagen del dojo">
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
                                                class="file-name">{{ $photoStudent ? ($photoStudent instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile ? $photoStudent->getClientOriginalName() : basename($photoStudent)) : 'Subir Imagen...' }}</span>
                                        </label>

                                        {{-- El input de archivo real (oculto) --}}
                                        {{-- wire:model.live="photoStudent" es correcto para Livewire file uploads --}}
                                        {{-- wire:key='{{$photoStudentKey}}' ayuda a Livewire a manejar el input file --}}
                                        <input type="file" id="file-upload" class="file-input"
                                            wire:model.live="photoStudent" wire:key='{{ $photoStudentKey }}'
                                            style="display:none" accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row"><h4 style="margin-bottom:10px">Cambio de Contraseña (opcional)</h4></div>
                        <div class="row">
                            <!-- Password -->
                            <div class="col-sm-6">
                                <div class="form-group" style="margin-top:0">
                                    <label class="control-label color-paragraph label-form" for="passwordStudent"
                                        style="@error('password') color:#e90326; @enderror">Contraseña</label>
                                    <div class="input-group mar-btm">
                                        <label class="input-group-addon" for="passwordStudent"><i class="fa-solid fa-lock"></i></label>
                                        <input type="password" class="form-control" id="passwordStudent" value="{{ old('password') }}" wire:model.live='password' placeholder="Ingrese la contraseña" autocomplete="off" style="z-index:0">
                                    </div>
                                    @error('password')
                                        <div class="alert-error animated shake">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- Password Confirmation --}}
                            <div class="col-sm-6">
                                <div class="form-group" style="margin-top:0">
                                    <label class="control-label color-paragraph label-form" for="passwordConfirmationStudent"
                                        style="@error('password_confirmation') color:#e90326; @enderror">Repetir Contraseña</label>
                                    <div class="input-group mar-btm">
                                        <label class="input-group-addon" for="passwordConfirmationStudent"><i class="fa-solid fa-lock"></i></label>
                                        <input type="password" class="form-control" id="passwordConfirmationStudent" value="{{ old('password_confirmation') }}" wire:model.live='password_confirmation' placeholder="Repita la contraseña" autocomplete="off" style="z-index:0">
                                    </div>
                                    @error('password_confirmation')
                                        <div class="alert-error animated shake">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12" style="display: flex; justify-content: end; gap:10px; ">
                                <button class="cancel-btn-ultimate" type="button">
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
    @endif

    <!-- Titulo Borrar Cuenta -->
    <div class="col-sm-12">
        <div class="panel-custom animated zoomIn" style='padding-bottom: 10px; margin: 20px 0;'>
            <div class="modern-container-header" style="justify-content:space-beetween; flex-wrap:wrap; gap:15px">
                <div class="modern-header" style="height: 55px">
                    <span class="text-center color-title" style="font-size: 16px">{{ __('Eliminar Cuenta') }}</span>
                    <span class="text-center color-paragraph"
                        style="margin:0px;">{{ __('No podras recuperar la cuenta') }}</span>
                </div>
                <div class="modern-header" style="height: 55px">
                    <button @click="openModalDelete = !openModalDelete" class="delete-btn-ultimate delete-btn-responsive" style="font-size:15px; height: 60px; margin: auto 0">
                        <i class="fa-solid fa-ban" style="font-size:15px"></i>
                        <span>Borrar Cuenta</span>
                    </button>
                </div>
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
                    <span class="text-center color-title">{{ __('Eliminar Cuenta') }}</span>
                </div>
            </div>

            <div class="panel-body">
                <h3 class=" text-center alert alert-danger" style="margin:15px 0;font-size:20px">
                    {{ $message ?? '¿Desea Eliminar la Cuenta?' }}</h3>
                <div class="row" style="margin-top:20px">
                    <div class="col-sm-12" style="display: flex; justify-content: center; gap:10px;">
                        <button class="cancel-btn-ultimate" type="button" @click="openModalDelete = !openModalDelete">
                            <i style="font-size:17px" class="fa-solid fa-xmark"></i>
                            <span style="font-size:17px">Cancelar</span>
                        </button>
                        <button class="delete-btn-ultimate" type="button" wire:click='removeUser()' @click="openModalDelete = !openModalDelete ; openModalSuccess = !openModalSuccess">
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
                    {{ $message ?? ''}}
                </h3>
            </div>
        </div>
    </div>

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
    @endpush
</div>
