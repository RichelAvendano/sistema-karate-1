<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>
    
    @error('current_password','userDeletion')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <button data-target="#demo-default-modal" data-toggle="modal" class="btn btn-danger btn-default">Borrar Cuenta</button>

    <div class="modal fade" id="demo-default-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <!--Modal header-->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                    <h2 class="modal-title text-danger">Borrar Cuenta</h2>
                </div>

                <form method="post" action="{{ route('profile.destroy') }}">
                    <!--Modal body-->
                    @csrf
                    @method('delete')
                    <div class="modal-body">
                        <h5 class="text-main">Introduzca su Contraseña Actual si quiere borrar su cuenta</h5>
                        <div class="mb-3">
                            <label for="update_password_current_password" class="form-label">{{ __('Contraseña Actual') }}</label>
                            <input id="update_password_current_password" name="current_password" type="password" class="form-control" autocomplete="current-password" required>
                            {{-- @error('current_password', 'updatePassword')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror --}}
                        </div>    
                    </div>

                    <!--Modal footer-->
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                        <button type="submit" class="btn btn-danger">Borrar Cuenta</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


