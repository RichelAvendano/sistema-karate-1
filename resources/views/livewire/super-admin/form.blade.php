<div>
    @push('styles')
    @endpush

    <div class="modern-container-header modern-container-header-responsive" style='justify-content:space-between;flex-wrap:wrap;margin-top:0px; margin-bottom:10px'>
        <div class="modern-header" style="padding:3px;">
            <span class="text-center color-title">{{ __('Dojos') }}</span>
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <!--End page title-->


            <!--Breadcrumb-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <ol class="breadcrumb">
                <li style='font-size:20px'>
                    <a href="{{ route('dashboard') }}">
                        <i class="fa-solid fa-home"></i>
                    </a>
                </li>
                <li class="active" style='font-size:17px'>Dojo</li>
            </ol>
        </div>
    </div>

    <!-- Titulo y Modal para Crear Usuario -->
    <div x-data='{open: false, openTab1: true, openTab2: false}'>
        <div class="panel-custom animated zoomIn" style='padding-bottom: 10px; margin: 20px 0;'>
            <div class="modern-container-header" style="justify-content:space-around; flex-wrap:wrap; gap:15px">
                <div class="modern-header">
                    <span class="text-center color-title">{{ __('Panel de Administrador') }}</span>
                    <span class="text-center color-paragraph" style="margin:0px;">{{ __('Aqui ver los administradores y crear cualquier Usuario') }}</span>
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
        <div x-show="open" x-transition.duration.500ms>

            <div class="modern-container-header" style="justify-content: start;flex-wrap:wrap; gap: 0 3px">
                <button :class="openTab1 ? 'active' : ''" @click="openTab1 = !openTab1; openTab2 = false;" type="button" class="modern-header-tab" style="">
                    <span class="text-center color-title" style="color:white; font-size: 20px">{{ __('Administrador') }}</span>
                </button>
                <button :class="openTab2 ? 'active' : ''" @click="openTab2 = !openTab2; openTab1 = false;" type="button" class="modern-header-tab" style="">
                    <span class="text-center color-title" style="color:white; font-size: 20px">{{ __('Sensei') }}</span>
                </button>
                <button type="button" class="modern-header-tab" style="">
                    <span class="text-center color-title" style="color:white; font-size: 20px">{{ __('Estudiante') }}</span>
                </button>
            </div>
            
            <!-- Modal para Administradores -->
            <div x-show="openTab1" class="panel-custom animated fadeIn" style="border-radius: 0 0 10px 10px">
                
                <div class="modern-container-header">
                    <div class="modern-header">
                        <span class="text-center color-title">{{ __('Nuevo Administrador') }}</span>
                    </div>
                </div>

                <!--Icons Addons-->
                <!--===================================================-->
                <form wire:submit='saveAdmin' wire:key="dojo-form-save">
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
                                        <label class="input-group-addon" for="emailAdmin"><i class="fa-solid fa-user"></i></label>
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
                                        <label class="input-group-addon" for="passwordAdmin"><i class="fa-solid fa-user"></i></label>
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
                                        <label class="input-group-addon" for="passwordConfirmationAdmin"><i class="fa-solid fa-user"></i></label>
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
            <div x-show="openTab2" class="panel-custom animated fadeIn" style="border-radius: 0 0 10px 10px">
                
                <div class="modern-container-header">
                    <div class="modern-header">
                        <span class="text-center color-title">{{ __('Nuevo Sensei') }}</span>
                    </div>
                </div>

                <!--Icons Addons-->
                <!--===================================================-->
                <form wire:submit='saveAdmin' wire:key="dojo-form-save">
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
                                        <label class="input-group-addon" for="emailAdmin"><i class="fa-solid fa-user"></i></label>
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
                                        <label class="input-group-addon" for="passwordAdmin"><i class="fa-solid fa-user"></i></label>
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
                                        <label class="input-group-addon" for="passwordConfirmationAdmin"><i class="fa-solid fa-user"></i></label>
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

        </div>


    </div>

    <!-- Table -->
    <div class="table-container" wire:key="dojos-table">
        <!-- Búsqueda -->
        <div class="table-controls">
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
                                    <img class="dojo-image" src="{{ asset('image/dojo-default.jpg') }}">
                                </div>
                                <div class="option-text">
                                    <div class="option-title">{{ $selectedLabel }}</div>
                                    <div class="option-subtitle">{{ $selectedSubtitle }}</div>
                                </div>
                            </div>
                        @else
                            <span>Selecciona un dojo</span>
                        @endif
                        <i class="fa-solid fa-angle-down"></i>
                    </div>

                    <div class="custom-options" x-show="isOpen" x-transition @click.away="isOpen = false" x-cloak>
                        @foreach ($options as $index => $option)
                            <div class="option {{ $selectedValue == $option['value'] ? 'selected' : '' }}"
                                wire:click="selectOption({{ $index }})">
                                <div class="option-content">
                                    <div class="dojo-avatar">
                                        <img class="dojo-image" src="{{ asset('image/dojo-default.jpg') }}">
                                    </div>
                                    <div class="option-text">
                                        <div class="option-title">{{ $option['title'] }}</div>
                                        <div class="option-subtitle">{{ $option['subtitle'] }}</div>
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

        <!-- Tabla -->
        <div class="table-wrapper">
            <table class="glass-table">
                <thead>
                    <tr>
                        <th>
                            <span>Foto</span>
                        </th>
                        <th wire:click="sortByModel('name')" class="sortable">
                            <span>Nombre</span>
                            <span>
                                @if ($sortBy === 'name')
                                    <i class="fa-solid fa-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </span>
                        </th>
                        <th wire:click="sortByModel('location')" class="sortable">
                            <span>Ubicación</span>
                            <span>
                                @if ($sortBy === 'location')
                                    <i class="fa-solid fa-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </span>
                        </th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dojos as $dojo)
                        <tr wire:key="dojo-{{ $dojo->id }}"
                            class="{{ $loop->odd ? 'odd-row' : 'even-row' }} hoverable-row">
                            <td style="display: flex; justify-content:center;">
                                @if ($dojo->photo)
                                    <div class="dojo-photo">
                                        <img src="{{ asset('storage/' . $dojo->photo) }}" alt="{{ $dojo->name }}"
                                            class="dojo-image">
                                    </div>
                                @else
                                    <div class="dojo-photo">
                                        <img src="{{ asset('image/dojo-default.jpg') }}" class="dojo-image"
                                            alt="dojo-image">
                                    </div>
                                @endif
                            </td>
                            <td>{{ $dojo->name }}</td>
                            <td>{{ $dojo->location }}</td>
                            <td class="description-cell">
                                {{ Str::limit($dojo->description, 50) }}
                            </td>
                            <td>
                                <button wire:click="editDojo({{ $dojo->id }})" class="action-btn edit">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                <button wire:click="deleteDojo({{ $dojo->id }})" class="action-btn delete">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        {{ $dojos->links('vendor.livewire.bootstrap') }}
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

    @push('scripts')
    @endpush

</div>
