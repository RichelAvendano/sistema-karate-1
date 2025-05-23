<div x-data="{open: false}" x-cloak>
    @push('styles')
        <style>
            a:hover{
                color: white;
            }
        </style>
    @endpush
    <!-- Modal para editar -->
    @if ($modal)
        <div wire:key="edit-modal">
            <!-- Modal -->
            <div class="modal-overlay @if ($closeAnimation) animated zoomOut @endif"
                wire:click.self="closeEditAnimation"
                style="@if ($closeAnimation) background:none; @endif">
                <div class="modal-container animated fadeInDown">
                    <div class="close-btn-image" wire:click="closeEditAnimation">&times;</div>
                    <div class="modern-container-header">
                        <div class="modern-header">
                            <span class="text-center color-title">{{ __('Editar Dojo') }}</span>
                            <span class="text-center color-paragraph"
                                style="margin:0px;">{{ __('Edita los dojos existentes') }}</span>
                        </div>
                    </div>

                    <form wire:submit='editSave({{ $id_selected }})' wire:key="dojo-form-edit">
                        <div class="panel-body">
                            <div class="row">
                                <!-- Nombre del Dojo -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label color-paragraph label-form" for="nameEdit"
                                            style="@error('nameEdit') color:#e90326; @enderror">Nombre del Dojo</label>
                                        <div class="input-group mar-btm">
                                            <span class="input-group-addon"><i class="fa-solid fa-user"></i></span>
                                            <input type="text" class="form-control" id="nameEdit"
                                                wire:model.live='nameEdit' placeholder="Ingrese el nombre"
                                                autocomplete="off">
                                        </div>
                                        @error('nameEdit')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Ubicación del Dojo -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label color-paragraph label-form" for="locationEdit"
                                            style="@error('locationEdit') color:#e90326; @enderror">Ubicación del
                                            Dojo</label>
                                        <div class="input-group mar-btm">
                                            <span class="input-group-addon"><i
                                                    class="fa-solid fa-location-dot"></i></span>
                                            <input type="text" class="form-control" id="locationEdit"
                                                wire:model.live='locationEdit' placeholder="Ingrese la ubicación"
                                                autocomplete="off">
                                        </div>
                                        @error('locationEdit')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Descripción -->
                                <div class="col-sm-6">
                                    <div class="form-group" style="margin-top:0">
                                        <label class="control-label color-paragraph label-form" for="descriptionEdit"
                                            style="@error('descriptionEdit') color:#e90326; @enderror">Breve
                                            Descripción</label>
                                        <div class="input-group mar-btm">
                                            <span class="input-group-addon"><i
                                                    class="fa-solid fa-pen-to-square"></i></span>
                                            <textarea class="form-control" id="descriptionEdit" wire:model.live='descriptionEdit'
                                                placeholder="Ingrese una breve descripción" style="height: 120px; overflow-y: auto; resize: none;"></textarea>
                                        </div>
                                        @error('descriptionEdit')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!--Photo -->
                                <div class="col-sm-6">
                                    <div class="form-group" style="margin-top:0">
                                        <label class="control-label color-paragraph label-form"
                                            for="file-upload">Agrega una Imagen</label>
                                        <div class="modern-file-input-container"> {{-- Contenedor para el input de archivo --}}

                                            @if ($photo)
                                                <div class="close-btn-image" 
                                                    wire:click="removePhoto"><i class="fa-solid fa-trash"
                                                        style="font-size: 18px"></i></div>
                                                {{-- La previsualización de imagen --}}
                                                {{-- Asegúrate de tener un public property $photo y usar Livewire\Features\SupportFileUploads\WithFileUploads --}}
                                                {{-- Y si guardas la imagen, ajusta la URL src --}}
                                                @if (is_a($photo, \Livewire\Features\SupportFileUploads\TemporaryUploadedFile::class))
                                                    <div class="modern-image-container">
                                                        <img id="image-preview" class="modern-image-preview"
                                                            src="{{ $photo->temporaryUrl() }}"
                                                            alt="Imagen seleccionada" wire:click='viewImage'>
                                                        <div class="image-overlay-text">
                                                            Ver
                                                        </div>
                                                    </div>
                                                @else
                                                    {{-- Si $photo es la ruta de la imagen guardada --}}
                                                    <img id="image-preview" class="modern-image-preview"
                                                        src="{{ asset('storage/' . $photo) }}" alt="Imagen del dojo">
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
                                                    class="file-name">{{ $photo ? ($photo instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile ? $photo->getClientOriginalName() : basename($photo)) : 'Subir Imagen...' }}</span>
                                            </label>

                                            {{-- El input de archivo real (oculto) --}}
                                            {{-- wire:model.live="photo" es correcto para Livewire file uploads --}}
                                            {{-- wire:key='{{$photoKey}}' ayuda a Livewire a manejar el input file --}}
                                            <input type="file" id="file-upload" class="file-input"
                                                wire:model.live="photo" wire:key='{{ $photoKey }}'
                                                style="display:none" accept="image/*">
                                        </div>
                                        @error('photo')
                                            <div class="alert-error animated shake">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12" style="display: flex; justify-content: end; gap:10px; ">
                                    <a class="cancel-btn-ultimate" 
                                        wire:click="closeEditAnimation">
                                        <i class="fa-solid fa-xmark"></i>
                                        <span>Cancelar</span>
                                    </a>
                                    <a class="modern-btn-success" type="submit">
                                        <i class="fa-solid fa-check"></i>
                                        <span>Guardar</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- Titulo de la Pagina -->
    <div class="panel-custom animated zoomIn" style='padding-bottom: 10px; margin: 20px 0;'>
        <div class="modern-container-header" style="justify-content:space-beetween; flex-wrap:wrap; gap:15px">
            <div class="modern-header">
                <span class="text-center color-title">{{ __('Lista de Dojos Registrados') }}</span>
                <span class="text-center color-paragraph"
                    style="margin:0px;">{{ __('Aqui puedes crear, editar y eliminar dojos') }}</span>
            </div>
            <div class="modern-header">
                <button @click="open = !open" class="new-btn-ultimate new-btn-responsive" style="font-size:22px; height: 60px; margin: auto 0">
                    <i x-show="!open" class="fa-solid fa-plus" style="font-size:25px"></i>
                    <i x-show="open" class="fa-solid fa-xmark" style="font-size:25px"></i>
                    <span x-text="open ? 'Cerrar' : 'Nuevo Dojo'"></span>
                </button>
            </div>
            <div class="modern-header">
                <span class="text-center color-title">{{ __('Ver Como') }}</span>
                <div class="" style="display: flex;gap: 10px">
                    <button class="edit-btn-ultimate {{$cardDojos ? 'active' : ''}}" wire:click='showCardDojos'>
                        <i class="fa-solid fa-layer-group"></i>
                        <span style="font-weight:700">Cartas</span>
                    </button>
                    <button class="edit-btn-ultimate {{$tableDojos ? 'active' : ''}}" wire:click='showTableDojos'>
                        <i class="fa-solid fa-table"></i>
                        <span style="font-weight:700">Tabla</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Nuevo Dojo -->
    <div x-show="open" x-transition.duration.500ms>
        <div class="panel-custom">
            <div class="modern-container-header">
                <div class="modern-header">
                    <span class="text-center color-title">{{ __('Nuevo Dojo') }}</span>
                    <span class="text-center color-paragraph"
                        style="margin:0px;">{{ __('Agrega un Nuevo Dojo al sistema') }}</span>
                </div>
            </div>

            <!--Icons Addons-->
            <!--===================================================-->
            <form wire:submit='save' wire:key="dojo-form-save">
                <div class="panel-body" style="padding-top: 0">
                    <div class="row">
                        <!-- Nombre del Dojo -->
                        <div class="col-sm-6">
                            <div class="form-group">

                                <label class="control-label color-paragraph label-form" for="name"
                                    style="@error('name') color:#e90326; @enderror">Nombre del Dojo</label>
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
                                <label class="control-label color-paragraph label-form" for="location"
                                    style="@error('location') color:#e90326; @enderror">Ubicación del Dojo</label>
                                <div class="input-group mar-btm">
                                    <label class="input-group-addon" for="location"><i
                                            class="fa-solid fa-location-dot"></i></label>
                                    <input type="text" class="form-control" id="location" wire:model.live='location'
                                        placeholder="Ingrese la ubicación" autocomplete="off" required>
                                </div>
                                @error('location')
                                    <div class="alert-error animated shake">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Descripción -->
                        <div class="col-sm-6">
                            <div class="form-group" style="margin-top:0">
                                <label class="control-label color-paragraph label-form" for="description"
                                    style="@error('description') color:#e90326; @enderror">Breve Descripción</label>
                                <div class="input-group mar-btm">
                                    <label class="input-group-addon" for="description"><i
                                            class="fa-solid fa-pen-to-square"></i></label>
                                    <textarea class="form-control" id="description" wire:model.live='description'
                                        placeholder="Ingrese una breve descripción" style="height: 170px; overflow-y: auto; resize: none;" required></textarea>
                                </div>
                                @error('description')
                                    <div class="alert-error animated shake">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        {{-- foto --}}
                        <div class="col-sm-6">
                            <div class="form-group" style="margin-top:0">
                                <label class="control-label color-paragraph label-form" for="file-upload-save">Agrega
                                    una Imagen</label>
                                <div class="modern-file-input-container"> {{-- Contenedor para el input de archivo --}}

                                    @if ($photoSave)
                                        <div class="close-btn-image" wire:click="removePhotoSave"><i
                                                class="fa-solid fa-trash" style="font-size: 18px"></i></div>
                                        {{-- La previsualización de imagen --}}
                                        {{-- Asegúrate de tener un public property $photoSave y usar Livewire\Features\SupportFileUploads\WithFileUploads --}}
                                        {{-- Y si guardas la imagen, ajusta la URL src --}}
                                        @if (is_a($photoSave, \Livewire\Features\SupportFileUploads\TemporaryUploadedFile::class))
                                            <div class="modern-image-container">
                                                <img id="image-preview" class="modern-image-preview"
                                                    src="{{ $photoSave->temporaryUrl() }}" alt="Imagen seleccionada"
                                                    wire:click='viewImage'>
                                                <div class="image-overlay-text">
                                                    Ver
                                                </div>
                                            </div>
                                        @else
                                            {{-- Si $photoSave es la ruta de la imagen guardada --}}
                                            <img id="image-preview" class="modern-image-preview"
                                                src="{{ asset('storage/' . $photoSave) }}" alt="Imagen del dojo">
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
                                            class="file-name">{{ $photoSave ? ($photoSave instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile ? $photoSave->getClientOriginalName() : basename($photoSave)) : 'Subir Imagen...' }}</span>
                                    </label>

                                    {{-- El input de archivo real (oculto) --}}
                                    {{-- wire:model.live="photoSave" es correcto para Livewire file uploads --}}
                                    {{-- wire:key='{{$photoSaveKey}}' ayuda a Livewire a manejar el input file --}}
                                    <input type="file" id="file-upload-save" class="file-input"
                                        wire:model.live="photoSave" wire:key='{{ $photoKey }}'
                                        style="display:none" accept="image/*">

                                </div>
                                @error('photoSave')
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
    
    <!-- Buscador Y Cartas y Tables -->
    <div class="panel-custom animated zoomIn" style=' margin: 20px 0;padding-bottom: 10px;'>
        
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
    

        <!-- Card con los Dojos -->
        @if($cardDojos)
            
            <div class="grid-container animated zoomIn">
                @foreach ($dojos as $dojo)
                    <div class="dojo-card-ultimate @if ($changeTable) animated fadeIn @endif"
                        wire:key='register-{{ $dojo->id }}'>
                        <div class="dojo-image-container-ultimate">
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
                        <div class="dojo-content-ultimate" style="justify-content:center; align-items:center">
                                <h3 class="dojo-title-ultimate"><i class="fa-solid fa-vihara"></i>{{ $dojo->name }}</h3>
                                
                                <div class="dojo-location-ultimate" style="font-size:16px">
                                    <i class="fa-solid fa-location-dot"
                                        style='color:red; font-size:15px; margin-right: 5px'></i>
                                    <span>{{ $dojo->location }}</span>
                                </div>
                                <span style="color:black; font-size: 15px; font-weight: 600"><i class="fa-solid fa-user-ninja" style="color:black; margin: 10px"></i>Sensei: {{$dojo->sensei->name ?? 'no tiene asignado'}}</span>
                                <span class="" style="font-style: italic; font-size:15px; margin: 10px">{{ $dojo->description }}</span>

                            <div class="dojo-actions-ultimate">
                                <button class="edit-btn-ultimate" wire:click='edit({{ $dojo->id }})'>
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    <span>Editar</span>
                                </button>
                                <button class="delete-btn-ultimate" wire:click='destroyModal({{ $dojo->id }})'>
                                    <i class="fa-solid fa-trash"></i>
                                    <span>Eliminar</span>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
        @endif

        <!-- Table con los Dojos -->
        @if($tableDojos)
            <div class="table-container" style="margin:0 10px 10px 10px">
                <table class="glass-table animated zoomIn" style="min-width: 750px;">
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
                            <th>Sensei</th>
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
                                
                                @if($dojo->sensei)
                                    <td style="display:flex; gap: 10px; align-items:center">
                                        @if ($dojo->sensei->photo)
                                            <div class="dojo-photo">
                                                <img src="{{ asset('storage/' . $dojo->sensei->photo) }}" alt="{{ $dojo->sensei->name }}"
                                                    class="dojo-image">
                                            </div>
                                            <div>
                                                <span>{{$dojo->sensei->name ?? 'sin sensei'}}</span>
                                            </div>
                                        @else
                                            <div class="dojo-photo">
                                                <img src="{{ asset('image/sensei-default.jpg') }}" class="dojo-image"
                                                    alt="dojo-image">
                                            </div>
                                            <div>
                                                <span>{{$dojo->sensei->name ?? 'sin sensei'}}</span>
                                            </div>
                                        @endif
                                    </td>
                                @else
                                    <td>No tiene un Sensei Asignado</td>
                                @endif
                                <td class="description-cell">
                                    {{ Str::limit($dojo->description, 50) }}
                                </td>
                                <td>
                                    <div class="dojo-actions-ultimate">
                                        <button wire:click='edit({{ $dojo->id }})' class="edit-btn-ultimate edit-btn-ultimate-table">
                                            <i class="fa-solid fa-pen"></i> Editar
                                        </button>
                                        <button wire:click='destroyModal({{ $dojo->id }})' class="delete-btn-ultimate delete-btn-ultimate-table">
                                            <i class="fa-solid fa-trash"></i> Eliminar
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
        @endif
    
    </div>

    {{-- Modal para Mostrar Fotos --}}
    @if ($photoModal)
        <div wire:key="image-modal">
            <!-- Modal -->
            <div class="modal-overlay @if ($closeAnimation) animated zoomOut @endif"
                wire:click.self="closeViewImage" style="@if ($closeAnimation) background:none; @endif">
                <button class="close-btn-image" wire:click="closeViewImage">&times;</button>
                <div class="modal-container animated zoomIn"
                    style="display:flex; align-content:center; justify-content:center; max-width: 1100px">
                    @if ($photo)
                        <img id="image-preview" class="modern-image-preview" src="{{ $photo->temporaryUrl() }}"
                            alt="Imagen seleccionada" style="max-height: 650px;">
                    @else
                        <img id="image-preview" class="modern-image-preview" src="{{ $photoSave->temporaryUrl() }}"
                            alt="Imagen seleccionada" style="max-height: 650px;">
                    @endif
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

    @if ($destroyMessage)
        <div wire:key="destroy-modal"
            class="modal-overlay @if ($closeAnimation) animated zoomOut @endif"
            wire:click.self="closeDestroyModal" style="@if ($closeAnimation) background:none; @endif">
            <div class="modal-container animated fadeIn " @click.stop style="max-width:500px">
                <div class="close-btn-image" wire:click="closeDestroyModal">&times;</div>
                <div class="modern-container-header">
                    <div class="modern-header">
                        <i class="fa-solid fa-triangle-exclamation fa-beat"
                            style="font-size: 1.8rem; color: #ac2b2b; margin-bottom: 15px; font-size:50px; display:block"></i>
                        <span class="text-center color-title">{{ __('Eliminar Dojo') }}</span>
                    </div>
                </div>

                <div class="panel-body">
                    <h3 class=" text-center alert alert-danger" style="margin:15px 0;font-size:20px">
                        {{ $message }}</h3>
                    <div class="row" style="margin-top:20px">
                        <div class="col-sm-12" style="display: flex; justify-content: center; gap:10px;">
                            <a class="cancel-btn-ultimate" wire:click="closeDestroyModal">
                                <i style="font-size:17px" class="fa-solid fa-xmark"></i>
                                <span style="font-size:17px">Cancelar</span>
                            </a>
                            <a class="delete-btn-ultimate" type="submit"
                                wire:click='destroy({{ $id_selected }})'>
                                <i class="fa-solid fa-trash" style="font-size:17px"></i>
                                <span style="font-size:17px">Eliminar</span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endif

    

    {{ $dojos->links('vendor.livewire.bootstrap') }}
    @push('scripts')
        {{-- Este script solo se incluirá en esta vista, dentro del @stack('scripts') en el layout --}}
        <script>
            document.addEventListener('refreshForm', function() {
                document.querySelectorAll('.form-control').forEach(input => input.value = '');
            });
        </script>
    @endpush
</div>
