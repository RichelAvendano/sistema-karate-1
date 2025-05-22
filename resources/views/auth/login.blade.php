<x-guest-layout>

    @push('styles')
        <style>
            /* Estilos generales */
            :root {
                --blue-light: rgba(100, 150, 255, 0.7);
                --red-light: rgba(255, 100, 150, 0.5);
                --white-transparent: rgba(255, 255, 255, 0.8);
                --font-size-large: 1.1rem;
                --icon-size: 1.2rem;
            }

            *{
                
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }

            .container{
                background-size: cover;
                display: flex;
                justify-content: center;
                align-items: center;
                min-width: 100vw;
                min-height: 100vh;
                padding: 20px;
                margin: 0;
            }

            .container::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: url('image/home/section-dojos.jpg') no-repeat center center;
                filter: blur(3px);
                background-size: cover;
                background-blend-mode: multiply;
            }

            /* Contenedor principal */
            .login-container {
                width: 100%;
                max-width: 1000px;
                border-radius: 20px;
                overflow: hidden;
                box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            }

            .login-glass {
                display: flex;
                height: 600px;
            }

            /* Sección de imagen */
            .login-image {
                flex: 1;
                background-size: cover;
                position: relative;
            }

            .login-image::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: url('image/home/login-form.webp') no-repeat center center;
                background-size: cover;
                background-blend-mode: multiply;
            }

            /* Contenido del formulario */
            .login-content {
                flex: 1;
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(15px);
                padding: 10px 40px;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }

            .logo-container {
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .container-logo {
                width: 120px; /* Un poco más grande que la imagen */
                height: 120px;
                border-radius: 50%; /* Hace que el borde sea completamente redondo */
                background: linear-gradient(135deg, rgb(0 82 255), rgb(255 0 82));
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 5px; /* Espacio para el borde */
            }

            .logo {
                width: 110px;
                height: 110px;
                border-radius: 50%;
                object-fit: cover;
            }



            .logo-container h1 {
                color: white;
                font-size: 2rem;
                margin-bottom: 10px;
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
                text-align: center;
            }

            .logo-container p {
                color: var(--white-transparent);
                font-size: 1.1rem;
            }

            /* Formulario */
            .login-form {
                display: flex;
                flex-direction: column;
                gap: 25px;
            }

            .input-group {
                display: flex;
                flex-direction: column;
                gap: 10px;
                margin-bottom: 5px;
            }

            .input-group label {
                color: white;
                font-size: var(--font-size-large);
                font-weight: 500;
            }

            .input-wrapper {
                position: relative;
                display: flex;
                align-items: center;
            }

            .input-wrapper i {
                position: absolute;
                left: 15px;
                color: var(--white-transparent);
                font-size: var(--icon-size);
            }

            .icon-large {
                font-size: var(--icon-size);
            }

            .input-wrapper .toggle-password {
                left: auto;
                right: 15px;
                cursor: pointer;
            }

            .input-wrapper input {
                width: 100%;
                padding: 10px 10px 10px 50px;
                background: rgba(255, 255, 255, 0.2);
                border: 1px solid rgba(255, 255, 255, 0.3);
                border-radius: 8px;
                color: white;
                font-size: var(--font-size-large);
                transition: all 0.3s;
            }

            .input-wrapper input:focus {
                outline: none;
                background: rgba(255, 255, 255, 0.3);
                border-color: var(--blue-light);
                box-shadow: 0 0 0 2px var(--blue-light);
            }

            .input-wrapper input::placeholder {
                color: rgba(255, 255, 255, 0.6);
                font-size: var(--font-size-large);
            }

            /* Opciones */
            .options {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .remember-me {
                display: flex;
                align-items: center;
                color: var(--white-transparent);
                font-size: var(--font-size-large);
                cursor: pointer;
                position: relative;
            }

            .remember-me input {
                position: absolute;
                opacity: 0;
                cursor: pointer;
            }

            .checkmark {
                height: 20px;
                width: 20px;
                background: rgba(255, 255, 255, 0.2);
                border: 1px solid rgba(255, 255, 255, 0.3);
                border-radius: 4px;
                margin-right: 10px;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .remember-me input:checked ~ .checkmark {
                background: var(--blue-light);
            }

            .checkmark:after {
                content: "";
                display: none;
                width: 6px;
                height: 12px;
                border: solid white;
                border-width: 0 2px 2px 0;
                transform: rotate(45deg);
                margin-bottom: 2px;
            }

            .remember-me input:checked ~ .checkmark:after {
                display: block;
            }

            .forgot-password {
                color: var(--white-transparent);
                font-size: var(--font-size-large);
                text-decoration: none;
                transition: color 0.3s;
            }

            .forgot-password:hover {
                color: white;
            }

            /* Botones */
            .login-btn {
                background: linear-gradient(135deg, rgb(100 150 255 / 45%), rgb(255 100 150 / 42%));
                color: white;
                border: none;
                padding: 16px;
                border-radius: 8px;
                font-size: 1.1rem;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            }

            .login-btn:hover {
                transform: translateY(-2px);
                background: linear-gradient(135deg, var(--blue-light), var(--red-light));
                box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            }

            .divider {
                display: flex;
                align-items: center;
                color: var(--white-transparent);
                font-size: var(--font-size-large);
                margin: 10px 0;
            }

            .divider::before, .divider::after {
                content: "";
                flex: 1;
                height: 1px;
                background: rgba(255, 255, 255, 0.2);
                margin: 0 10px;
            }

            .google-btn {
                background: rgba(255, 255, 255, 0.9);
                color: #444;
                border: none;
                padding: 16px;
                border-radius: 8px;
                font-size: 1.1rem;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
            }

            .google-btn:hover {
                background: white;
                transform: translateY(-2px);
            }

            .google-btn img {
                width: 22px;
                height: 22px;
            }

            /* Responsive */
            @media (max-width: 768px) {
                .login-glass {
                    flex-direction: column;
                    height: auto;
                }
                
                .login-image {
                    height: 200px;
                }
                
                :root {
                    --font-size-large: 1rem;
                    --icon-size: 1rem;
                }
            }

            .error-label {
                color: #d32231 !important;
            }

            .error-input {
                border: 1px solid #ff4757 !important;
                border-radius: 8px !important;
                background: rgba(255, 71, 87, 0.1) !important;
            }

            .error-icon {
                color: #ff4757 !important;
            }

            .input-error {
                color: #f4c9cc;
                font-size: 0.85rem;
                margin-top: 5px;
                padding: 8px 12px;
                background: rgba(255, 71, 87, 0.1);
                border-left: 3px solid #ff4757;
                border-radius: 0 4px 4px 0;
                animation-duration: 0.4s;
                display: flex;
                align-items: center;
            }

            .input-error::before {
                content: "⚠";
                margin-right: 8px;
                font-size: 1rem;
            }

            /* Animaciones */
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(5px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            
            .input-wrapper input:-webkit-autofill,
            .input-wrapper input:-webkit-autofill:hover,
            .input-wrapper input:-webkit-autofill:focus,
            .input-wrapper input:-webkit-autofill:active {
                /* >>> Sobrescribe el fondo del navegador con tu color semi-transparente <<< */
                /* Usamos el MISMO color rgba(255, 255, 255, 0.2) */
                /* background-color: rgba(255, 255, 255, 0.2) !important; */ /* A veces no es necesario si box-shadow funciona */
                box-shadow: 0 0 0px 1000px rgba(0, 0, 0, 0.448) inset !important; /* Usa tu color semi-transparente aquí */

                /* >>> Asegúrate de que la opacidad y el backdrop-filter ORIGINALES NO SE PIERDAN <<< */
                /* El navegador podría intentar desactivarlos; los forzamos de nuevo */
                /* Si tu input original tiene opacity: 1, úsalo aquí */
                /* Si tu input original tiene opacity: 0.8 (del background), puedes poner 1 aquí */
                opacity: 1 !important; /* Normalmente querrás opacidad 1 para que el box-shadow se vea bien */

                /* Fuerza tu backdrop-filter original si el navegador lo desactiva */
                /* backdrop-filter: blur(5px) !important; */ /* Usa el mismo valor que en tus estilos normales */


                /* MANTEN los colores de texto y cursor para que se vean bien */
                -webkit-text-fill-color: white !important; /* Usa tu color de texto original */
                caret-color: white !important; /* Usa tu color de cursor original */

                /* Puedes necesitar sobrescribir el color del borde si el navegador lo cambia */
                /* border-color: rgba(255, 255, 255, 0.3) !important; */
            }

        </style>

    @endpush
    <div class="container">
        <div class="login-container">
            <div class="login-glass">
                <!-- Imagen de fondo con efecto -->
                <div class="login-image"></div>
                
                <!-- Contenido del formulario -->
                <div class="login-content">
                    <div class="logo-container">
                        <div class="container-logo">
                            <img src="{{asset('image/home/logo-aso.png')}}" alt="Karate Do Logo" class="logo">
                        </div>
                        <h1>Asociacion de Karate Do de Barinas</h1>
                        <p>Acceso al portal de dojos</p>
                    </div>
                    
                    <form method="POST" action="{{ route('login') }}" class="login-form">
                        @csrf
                        <div class="input-group">
                            <label for="email" class="@error('email') error-label @enderror">Correo Electrónico</label>
                            <div class="input-wrapper @error('email') error-input @enderror">
                                <i class="fas fa-envelope icon-large @error('email') error-icon @enderror"></i>
                                <input type="email" id="email" placeholder="dojo@gmail.com" name="email" value="{{ old('email') }}" required>
                            </div>
                            @error('email')
                                <div class="input-error animated fadeInUp">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="input-group">
                            <label for="password" class="@error('password') error-label @enderror">Contraseña</label>
                            <div class="input-wrapper @error('password') error-input @enderror">
                                <i class="fa-solid fa-lock @error('password') error-icon @enderror"></i>
                                <input type="password" id="password" placeholder="••••••••" name="password" required value="{{ old('password') }}">
                                <i class="fas fa-eye toggle-password icon-large @error('password') error-icon @enderror"></i>
                            </div>
                            @error('password')
                                <div class="input-error animated fadeInUp">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <button type="submit" class="login-btn">Iniciar Sesión</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg rounded-lg">
                    <div class="card-body p-5">
                        <h3 class="text-center mb-4">{{ __('Iniciar Sesión') }}</h3>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Correo Electrónico') }}</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="{{ __('Ingresa tu correo electrónico') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('Contraseña') }}</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="current-password" placeholder="{{ __('Ingresa tu contraseña') }}">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                                <label class="form-check-label" for="remember_me">{{ __('Recordarme') }}</label>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">{{ __('Iniciar Sesión') }}</button>
                            </div>

                            <div class="mt-3 text-center">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('¿Olvidaste tu contraseña?') }}
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    @push('scripts')
        <script>
        // Función para mostrar/ocultar contraseña
        document.querySelectorAll('.toggle-password').forEach(icon => {
            icon.addEventListener('click', function() {
                const input = this.previousElementSibling;
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);
                this.classList.toggle('fa-eye-slash');
            });
        });
        </script>
    @endpush
</x-guest-layout>
