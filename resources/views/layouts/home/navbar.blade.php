<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{route('home')}}">Karate DO</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          @if (Auth::check())
              <a class="nav-link active" aria-current="page" href="{{route('dashboard')}}">Dashboard</a>                     
          @else
              <a class="nav-link" href="{{route('login')}}">Iniciar Sesion</a>
              <a class="nav-link" href="{{route('register')}}">Registrarse</a>
          @endif
        </div>
      </div>
    </div>
  </nav>