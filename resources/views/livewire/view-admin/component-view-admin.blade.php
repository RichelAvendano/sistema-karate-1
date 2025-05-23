<div>

    <!-- Buscador y Tabla -->
    <div x-data='{openEdit:false, openDestroy: false}' x-cloak>
        <div class="panel-custom animated fadeIn" style=' margin: 20px 0;padding:10px'>

            <div class="modern-container-header" style="justify-content:space-around; flex-wrap:wrap; gap:15px">
                <div class="modern-header" style="margin-bottom:5px;">
                    <span class="text-center color-title" style="font-size:25px">{{ __('Buscar Administradores') }}</span>
                    <span class="text-center color-paragraph" style="margin:0px;">{{ __('aqui puedes editar o eliminar administradores') }}</span>
                </div>
            </div>
            <!-- Búsqueda -->
            <div class="table-controls">
                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass" style="color:#002569"></i>
                    <input wire:model.live="search" type="text" placeholder="Buscar Administradores..." class="search-input">
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
            <div class="table-container">
                <table class="glass-table animated fadeIn @if ($changeTable) animated fadeIn @endif" style="min-width: 550px">
                    <thead>
                        <tr>
                            <th wire:click="sortByModel('name')" class="sortable">
                                <span>Nombre</span>
                                <span>
                                    @if ($sortBy === 'name')
                                        <i class="fa-solid fa-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </span>
                            </th>
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
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->updated_at }}</td>
                                <td>
                                    <div class="dojo-actions-ultimate">
                                        <button wire:click='editModal({{ $user->id }})' @click="openEdit = !openEdit" class="edit-btn-ultimate edit-btn-ultimate-table">
                                            <i class="fa-solid fa-pen"></i> Editar
                                        </button>
                                        <button wire:click='destroyModal({{ $user->id }})' @click="openDestroy = !openDestroy" class="delete-btn-ultimate delete-btn-ultimate-table">
                                            <i class="fa-solid fa-trash"></i> Eliminar
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>


        <!-- Modal Editar -->
        <div class="modal-overlay" x-show='openEdit' @click.self="openEdit = !openEdit" x-transition:leave.duration.500ms x-transition:enter.duration.500ms>
            <div class="modal-container " :class="openEdit ? 'animated fadeInDown' : 'animated zoomOut'">
                <button class="close-btn-image" @click="openEdit = !openEdit">&times;</button>
                <div class="modern-container-header">
                    <div class="modern-header">
                        <span class="text-center color-title">{{ __('Editar Administrador') }}</span>
                        <span class="text-center color-paragraph"
                            style="margin:0px;">{{ __('Edita los Administradores existentes') }}</span>
                    </div>
                </div>

                <form wire:submit='editAdmin({{ $id_selected }})' wire:key="admin-form-edit">
                    <div class="panel-body">
                        <div class="row">
                            <!-- Nombre del Admin -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label color-paragraph label-form" for="name"
                                        style="@error('name') color:#e90326; @enderror">Nombre del Dojo</label>
                                    <div class="input-group mar-btm">
                                        <span class="input-group-addon"><i class="fa-solid fa-user"></i></span>
                                        <input type="text" class="form-control" id="name"
                                            wire:model.live='name' placeholder="Ingrese el nombre"
                                            autocomplete="off">
                                    </div>
                                    @error('name')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email del Admin -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label color-paragraph label-form" for="email"
                                        style="@error('email') color:#e90326; @enderror">Correo Electronico</label>
                                    <div class="input-group mar-btm">
                                        <span class="input-group-addon"><i
                                                class="fa-solid fa-location-dot"></i></span>
                                        <input type="email" class="form-control" id="email"
                                            wire:model.live='email' placeholder="Ingrese el correo electronico"
                                            autocomplete="off">
                                    </div>
                                    @error('email')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Password -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label color-paragraph label-form" for="password"
                                        style="@error('password') color:#e90326; @enderror">Nueva Contraseña</label>
                                    <div class="input-group mar-btm">
                                        <span class="input-group-addon"><i
                                                class="fa-solid fa-location-dot"></i></span>
                                        <input type="password" class="form-control" id="password"
                                            wire:model.live='password' placeholder="Nueva Contraseña"
                                            autocomplete="off">
                                    </div>
                                    @error('password')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!--Password confirmation -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label color-paragraph label-form" for="password_confirmation"
                                        style="@error('password_confirmation') color:#e90326; @enderror">Repetir Contraseña</label>
                                    <div class="input-group mar-btm">
                                        <span class="input-group-addon"><i
                                                class="fa-solid fa-location-dot"></i></span>
                                        <input type="password" class="form-control" id="password_confirmation"
                                            wire:model.live='password_confirmation' placeholder="Repetir Contraseña"
                                            autocomplete="off">
                                    </div>
                                    @error('password_confirmation')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
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
                                <button class="modern-btn-success" type="submit" @click="openEdit = !openEdit">
                                    <i class="fa-solid fa-check"></i>
                                    <span>Guardar</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
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
                        <span class="text-center color-title">{{ __('Eliminar Administrador') }}</span>
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
                            <button class="delete-btn-ultimate" type="button" wire:click='destroy({{ $id_selected }})' @click="openDestroy = !openDestroy">
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
</div>
