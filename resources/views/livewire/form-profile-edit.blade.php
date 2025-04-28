<div>
    <div class="col-sm-6">
        <div class="panel">
            <div class="panel-footer" style="border-bottom:1px solid rgb(248, 248, 248);">
                <header class="mb-4" >
                    <h4 class="card-title">{{ __('Perfil con Livewire') }}</h4>
                    <p style="margin:0px">{{ __("Actualiza la información del perfil y la dirección de correo electrónico de tu cuenta.") }}</p>
                </header>
            </div>

            <!--Icons Addons-->
            <!--===================================================-->
            <form class="form-horizontal" wire:submit='save'>
                <div class="panel-body" style="padding-top:0; padding-bottom:0px">
                    <label class="control-label" for="name">Nombre</label>
                    <div class="input-group mar-btm">
                        <span class="input-group-addon"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control" placeholder="Nombre" id="name" name="name" wire:model.live='name' autocomplete="off">
                    </div>
                    <label class="control-label" for="email">Correo Electronico</label>
                    <div class="input-group mar-btm">
                        <span class="input-group-addon"><i class="fa-solid fa-envelope"></i></span>
                        <input type="email" class="form-control" placeholder="Correo Electronico" id="email" name="email" wire:model.live='email' autocomplete="off">
                    </div>
                    <label class="control-label" for="role">Rol del Usuario</label>
                    <div class="input-group mar-btm">
                        <span class="input-group-addon"><i class="fa-solid fa-users"></i></span>
                        <input type="text" class="form-control" placeholder="Rol" id="role" name="role" wire:model.live='role' autocomplete="off">
                    </div> 
                    @if (session()->has('message'))
                        <div 
                            wire:key='error-(1)' 
                            class="alert alert-success animated bounceIn" 
                            style="margin-top: 10px; margin-bottom: 0px">
                            {{ session('message') }}
                        </div>  
                    @endif
                </div>
                <div class="panel-footer text-left" style="">
                    <button class="btn btn-primary" type="submit">Actualizar</button>
                </div>
            </form>
            <!--===================================================-->
            <!--End Icons Addons-->

        </div>
    </div>
</div>
