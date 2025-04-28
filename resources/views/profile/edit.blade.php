<x-app-layout>
    
    <div class="boxed">

        <!--CONTENT CONTAINER-->
        <!--===================================================-->
        <div id="content-container">
            <div id="page-head">
                
                <div class="pad-all text-center">
                    <h3 id="color-title-glass">Perfil de Usuario</h3>
                    <p1 id="color-title-glass">Actualice sus datos o borre la cuenta</p1>                   
                </div>
            </div>

            
            <!--Page content-->
            <!--===================================================-->
            <div id="page-content">
                
                {{-- <div class="panel">
                    <div class="panel-body">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="mb-4">
                                    <div class="card shadow rounded-lg">
                                        <div class="card-body p-4">
                                            <div class="max-w-xl">
                                                @include('profile.partials.update-profile-information-form')
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <div class="card shadow rounded-lg">
                                        <div class="card-body p-4">
                                            <div class="max-w-xl">
                                                @include('profile.partials.update-password-form')
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <div class="card shadow rounded-lg">
                                        <div class="card-body p-4">
                                            <div class="max-w-xl">
                                                @include('profile.partials.delete-user-form')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="panel">
                            <div class="panel-footer" style="border-bottom:1px solid rgb(248, 248, 248);">
                                <header class="mb-4" >
                                    <h4 class="card-title">{{ __('Información del Perfil') }}</h4>
                                    <p style="margin:0px">{{ __("Actualiza la información del perfil y la dirección de correo electrónico de tu cuenta.") }}</p>
                                </header>
                            </div>
                
                            <!--Icons Addons-->
                            <!--===================================================-->
                            <form class="form-horizontal">
                                <div class="panel-body" style="padding-top:0; padding-bottom:0px">
                                    <label class="control-label" for="name">Nombre</label>
                                    <div class="input-group mar-btm">
                                        <span class="input-group-addon"><i class="fa-solid fa-user"></i></span>
                                        <input type="text" class="form-control" placeholder="Nombre" id="name" name="name">
                                    </div>
                                    <label class="control-label" for="email">Correo Electronico</label>
                                    <div class="input-group mar-btm">
                                        <span class="input-group-addon"><i class="fa-solid fa-envelope"></i></span>
                                        <input type="email" class="form-control" placeholder="Correo Electronico" id="email" name="email">
                                    </div>
                                    <label class="control-label" for="role">Rol del Usuario</label>
                                    <div class="input-group mar-btm">
                                        <span class="input-group-addon"><i class="fa-solid fa-users"></i></span>
                                        <input type="text" class="form-control" placeholder="Rol" id="role" name="role">
                                    </div>
                                </div>
                                <div class="panel-footer text-left" style="">
                                    <button class="btn btn-primary" type="submit">Actualizar</button>
                                </div>
                            </form>
                            <!--===================================================-->
                            <!--End Icons Addons-->
                
                        </div>
                    </div>
                    @livewire('form-profile-edit')
                </div>
                    
            </div>
            <!--===================================================-->
            <!--End page content-->

        </div>
        <!--===================================================-->
        <!--END CONTENT CONTAINER-->
    </div>
    <script src="{{asset('plugins\bootbox\bootbox.min.js')}}"></script>
    <script src="{{asset('js\demo\ui-modals.js')}}"></script>
</x-app-layout>
