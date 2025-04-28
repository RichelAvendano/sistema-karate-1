<section>
    <header class="mb-4">
        <h5 class="card-title">{{ __('Actualizar Contraseña') }}</h5>
        <p class="card-subtitle text-muted">{{ __('Asegúrate de que tu cuenta esté usando una contraseña larga y aleatoria para mantenerse segura.') }}</p>
    </header>
    @if ($errors->updatePassword->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->updatePassword->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('status') == 'password-updated')
        <div class="alert alert-success">Tu Contraseña ha sido cambiada con Exito</div>
    @endif
    <form method="post" action="{{ route('password.update') }}" class="mt-3">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="update_password_current_password" class="form-label">{{ __('Contraseña Actual') }}</label>
            <input id="update_password_current_password" name="current_password" type="password" class="form-control" autocomplete="current-password">
            {{-- @error('current_password', 'updatePassword')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror --}}
        </div>

        <div class="mb-3">
            <label for="update_password_password" class="form-label">{{ __('Nueva Contraseña') }}</label>
            <input id="update_password_password" name="password" type="password" class="form-control" autocomplete="new-password">
        </div>

        <div class="mb-3">
            <label for="update_password_password_confirmation" class="form-label">{{ __('Confirmar Contraseña') }}</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password">
        </div>

        <div class="panel-footer">
            <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>   
        </div>
    </form>
</section>