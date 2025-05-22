<div>
    @push('styles')
        
    @endpush

    <!-- Titulo y Modal para Crear Usuarios -->
    <div x-data='{open: true, openTab1: true, openTab2: false, openTab3: false}'>
        <div class="panel-custom animated fadeIn" style='padding-bottom: 10px; margin: 20px 0;'>
            <div class="modern-container-header" style="justify-content:space-around; flex-wrap:wrap; gap:15px">
                <div class="modern-header">
                    <span class="text-center color-title">{{ __('Panel de Administrador') }}</span>
                    <span class="text-center color-paragraph" style="margin:0px;">{{ __('Aqui puedes crear cualquier usuario') }}</span>
                </div>
                <div class="modern-header">
                    <span class="text-center color-title">{{ __('Crear Usuarios') }}</span>
                    <div class="" style="display: flex;gap: 10px">
                        <button @click="open = !open" class="new-btn-ultimate" style="font-size:16px;">
                            <i x-show="!open" class="fa-solid fa-square-plus" style="font-size:16px"></i>
                            <i x-show="open" class="fa-solid fa-xmark" style="font-size:16px"></i>                           
                            <span x-text="open ? 'Cerrar' : 'Nuevo'"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Modal para Usuarios y Botones -->
        <div x-show="open" x-transition.duration.200ms>

            <div class="panel-custom " style="border-bottom: none;border-radius: 10px 10px 0px 0px;display:inline-block">
                <div class="modern-container-header" style="justify-content: start; flex-wrap: wrap; gap: 0 3px; padding: 7px; margin:0">
                    <button :class="openTab1 ? 'active' : ''" 
                        @click="if (!openTab1) { openTab1 = true; openTab2 = false; openTab3 = false }" 
                        type="button" class="modern-header-tab"
                        style="border-radius: 10px 10px 0px 0px;">
                        <span class="text-center color-title" style="color:white; font-size: 20px">{{ __('Administrador') }}</span>
                    </button>
                    
                    <button :class="openTab2 ? 'active' : ''" 
                        @click="if (!openTab2) { openTab2 = true; openTab1 = false; openTab3 = false }" 
                        type="button" class="modern-header-tab"
                        style="border-radius: 10px 10px 0px 0px;">
                        <span class="text-center color-title" style="color:white; font-size: 20px">{{ __('Sensei') }}</span>
                    </button>
                    
                    <button :class="openTab3 ? 'active' : ''" 
                        @click="if (!openTab3) { openTab3 = true; openTab1 = false; openTab2 = false }" 
                        type="button" class="modern-header-tab"
                        style="border-radius: 10px 10px 0px 0px;">
                        <span class="text-center color-title" style="color:white; font-size: 20px">{{ __('Estudiante') }}</span>
                    </button>
                </div>
            </div>

            <!-- Modal para Administradores -->
            <div x-show="openTab1" class="panel-custom" style="border-radius: 0 0 10px 10px;border-top: none;padding-top:20px" x-transition.duration.100ms>
                
                <div class="modern-container-header" style="margin:0;">
                    <div class="modern-header">
                        <span class="text-center color-title">{{ __('Nuevo Administrador') }}</span>
                    </div>
                </div>

                <!--Icons Addons-->
                <!--===================================================-->
                <form wire:submit='saveAdmin' wire:key="admin-form">
                    <div class="panel-body" style="padding-top: 0">
                        <div class="row">
                            <!-- Nombre del Admin -->
                            <div class="col-sm-6">
                                <div class="form-group">

                                    <label class="control-label color-paragraph label-form" for="nameAdmin"
                                        style="@error('nameAdmin') color:#e90326; @enderror">Nombre Completo</label>
                                    <div class="input-group mar-btm">
                                        <label class="input-group-addon" for="nameAdmin"><i class="fa-solid fa-user"></i></label>
                                        <input type="text" class="form-control" id="nameAdmin" value="{{ old('nameAdmin') }}" wire:model.live='nameAdmin' placeholder="Ingrese el nombre" autocomplete="off" required>
                                    </div>
                                    @error('nameAdmin')
                                        <div class="alert-error animated shake">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email del Admin -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label color-paragraph label-form" for="emailAdmin"
                                        style="@error('emailAdmin') color:#e90326; @enderror">Correo Electronico</label>
                                    <div class="input-group mar-btm">
                                        <label class="input-group-addon" for="emailAdmin"><i class="fa-solid fa-envelope"></i></label>
                                        <input type="emailAdmin" class="form-control" id="emailAdmin" value="{{ old('emailAdmin') }}" wire:model.live='emailAdmin' placeholder="Ingrese el correo electronico" required>
                                    </div>
                                    @error('emailAdmin')
                                        <div class="alert-error animated shake">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Contrasena -->
                            <div class="col-sm-6">
                                <div class="form-group" style="margin-top:0">
                                    <label class="control-label color-paragraph label-form" for="passwordAdmin"
                                        style="@error('passwordAdmin') color:#e90326; @enderror">Contraseña</label>
                                    <div class="input-group mar-btm">
                                        <label class="input-group-addon" for="passwordAdmin"><i class="fa-solid fa-lock"></i></label>
                                        <input type="password" class="form-control" id="passwordAdmin" value="{{ old('passwordAdmin') }}" wire:model.live='passwordAdmin' placeholder="Ingrese la contraseña" autocomplete="off" required>
                                    </div>
                                    @error('passwordAdmin')
                                        <div class="alert-error animated shake">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- Repetir Contrasena --}}
                            <div class="col-sm-6">
                                <div class="form-group" style="margin-top:0">
                                    <label class="control-label color-paragraph label-form" for="passwordConfirmationAdmin"
                                        style="@error('passwordConfirmationAdmin') color:#e90326; @enderror">Repetir Contraseña</label>
                                    <div class="input-group mar-btm">
                                        <label class="input-group-addon" for="passwordConfirmationAdmin"><i class="fa-solid fa-lock"></i></label>
                                        <input type="password" class="form-control" id="passwordConfirmationAdmin" value="{{ old('passwordConfirmationAdmin') }}" wire:model.live='passwordConfirmationAdmin' placeholder="Repita la contraseña" autocomplete="off" required>
                                    </div>
                                    @error('passwordConfirmationAdmin')
                                        <div class="alert-error animated shake">{{ $message }}</div>
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
                </form>

                <!--===================================================-->
                <!--End Icons Addons-->
            </div>

            <!-- Modal para Senseis -->
            <div x-show="openTab2" class="panel-custom" style="border-radius: 0 0 10px 10px;border-top: none;padding-top:20px" x-transition.duration.100ms> 
                
                <div class="modern-container-header" style="margin:0;">
                    <div class="modern-header">
                        <span class="text-center color-title">{{ __('Nuevo Sensei') }}</span>
                    </div>
                </div>

                <!--Icons Addons-->
                <!--===================================================-->
                <form wire:submit='saveSensei' wire:key="sensei-form">
                    <div class="panel-body" style="padding-top: 0">
                        <div class="row">
                            <!-- Nombre del Admin -->
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

                            <!-- Email del Admin -->
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
                                <label class="control-label color-paragraph label-form" for="dojo_id" style="@error('$dojoIdSensei') color:#e90326; @enderror">Dojos Disponibles</label>
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
                                                            <div class="option-subtitle">{{ $selectedSubtitle }}</div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="option-content">
                                                        <div class="dojo-avatar">
                                                            <span class="fa-stack fa-2x">
                                                                <i class="fa-solid fa-vihara fa-stack-1x" style="color:black"></i>
                                                                <i class="fa-solid fa-ban fa-stack-2x" style="color:Tomato"></i>
                                                            </span>
                                                        </div>
                                                        <div class="option-text">
                                                            <div class="option-title">Sin Dojo</div>
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
                                                                            <i class="fa-solid fa-vihara fa-stack-1x" style="color:black"></i>
                                                                            <i class="fa-solid fa-ban fa-stack-2x" style="color:Tomato"></i>
                                                                        </span>
                                                                    </div>
                                                                    <div class="option-text">
                                                                        <div class="option-title">No asignar Dojo</div>
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
                                                                    <i class="fa-solid fa-location-dot" style="color:#e05f5f"></i> <span class="option-subtitle">{{ $option['subtitle'] }}</span>
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
                                    <label class="control-label color-paragraph label-form" for="file-upload-save">Agrega
                                        una Imagen para el Sensei</label>
                                    <div class="modern-file-input-container"> {{-- Contenedor para el input de archivo --}}

                                        @if ($photoSensei)
                                            <div class="close-btn-image" wire:click="removePhotoSensei"><i
                                                    class="fa-solid fa-trash" style="font-size: 18px"></i></div>
                                            {{-- La previsualización de imagen --}}
                                            {{-- Asegúrate de tener un public property $photoSensei y usar Livewire\Features\SupportFileUploads\WithFileUploads --}}
                                            {{-- Y si guardas la imagen, ajusta la URL src --}}
                                            @if (is_a($photoSensei, \Livewire\Features\SupportFileUploads\TemporaryUploadedFile::class))
                                                <div class="modern-image-container">
                                                    <img id="image-preview" class="modern-image-preview"
                                                        src="{{ $photoSensei->temporaryUrl() }}" alt="Imagen seleccionada"
                                                        wire:click='viewImageSensei'>
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
                                        <label for="file-upload-save" class="file-label">
                                            <i class="fas fa-upload"></i>
                                            {{-- Muestra el nombre del archivo o un texto por defecto --}}
                                            <span
                                                class="file-name">{{ $photoSensei ? ($photoSensei instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile ? $photoSensei->getClientOriginalName() : basename($photoSensei)) : 'Subir Imagen...' }}</span>
                                        </label>

                                        {{-- El input de archivo real (oculto) --}}
                                        {{-- wire:model.live="photoSensei" es correcto para Livewire file uploads --}}
                                        {{-- wire:key='{{$photoSenseiKey}}' ayuda a Livewire a manejar el input file --}}
                                        <input type="file" id="file-upload-save" class="file-input"
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
                            <!-- Password Confirmation -->
                            <div class="col-sm-6">
                                <div class="form-group" style="margin-top:0">
                                    <label class="control-label color-paragraph label-form" for="passwordSensei"
                                        style="@error('passwordSensei') color:#e90326; @enderror">Contraseña</label>
                                    <div class="input-group mar-btm">
                                        <label class="input-group-addon" for="passwordSensei"><i class="fa-solid fa-lock"></i></label>
                                        <input type="password" class="form-control" id="passwordSensei" value="{{ old('passwordSensei') }}" wire:model.live='passwordSensei' placeholder="Ingrese la contraseña" autocomplete="off" required style="z-index:0">
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
                                        <input type="password" class="form-control" id="passwordConfirmationSensei" value="{{ old('passwordConfirmationSensei') }}" wire:model.live='passwordConfirmationSensei' placeholder="Repita la contraseña" autocomplete="off" required style="z-index:0">
                                    </div>
                                    @error('passwordConfirmationSensei')
                                        <div class="alert-error animated shake">{{ $message }}</div>
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
                </form>

                <!--===================================================-->
                <!--End Icons Addons-->
            </div>

            <!-- Modal para Estudiantes -->
            <div x-show="openTab3" class="panel-custom" style="border-radius: 0 0 10px 10px;border-top: none;padding-top:20px" x-transition.duration.100ms>
                
                <div class="modern-container-header" style="margin:0;">
                    <div class="modern-header">
                        <span class="text-center color-title">{{ __('Nuevo Estudiante') }}</span>
                    </div>
                </div>

                <!--Icons Addons-->
                <!--===================================================-->
                <form wire:submit='saveStudent' wire:key="student-form">
                    <div class="panel-body" style="padding-top: 0">
                        <div class="row">
                            <!-- Nombre del Estudiante -->
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

                            <!-- Email del Estudiante -->
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
                            <!-- Kyu -->
                            <div class="col-sm-6">
                                <div class="form-group" style="margin-top:0;z-index:2; position:relative">
                                    <label class="control-label color-paragraph label-form" for="dojo_id" style="@error('$selectedValueKyu') color:#e90326; @enderror">Kyu</label>
                                    <div class="custom-select-container" wire:ignore.self style="margin:0">
                                        <div class="custom-select active" x-data="{ isOpen: false }" @click="isOpen = !isOpen" x-cloak>
                                            <div class="selected-option">
                                                @if ($selectedValueKyu)
                                                    <div class="option-content">
                                                        <div class="dojo-avatar">
                                                            @if($selectedIconKyuColor == "white" || $selectedIconKyuColor == "yellow")
                                                                <span style="background: black; padding:2px; border-radius:10px"><i class="fa-solid fa-ribbon" style="color:{{ $selectedIconKyuColor }};font-size:20px"></i></span>
                                                            @else
                                                                <i class="fa-solid fa-ribbon" style="color:{{ $selectedIconKyuColor }};font-size:20px"></i>
                                                            @endif
                                                        </div>
                                                        <div class="option-text">
                                                            <div class="option-title">{{ $selectedValueKyu }}</div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <span>Selecciona un Kyu</span>
                                                @endif
                                                <i class="fa-solid fa-angle-down"></i>
                                            </div>
                    
                                            <div class="custom-options" x-show="isOpen" x-transition @click.away="isOpen = false" x-cloak style="">
                                                @foreach ($optionsKyu as $index => $option)
                                                    <div class="option {{ $selectedValueKyu == $option['value'] ? 'selected' : '' }}"
                                                        wire:click="selectOptionKyu({{ $index }})">
                                                        <div class="option-content">
                                                            <div class="dojo-avatar">
                                                                @if($option['color'] == "white" || $option['color'] == "yellow")
                                                                    <span style="background: black; padding:2px; border-radius:10px"><i class="fa-solid fa-ribbon" style="color:{{ $option['color'] }};font-size:20px"></i></span>
                                                                @else
                                                                    <i class="fa-solid fa-ribbon" style="color:{{ $option['color'] }};font-size:20px"></i>
                                                                @endif
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
                                        <select class="hidden-select" wire:model="selectedValueKyu" required>
                                            <option value="" disabled selected>Selecciona un dojo</option>
                                            @foreach ($optionsKyu as $option)
                                                <option value="{{ $option['value'] }}"></option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('selectedValueKyu')
                                    <div class="alert-error animated shake">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- Date Of Birth  --}}
                            <div class="col-sm-6">
                                <div class="form-group" style="margin-top:0">
                                    <label class="control-label color-paragraph label-form" for="display-date-2"
                                        style="@error('dateOfBirthStudent') color:#e90326; @enderror">Fecha de Nacimiento</label>
                                    
                                    <div class="input-group mar-btm custom-datepicker">
                                        <label class="input-group-addon" for="display-date-2"><i class="fa-solid fa-calendar"></i></label>
                                        <input type="text" class="date-input" id="display-date-2" placeholder="Selecciona tu fecha de nacimiento" readonly>
                                        <!-- Input oculto para el valor SQL -->
                                        <input type="hidden" id="sql-date-2" name="birthdate" wire:model.live='dateOfBirthStudent' value="{{ old('dateOfBirthStudent') }}">
                                        
                                        <div class="calendar-container" id="calendar-2">
                                            <div class="calendar-header">
                                                <div class="month-year">
                                                    <select id="month-select-2" style="max-height: 100px !important"></select>
                                                    <select id="year-select-2"></select>
                                                </div>
                                                <div class="nav-buttons">
                                                    <button type="button" class="nav-button" id="prev-month-2">‹</button>
                                                    <button type="button" class="nav-button" id="next-month-2">›</button>
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
                                            
                                            <div class="days-grid" id="days-grid-2"></div>
                                            
                                            <div class="calendar-footer">
                                                <button type="button" class="today-button" id="today-btn-2">Hoy</button>
                                                <button type="button" class="clear-button" id="clear-btn-2">Limpiar</button>
                                            </div>
                                        </div>
                                    </div>
                                    @error('dateOfBirthStudent')
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
                            {{-- Select Estudiante --}}
                            <div class="col-sm-6">
                                <label class="control-label color-paragraph label-form" for="dojo_id_student" style="@error('dojoIdStudent') color:#e90326; @enderror">Selecciona El Sensei</label>
                                <div class="form-group" style="margin-top:0;z-index:1; position:relative">
                                    <div class="custom-select-container" wire:ignore.self style="margin:0">
                                        <div class="custom-select active" x-data="{ isOpen: false }" @click="isOpen = !isOpen" x-cloak id="dojo_id_student">
                                            <div class="selected-option">
                                                @if ($dojoIdStudent)
                                                    <div class="option-content">
                                                        <div class="dojo-avatar">
                                                            @if($selectedPhotoStudent)
                                                                <img class="dojo-image" src="{{ asset('storage/'.$selectedPhotoStudent) }}">
                                                            @else
                                                                <img class="dojo-image" src="{{ asset('image/dojo-default.jpg') }}">
                                                            @endif                                 
                                                        </div>
                                                        <div class="option-text">
                                                            <div class="option-title">{{ $selectedLabelStudent }}</div>
                                                            <div class="option-subtitle">{{ $selectedSubtitleStudent }}</div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="option-content">
                                                        <div class="dojo-avatar">
                                                            <span class="fa-stack fa-2x">
                                                                <i class="fa-solid fa-user-ninja fa-stack-1x" style="color:black"></i>
                                                                <i class="fa-solid fa-ban fa-stack-2x" style="color:Tomato"></i>
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
                                                @if ($optionStudent)
                                                    <!-- Dejar sin Sensei el Dojo -->
                                                    @if($dojoIdStudent) 
                                                        <div class="option" wire:click="selectOptionStudent('inactivo')">
                                                            <div class="option-content">
                                                                <div class="option-content">
                                                                    <div class="dojo-avatar">
                                                                        <span class="fa-stack fa-2x">
                                                                            <i class="fa-solid fa-user-ninja fa-stack-1x" style="color:black"></i>
                                                                            <i class="fa-solid fa-ban fa-stack-2x" style="color:Tomato"></i>
                                                                        </span>
                                                                    </div>
                                                                    <div class="option-text">
                                                                        <div class="option-title">No asignar Sensei</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <!-- Opciones de Senseis -->
                                                    @foreach ($optionStudent as $index => $option)
                                                        <div class="option {{ $dojoIdStudent == $option['value'] ? 'selected' : '' }}"
                                                            wire:click="selectOptionStudent({{ $index }})">
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
                                                                    <span class="option-subtitle">Dojo: {{ $option['subtitle'] }}</span>
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
                                                                    <div class="option-title">No hay Senseis Disponibles</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
        
                                        </div>
                                    </div>
                                </div>
                                @error('dojoIdStudent')
                                    <div class="alert-error animated shake">{{ $message }}</div>
                                @enderror                                                           
                            </div>
                        </div>

                        {{-- Photo Student --}}
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group" style="margin-top:0">
                                    <label class="control-label color-paragraph label-form" for="file-upload">Agrega
                                        una Imagen para el Estudiante</label>
                                    <div class="modern-file-input-container"> {{-- Contenedor para el input de archivo --}}

                                        @if ($photoStudent)
                                            <div class="close-btn-image" wire:click="removePhotoStudent"><i
                                                    class="fa-solid fa-trash" style="font-size: 18px"></i></div>
                                            {{-- La previsualización de imagen --}}
                                            {{-- Asegúrate de tener un public property $photoStudent y usar Livewire\Features\SupportFileUploads\WithFileUploads --}}
                                            {{-- Y si guardas la imagen, ajusta la URL src --}}
                                            @if (is_a($photoStudent, \Livewire\Features\SupportFileUploads\TemporaryUploadedFile::class))
                                                <div class="modern-image-container">
                                                    <img id="image-preview" class="modern-image-preview"
                                                        src="{{ $photoStudent->temporaryUrl() }}" alt="Imagen seleccionada"
                                                        wire:click='viewImageStudent'>
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
                                    @error('photoStudent')
                                        <div class="alert-error animated shake">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
 
                        <div class="row">
                            <!-- Password -->
                            <div class="col-sm-6">
                                <div class="form-group" style="margin-top:0">
                                    <label class="control-label color-paragraph label-form" for="passwordStudent"
                                        style="@error('passwordStudent') color:#e90326; @enderror">Contraseña</label>
                                    <div class="input-group mar-btm">
                                        <label class="input-group-addon" for="passwordStudent"><i class="fa-solid fa-lock"></i></label>
                                        <input type="password" class="form-control" id="passwordStudent" value="{{ old('passwordStudent') }}" wire:model.live='passwordStudent' placeholder="Ingrese la contraseña" autocomplete="off" required style="z-index:0">
                                    </div>
                                    @error('passwordStudent')
                                        <div class="alert-error animated shake">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- Password Confirmation --}}
                            <div class="col-sm-6">
                                <div class="form-group" style="margin-top:0">
                                    <label class="control-label color-paragraph label-form" for="passwordConfirmationStudent"
                                        style="@error('passwordConfirmationStudent') color:#e90326; @enderror">Repetir Contraseña</label>
                                    <div class="input-group mar-btm">
                                        <label class="input-group-addon" for="passwordConfirmationStudent"><i class="fa-solid fa-lock"></i></label>
                                        <input type="password" class="form-control" id="passwordConfirmationStudent" value="{{ old('passwordConfirmationStudent') }}" wire:model.live='passwordConfirmationStudent' placeholder="Repita la contraseña" autocomplete="off" required style="z-index:0">
                                    </div>
                                    @error('passwordConfirmationStudent')
                                        <div class="alert-error animated shake">{{ $message }}</div>
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
                </form>

                <!--===================================================-->
                <!--End Icons Addons-->
            </div>
        </div>


    </div>

    <!-- Buscador y Tabla -->
    <div class="panel-custom animated fadeIn" style=' margin: 20px 0;padding:10px'>

        <div class="modern-container-header" style="justify-content:space-around; flex-wrap:wrap; gap:15px">
            <div class="modern-header" style="margin-bottom:5px;">
                <span class="text-center color-title" style="font-size:25px">{{ __('Buscar Usuarios') }}</span>
                <span class="text-center color-paragraph" style="margin:0px;">{{ __('se muestran mas recientes a mas antiguos') }}</span>
            </div>
        </div>
        <!-- Búsqueda -->
        
        <div class="table-controls">
            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass" style="color:#002569"></i>
                <input wire:model.live="search" type="text" placeholder="Buscar dojos..." class="search-input" value="{{session('search') ?? ''}}">
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
            <table class="glass-table animated zoomIn" style="min-width:400px">
                <thead>
                    <tr>
                        <th wire:click="sortByModel('email')" class="sortable">
                            <span>Correo Electronico</span>
                            <span>
                                @if ($sortBy === 'email')
                                    <i class="fa-solid fa-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </span>
                        </th>
                        <th wire:click="sortByModel('role')" class="sortable">
                            <span>Tipo de Usuario</span>
                            <span>
                                @if ($sortBy === 'role')
                                    <i class="fa-solid fa-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </span>
                        </th>
                        <th wire:click="sortByModel('created_at')" class="sortable">
                            <span>Fecha de Creacion</span>
                            <span>
                                @if ($sortBy === 'created_at')
                                    <i class="fa-solid fa-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </span>
                        </th>
                        <th wire:click="sortByModel('updated_at')" class="sortable">
                            <span>Ultima Actualizacion</span>
                            <span>
                                @if ($sortBy === 'updated_at')
                                    <i class="fa-solid fa-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </span>
                        </th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr wire:key="user-{{ $user->id }}"
                            class="{{ $loop->odd ? 'odd-row' : 'even-row' }} hoverable-row">
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>{{ $user->updated_at }}</td>
                            <td>
                                <div class="dojo-actions-ultimate" style="margin: auto 0">
                                    <button class="edit-btn-ultimate edit-btn-ultimate-table" type="button" wire:click='sendSearchUser("{{ $user->email }}", "{{$user->role}}")'>
                                        <i class="fa-solid fa-eye"></i> Ver Más
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    {{-- Modal para Mostrar Fotos --}}
    @if ($photoModalSensei)
        <div wire:key="image-modal">
            <!-- Modal -->
            <div class="modal-overlay @if ($closeAnimation) animated zoomOut @endif"
                wire:click.self="closeViewImage" style="@if ($closeAnimation) background:none; @endif">
                <button class="close-btn-image" wire:click="closeViewImage">&times;</button>
                <div class="modal-container animated zoomIn"
                    style="display:flex; align-content:center; justify-content:center; max-width: 1100px">
                    
                        <img id="image-preview" class="modern-image-preview" src="{{ $photoSensei->temporaryUrl() }}"
                            alt="Imagen seleccionada" style="max-height: 650px;">
                    
                </div>
            </div>
        </div>
    @endif

    {{-- Modal para Mostrar Fotos --}}
    @if ($photoModalStudent)
        <div wire:key="image-modal">
            <!-- Modal -->
            <div class="modal-overlay @if ($closeAnimation) animated zoomOut @endif"
                wire:click.self="closeViewImageStudent" style="@if ($closeAnimation) background:none; @endif">
                <button class="close-btn-image" wire:click="closeViewImageStudent">&times;</button>
                <div class="modal-container animated zoomIn"
                    style="display:flex; align-content:center; justify-content:center; max-width: 1100px">
                    
                        <img id="image-preview" class="modern-image-preview" src="{{ $photoStudent->temporaryUrl() }}"
                            alt="Imagen seleccionada" style="max-height: 650px;">
                    
                </div>
            </div>
        </div>
    @endif

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


    {{ $users->links('vendor.livewire.bootstrap') }}
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                
                const displayDateInput = document.getElementById('display-date');
                const sqlDateInput = document.getElementById('sql-date');
                const calendar = document.getElementById('calendar');
                const daysGrid = document.getElementById('days-grid');
                const monthSelect = document.getElementById('month-select');
                const yearSelect = document.getElementById('year-select');
                const prevMonthBtn = document.getElementById('prev-month');
                const nextMonthBtn = document.getElementById('next-month');
                const todayBtn = document.getElementById('today-btn');
                const clearBtn = document.getElementById('clear-btn');
                
                let currentDate = new Date();
                let selectedDate = null;
                
                // Inicializar selects de mes y año
                function initSelects() {
                    // Meses
                    const months = [
                        'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                    ];
                    
                    monthSelect.innerHTML = '';
                    months.forEach((month, index) => {
                        const option = document.createElement('option');
                        option.value = index;
                        option.textContent = month;
                        if (selectedDate && index === selectedDate.getMonth()) {
                            option.selected = true;
                        } else if (!selectedDate && index === currentDate.getMonth()) {
                            option.selected = true;
                        }
                        monthSelect.appendChild(option);
                    });
                    
                    // Años (100 años hacia atrás y 10 hacia adelante)
                    yearSelect.innerHTML = '';
                    const currentYear = new Date().getFullYear();
                    for (let i = currentYear - 120; i <= currentYear; i++) {
                        const option = document.createElement('option');
                        option.value = i;
                        option.textContent = i;
                        if (selectedDate && i === selectedDate.getFullYear()) {
                            option.selected = true;
                        } else if (!selectedDate && i === currentDate.getFullYear()) {
                            option.selected = true;
                        }
                        yearSelect.appendChild(option);
                    }
                }
                
                // Mostrar/ocultar calendario
                displayDateInput.addEventListener('click', function() {
                    calendar.style.display = calendar.style.display === 'block' ? 'none' : 'block';
                    if (calendar.style.display === 'block') {
                        if (selectedDate) {
                            currentDate = new Date(selectedDate);
                        }
                        initSelects(); // Reforzar la inicialización
                        renderCalendar();
                    }
                });
                
                // Cambiar mes/año desde selects
                monthSelect.addEventListener('change', function() {
                    currentDate.setMonth(parseInt(this.value));
                    renderCalendar();
                });
                
                yearSelect.addEventListener('change', function() {
                    currentDate.setFullYear(parseInt(this.value));
                    renderCalendar();
                });
                
                // Navegación entre meses
                prevMonthBtn.addEventListener('click', function() {
                    currentDate.setMonth(currentDate.getMonth() - 1);
                    updateSelectsFromCurrentDate();
                    renderCalendar();
                });
                
                nextMonthBtn.addEventListener('click', function() {
                    currentDate.setMonth(currentDate.getMonth() + 1);
                    updateSelectsFromCurrentDate();
                    renderCalendar();
                });
                
                // Botón "Hoy"
                todayBtn.addEventListener('click', function() {
                    currentDate = new Date();
                    selectedDate = new Date();
                    updateSelectsFromCurrentDate();
                    updateInputsFromSelectedDate(true);
                    renderCalendar();
                    calendar.style.display = 'none';
                });
                
                window.addEventListener('dateOfBirthSensei', function () {
                    selectedDate = null;
                    displayDateInput.value = '';
                    sqlDateInput.value = '';
                    triggerLivewireUpdate();
                    calendar.style.display = 'none';
                    console.log('date');
                });

                // Botón "Limpiar"
                clearBtn.addEventListener('click', function() {
                    selectedDate = null;
                    displayDateInput.value = '';
                    sqlDateInput.value = '';
                    triggerLivewireUpdate();
                    calendar.style.display = 'none';
                });
                
                // Actualizar selects con la fecha actual
                function updateSelectsFromCurrentDate() {
                    if (currentDate) {
                        monthSelect.value = currentDate.getMonth();
                        yearSelect.value = currentDate.getFullYear();
                    }
                }
                
                // Actualizar inputs con la fecha seleccionada
                function updateInputsFromSelectedDate(forceUpdate = false) {
                    if (!selectedDate) return;
                    
                    // Actualizar currentDate para que coincida con la selección
                    currentDate = new Date(selectedDate);
                    updateSelectsFromCurrentDate();
                    
                    // Formato legible para mostrar
                    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                    displayDateInput.value = selectedDate.toLocaleDateString('es-ES', options);
                    
                    // Formato SQL (YYYY-MM-DD) para la base de datos
                    const year = selectedDate.getFullYear();
                    const month = String(selectedDate.getMonth() + 1).padStart(2, '0');
                    const day = String(selectedDate.getDate()).padStart(2, '0');
                    sqlDateInput.value = `${year}-${month}-${day}`;
                    
                    if (forceUpdate) {
                        triggerLivewireUpdate();
                    }
                }
                
                // Función optimizada para actualizar Livewire
                function triggerLivewireUpdate() {
                    setTimeout(() => {
                        sqlDateInput.dispatchEvent(new Event('input', { bubbles: true }));
                    }, 100);
                }
                
                // Renderizar calendario
                function renderCalendar() {
                    const year = currentDate.getFullYear();
                    const month = currentDate.getMonth();
                    
                    const firstDay = new Date(year, month, 1);
                    const lastDay = new Date(year, month + 1, 0);
                    const daysInMonth = lastDay.getDate();
                    const startingDay = firstDay.getDay() === 0 ? 6 : firstDay.getDay() - 1; // Lunes primero
                    
                    daysGrid.innerHTML = '';
                    
                    // Días del mes anterior
                    const prevMonthLastDay = new Date(year, month, 0).getDate();
                    for (let i = 0; i < startingDay; i++) {
                        const day = document.createElement('div');
                        day.className = 'day other-month';
                        day.textContent = prevMonthLastDay - startingDay + i + 1;
                        daysGrid.appendChild(day);
                    }
                    
                    // Días del mes actual
                    const today = new Date();
                    for (let i = 1; i <= daysInMonth; i++) {
                        const day = document.createElement('div');
                        const date = new Date(year, month, i);
                        
                        day.className = 'day';
                        day.textContent = i;
                        
                        // Comprobar si es hoy (solo estilo visual)
                        if (date.toDateString() === today.toDateString()) {
                            day.classList.add('today');
                        }
                        
                        // Comprobar si está seleccionado
                        if (selectedDate && date.toDateString() === selectedDate.toDateString()) {
                            day.classList.add('selected');
                        } else {
                            day.classList.remove('selected');
                        }
                        
                        day.addEventListener('click', function() {
                            selectedDate = date;
                            updateInputsFromSelectedDate();
                            triggerLivewireUpdate();
                            setTimeout(() => {
                                calendar.style.display = 'none';
                            }, 200);
                        });
                        
                        daysGrid.appendChild(day);
                    }
                    
                    // Días del próximo mes
                    const totalCells = 34; // 6 semanas
                    const remainingDays = totalCells - (startingDay + daysInMonth);
                    for (let i = 1; i <= remainingDays; i++) {
                        const day = document.createElement('div');
                        day.className = 'day other-month';
                        day.textContent = i;
                        daysGrid.appendChild(day);
                    }
                }
                
                // Cerrar calendario al hacer clic fuera
                document.addEventListener('click', function(e) {
                    if (!e.target.closest('.custom-datepicker')) {
                        calendar.style.display = 'none';
                    }
                });
                
                // Inicializar con posible valor existente
                if (sqlDateInput.value) {
                    const [year, month, day] = sqlDateInput.value.split('-');
                    selectedDate = new Date(year, month - 1, day);
                    currentDate = new Date(selectedDate);
                }
                
                // Inicializar
                initSelects();
                updateInputsFromSelectedDate();
                renderCalendar();
            });
        </script>

        <script>
            
            document.addEventListener('DOMContentLoaded', function() {
                
                const displayDateInput = document.getElementById('display-date-2');
                const sqlDateInput = document.getElementById('sql-date-2');
                const calendar = document.getElementById('calendar-2');
                const daysGrid = document.getElementById('days-grid-2');
                const monthSelect = document.getElementById('month-select-2');
                const yearSelect = document.getElementById('year-select-2');
                const prevMonthBtn = document.getElementById('prev-month-2');
                const nextMonthBtn = document.getElementById('next-month-2');
                const todayBtn = document.getElementById('today-btn-2');
                const clearBtn = document.getElementById('clear-btn-2');
                
                let currentDate = new Date();
                let selectedDate = null;
                
                // Inicializar selects de mes y año
                function initSelects() {
                    // Meses
                    const months = [
                        'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                    ];
                    
                    monthSelect.innerHTML = '';
                    months.forEach((month, index) => {
                        const option = document.createElement('option');
                        option.value = index;
                        option.textContent = month;
                        if (selectedDate && index === selectedDate.getMonth()) {
                            option.selected = true;
                        } else if (!selectedDate && index === currentDate.getMonth()) {
                            option.selected = true;
                        }
                        monthSelect.appendChild(option);
                    });
                    
                    // Años (100 años hacia atrás y 10 hacia adelante)
                    yearSelect.innerHTML = '';
                    const currentYear = new Date().getFullYear();
                    for (let i = currentYear - 120; i <= currentYear; i++) {
                        const option = document.createElement('option');
                        option.value = i;
                        option.textContent = i;
                        if (selectedDate && i === selectedDate.getFullYear()) {
                            option.selected = true;
                        } else if (!selectedDate && i === currentDate.getFullYear()) {
                            option.selected = true;
                        }
                        yearSelect.appendChild(option);
                    }
                }
                
                // Mostrar/ocultar calendario
                displayDateInput.addEventListener('click', function() {
                    calendar.style.display = calendar.style.display === 'block' ? 'none' : 'block';
                    if (calendar.style.display === 'block') {
                        if (selectedDate) {
                            currentDate = new Date(selectedDate);
                        }
                        initSelects(); // Reforzar la inicialización
                        renderCalendar();
                    }
                });
                
                // Cambiar mes/año desde selects
                monthSelect.addEventListener('change', function() {
                    currentDate.setMonth(parseInt(this.value));
                    renderCalendar();
                });
                
                yearSelect.addEventListener('change', function() {
                    currentDate.setFullYear(parseInt(this.value));
                    renderCalendar();
                });
                
                // Navegación entre meses
                prevMonthBtn.addEventListener('click', function() {
                    currentDate.setMonth(currentDate.getMonth() - 1);
                    updateSelectsFromCurrentDate();
                    renderCalendar();
                });
                
                nextMonthBtn.addEventListener('click', function() {
                    currentDate.setMonth(currentDate.getMonth() + 1);
                    updateSelectsFromCurrentDate();
                    renderCalendar();
                });
                
                // Botón "Hoy"
                todayBtn.addEventListener('click', function() {
                    currentDate = new Date();
                    selectedDate = new Date();
                    updateSelectsFromCurrentDate();
                    updateInputsFromSelectedDate(true);
                    renderCalendar();
                    calendar.style.display = 'none';
                });
                
                window.addEventListener('dateOfBirthStudent', function () {
                    selectedDate = null;
                    displayDateInput.value = '';
                    sqlDateInput.value = '';
                    triggerLivewireUpdate();
                    calendar.style.display = 'none';
                    console.log('date');
                });

                // Botón "Limpiar"
                clearBtn.addEventListener('click', function() {
                    selectedDate = null;
                    displayDateInput.value = '';
                    sqlDateInput.value = '';
                    triggerLivewireUpdate();
                    calendar.style.display = 'none';
                });
                
                // Actualizar selects con la fecha actual
                function updateSelectsFromCurrentDate() {
                    if (currentDate) {
                        monthSelect.value = currentDate.getMonth();
                        yearSelect.value = currentDate.getFullYear();
                    }
                }
                
                // Actualizar inputs con la fecha seleccionada
                function updateInputsFromSelectedDate(forceUpdate = false) {
                    if (!selectedDate) return;
                    
                    // Actualizar currentDate para que coincida con la selección
                    currentDate = new Date(selectedDate);
                    updateSelectsFromCurrentDate();
                    
                    // Formato legible para mostrar
                    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                    displayDateInput.value = selectedDate.toLocaleDateString('es-ES', options);
                    
                    // Formato SQL (YYYY-MM-DD) para la base de datos
                    const year = selectedDate.getFullYear();
                    const month = String(selectedDate.getMonth() + 1).padStart(2, '0');
                    const day = String(selectedDate.getDate()).padStart(2, '0');
                    sqlDateInput.value = `${year}-${month}-${day}`;
                    
                    if (forceUpdate) {
                        triggerLivewireUpdate();
                    }
                }
                
                // Función optimizada para actualizar Livewire
                function triggerLivewireUpdate() {
                    setTimeout(() => {
                        sqlDateInput.dispatchEvent(new Event('input', { bubbles: true }));
                    }, 100);
                }
                
                // Renderizar calendario
                function renderCalendar() {
                    const year = currentDate.getFullYear();
                    const month = currentDate.getMonth();
                    
                    const firstDay = new Date(year, month, 1);
                    const lastDay = new Date(year, month + 1, 0);
                    const daysInMonth = lastDay.getDate();
                    const startingDay = firstDay.getDay() === 0 ? 6 : firstDay.getDay() - 1; // Lunes primero
                    
                    daysGrid.innerHTML = '';
                    
                    // Días del mes anterior
                    const prevMonthLastDay = new Date(year, month, 0).getDate();
                    for (let i = 0; i < startingDay; i++) {
                        const day = document.createElement('div');
                        day.className = 'day other-month';
                        day.textContent = prevMonthLastDay - startingDay + i + 1;
                        daysGrid.appendChild(day);
                    }
                    
                    // Días del mes actual
                    const today = new Date();
                    for (let i = 1; i <= daysInMonth; i++) {
                        const day = document.createElement('div');
                        const date = new Date(year, month, i);
                        
                        day.className = 'day';
                        day.textContent = i;
                        
                        // Comprobar si es hoy (solo estilo visual)
                        if (date.toDateString() === today.toDateString()) {
                            day.classList.add('today');
                        }
                        
                        // Comprobar si está seleccionado
                        if (selectedDate && date.toDateString() === selectedDate.toDateString()) {
                            day.classList.add('selected');
                        } else {
                            day.classList.remove('selected');
                        }
                        
                        day.addEventListener('click', function() {
                            selectedDate = date;
                            updateInputsFromSelectedDate();
                            triggerLivewireUpdate();
                            setTimeout(() => {
                                calendar.style.display = 'none';
                            }, 200);
                        });
                        
                        daysGrid.appendChild(day);
                    }
                    
                    // Días del próximo mes
                    const totalCells = 34; // 6 semanas
                    const remainingDays = totalCells - (startingDay + daysInMonth);
                    for (let i = 1; i <= remainingDays; i++) {
                        const day = document.createElement('div');
                        day.className = 'day other-month';
                        day.textContent = i;
                        daysGrid.appendChild(day);
                    }
                }
                
                // Cerrar calendario al hacer clic fuera
                document.addEventListener('click', function(e) {
                    if (!e.target.closest('.custom-datepicker')) {
                        calendar.style.display = 'none';
                    }
                });
                
                // Inicializar con posible valor existente
                if (sqlDateInput.value) {
                    const [year, month, day] = sqlDateInput.value.split('-');
                    selectedDate = new Date(year, month - 1, day);
                    currentDate = new Date(selectedDate);
                }
                
                // Inicializar
                initSelects();
                updateInputsFromSelectedDate();
                renderCalendar();
            });
        </script>
    @endpush

</div>
