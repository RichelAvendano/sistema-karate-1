<div>

    @push('styles')
        <style>
            :root {
                --blue-light: rgba(173, 216, 230, 0.5);
                /* Azul claro más suave */
                --red-light: rgba(255, 182, 193, 0.4);
                /* Rojo claro más suave */
                --glass-bg: rgba(255, 255, 255, 0.15);
                /* Más claro y transparente */
                --glass-border: rgba(255, 255, 255, 0.2);
                /* Más claro */
                --text-light: rgba(255, 255, 255, 0.95);
                --section-bg: rgba(255, 255, 255, 0.08);
                /* Fondo más claro para secciones */
                --primary-btn: linear-gradient(90deg, rgba(100, 149, 237, 0.7), rgba(255, 99, 71, 0.6));
                /* Botones más suaves */
            }

            body {
                font-family: 'Poppins', sans-serif;
                background: linear-gradient(135deg, var(--blue-light), var(--red-light));
                color: var(--text-light);
                overflow-x: hidden;
            }

            /* Navbar Glass */
            .navbar {
                background: var(--glass-bg) !important;
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
                border-bottom: 1px solid var(--glass-border);
            }

            .navbar-brand {
                font-weight: 600;
                font-size: 1.5rem;
                background: linear-gradient(135deg, #f2abab, #a0caff);
                -webkit-background-clip: text;
                background-clip: text;
                color: transparent;
            }

            .nav-link {
                color: var(--text-light) !important;
                margin: 0 10px;
                font-weight: 500;
                position: relative;
            }

            .nav-link:hover {
                opacity: 0.8;
            }

            .nav-link::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 0;
                width: 0;
                height: 2px;
                background: white;
                transition: width 0.3s ease;
            }

            .nav-link:hover::after {
                width: 100%;
            }

            .logo-navbar {
                width: 40px;
                height: 40px;
                object-fit: cover;
            }

            /* Hero Section */
            .hero {
                position: relative;
                /* Necesario para posicionar el pseudo-elemento */
                min-height: 100vh;
                display: flex;
                align-items: center;
                overflow: hidden;
                padding-top: 80px;
            }

            .hero::before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: url('image/home/karate_about.jpg') no-repeat center center;
                background-size: cover;
                background-color: rgba(0, 0, 0, 0.5);
                /* Ajusta la opacidad aquí */
                opacity: 0.9;
                background-blend-mode: multiply;
                z-index: -1;
            }

            .hero-content {
                z-index: 2;
                position: relative;
            }

            .hero-title {
                font-size: 3.5rem;
                font-weight: 700;
                margin-bottom: 20px;
                line-height: 1.2;
                min-height: 4.2rem;
                text-align: center;
                padding: 10px;

                /* Gradiente con tonos extra claros */
                background: linear-gradient(135deg, #fecaca, #bfdbfe);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;

                /* Sombra más ligera */
                text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.2);

                /* Animación sutil */
                animation: colorGlow 2s infinite alternate;
            }

            @keyframes colorGlow {
                0% {
                    text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.2);
                }

                100% {
                    text-shadow: 2px 2px 10px rgba(254, 202, 202, 0.4), 2px 2px 10px rgba(191, 219, 254, 0.4);
                }
            }

            .hero-subtitle {
                font-size: 1.2rem;
                font-weight: 600;
                margin-bottom: 30px;
                text-align: center;
                opacity: 0.9;
                color: white;

                /* Sombra clara con los colores del título */
                text-shadow: 1px 1px 8px rgba(220, 38, 38, 0.4), 1px 1px 8px rgba(59, 130, 246, 0.4);
            }

            .system-info {
                background: var(--glass-bg);
                backdrop-filter: blur(10px);
                border-radius: 15px;
                padding: 20px;
                margin-bottom: 30px;
                border: 1px solid var(--glass-border);
                animation: fadeIn 1.5s ease-in-out;
            }

            .system-info p {
                margin-bottom: 10px;
            }

            .system-info i {
                margin-right: 10px;
                color: #fdd4d4;
            }

            .btn-glass {
                background: var(--glass-bg);
                backdrop-filter: blur(10px);
                border: 1px solid var(--glass-border);
                color: white;
                padding: 10px 25px;
                border-radius: 50px;
                font-weight: 500;
                transition: all 0.3s ease;
                margin-right: 15px;
            }

            .btn-glass:hover {
                background: rgba(255, 255, 255, 0.25);
                transform: translateY(-3px);
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
                color: white;
            }

            .btn-primary-custom {
                background: var(--primary-btn);
                border: none;
                padding: 10px 25px;
                border-radius: 50px;
                font-weight: 500;
                transition: all 0.3s ease;
            }

            .btn-primary-custom:hover {
                transform: translateY(-3px);
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
                opacity: 0.9;
            }

            /* Secciones */
            .section {
                position: relative;
                background: var(--section-bg);
                display: flex;
                align-items: center;
            }

            .section.bg-alt {
                background: rgba(255, 255, 255, 0.05);
            }


            .section-title {
                font-size: 2.5rem;
                margin-bottom: 50px;
                font-weight: 600;
                text-align: center;
                position: relative;
                display: inline-block;
                background: linear-gradient(135deg, #fecaca, #bfdbfe);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }

            .section-title::after {
                content: '';
                position: absolute;
                bottom: -5px;
                left: 50%;
                transform: translateX(-50%);
                width: 80px;
                height: 3px;
                background: linear-gradient(90deg, var(--blue-light), var(--red-light));
            }

            /* Tarjetas Glass */
            .glass-card {
                background: var(--glass-bg);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
                border-radius: 15px;
                border: 1px solid var(--glass-border);
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
                transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                padding: 15px;
                height: 100%;
            }

            .glass-card:hover {
                transform: translateY(-10px) scale(1.02);
                box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            }

            .stat-icon {
                font-size: 2.5rem;
                margin-bottom: 15px;
                color: white;
            }

            .stat-number {
                font-size: 2.5rem;
                font-weight: 700;
                margin-bottom: 10px;
                background: linear-gradient(90deg, white, #ffcc00);
                -webkit-background-clip: text;
                background-clip: text;
                color: transparent;
            }

            .stat-title {
                font-size: 1.1rem;
                opacity: 0.9;
            }

            /* Dojos Section */
            .dojo-card {
                border-radius: 15px;
                overflow: hidden;
                margin-bottom: 30px;
                transition: all 0.5s ease;
                border: none;
                transform-style: preserve-3d;
                backdrop-filter: blur(3px);
            }

            .dojo-card:hover {
                transform: translateY(-10px) rotateX(5deg);
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            }

            .dojo-img {
                height: 200px;
                object-fit: cover;
                transition: transform 0.5s ease;
            }

            .dojo-card:hover .dojo-img {
                transform: scale(1.05);
            }

            .dojo-body {
                background: var(--glass-bg);
                backdrop-filter: blur(4px);
                border: 1px solid var(--glass-border);
                padding: 20px;
                /* Añadido padding para mejor espaciado */
            }

            /* Senseis y Atletas Section */
            .sensei-card,
            .athlete-card {
                text-align: center;
                margin-bottom: 30px;
                transition: all 0.5s ease;
                perspective: 1000px;

                background: var(--glass-bg);
                backdrop-filter: blur(4px);
                border: 1px solid var(--glass-border);
                padding: 20px;
                border-radius: 5px
            }

            .sensei-img-container,
            .athlete-img-container {
                position: relative;
                width: 150px;
                height: 150px;
                margin: 0 auto 20px;
                transform-style: preserve-3d;
                transition: transform 0.8s ease;
            }

            .sensei-card:hover .sensei-img-container,
            .athlete-card:hover .athlete-img-container {
                transform: rotateY(180deg);
            }

            .sensei-img,
            .athlete-img {
                width: 100%;
                height: 100%;
                border-radius: 50%;
                object-fit: cover;
                border: 5px solid var(--glass-bg);
                position: absolute;
                backface-visibility: hidden;
                top: 0;
                right: 0;
            }

            .sensei-img-back,
            .athlete-img-back {
                transform: rotateY(180deg);
                background: linear-gradient(135deg, var(--blue-light), var(--red-light));
                display: flex;
                flex-direction: column;
                justify-content: center;
                color: white;
                font-weight: bold;
                font-size: 1.2rem;
            }

            .text-sensei-img-back {
                background: linear-gradient(90deg, white, #ffcc00);
                -webkit-background-clip: text;
                background-clip: text;
                color: transparent;
            }

            /* Estadísticas Section con fondo animado */
            .stats-bg {
                position: relative;
                min-height: 100vh;
                overflow: hidden;
            }

            .stats-bg::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: url('image/home/statistics.webp') no-repeat center center;
                background-size: cover;
                background-color: rgba(0, 0, 0, 0.5);
                /* Ajusta la opacidad aquí */
                opacity: 0.95;
                background-blend-mode: multiply;
                z-index: -1;


            }

            .stats-bg.stats-bg.dojos::before {
                background: url('image/home/section-dojos.jpg') no-repeat center center;
                background-size: cover;
                background-color: rgba(0, 0, 0, 0.5);
                /* Ajusta la opacidad aquí */
            }

            .stats-bg.stats-bg.senseis::before {
                background: url('image/home/section-senseis.jpg') no-repeat center center;
                background-size: cover;
                background-color: rgba(0, 0, 0, 0.5);
                /* Ajusta la opacidad aquí */
            }

            .stats-bg.stats-bg.students::before {
                background: url('image/home/section-students.jpg') no-repeat center center;
                background-size: cover;
                background-color: rgba(0, 0, 0, 0.5);
                /* Ajusta la opacidad aquí */
            }

            .stats-bg.stats-bg.events::before {
                background: url('image/home/section-events.jpg') no-repeat center center;
                background-size: cover;
                background-color: rgba(0, 0, 0, 0.5);
                /* Ajusta la opacidad aquí */
            }

            .stats-content {
                position: relative;
                z-index: 1;
            }

            /* Eventos Section */
            .calendar-container {
                background: var(--glass-bg);
                backdrop-filter: blur(10px);
                border-radius: 15px;
                padding: 20px;
                border: 1px solid var(--glass-border);
            }

            .event-date {
                background: linear-gradient(135deg, var(--blue-light), var(--red-light));
                color: white;
                border-radius: 10px;
                padding: 10px;
                text-align: center;
                transition: all 0.3s ease;
                min-width: 70px;
            }

            .event-card:hover .event-date {
                transform: rotate(5deg);
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            }

            .event-date .end-date {
                font-size: 0.8rem;
                display: block;
                margin-top: 3px;
                border-top: 1px solid rgba(255, 255, 255, 0.3);
                padding-top: 3px;
            }

            .event-badge {
                background: linear-gradient(135deg, var(--blue-light), var(--red-light));
                color: white;
                font-weight: 500;
            }

            /* Footer */
            .footer {
                background: linear-gradient(135deg, #ee8f8f, #74adf5);
                padding: 50px 0 20px;
                border-top: 1px solid var(--glass-border);
            }

            .social-links a {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 40px;
                height: 40px;
                background: var(--glass-bg);
                border-radius: 50%;
                margin-right: 10px;
                transition: all 0.3s ease;
            }

            .social-links a:hover {
                background: linear-gradient(135deg, var(--blue-light), var(--red-light));
                transform: translateY(-5px);
            }

            /* Animaciones */
            @keyframes float {

                0%,
                100% {
                    transform: translateY(0);
                }

                50% {
                    transform: translateY(-5px);
                }
            }

            @keyframes wave {

                0%,
                100% {
                    transform: rotate(0deg);
                }

                25% {
                    transform: rotate(5deg);
                }

                75% {
                    transform: rotate(-5deg);
                }
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                }

                to {
                    opacity: 1;
                }
            }

            @keyframes scaleIn {
                from {
                    transform: scale(0.9);
                    opacity: 0;
                }

                to {
                    transform: scale(1);
                    opacity: 1;
                }
            }

            @keyframes slideInLeft {
                from {
                    transform: translateX(-50px);
                    opacity: 0;
                }

                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }

            @keyframes slideInRight {
                from {
                    transform: translateX(50px);
                    opacity: 0;
                }

                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }

            .floating {
                animation: float 6s ease-in-out infinite;
            }

            .waving {
                display: inline-block;
                animation: wave 2s ease-in-out infinite;
            }

            .animate-float {
                animation: float 2s ease-in-out infinite;
            }

            .animate-scale {
                animation: scaleIn 0.8s ease-out forwards;
            }

            .animate-slide-left {
                animation: slideInLeft 0.8s ease-out forwards;
            }

            .animate-slide-right {
                animation: slideInRight 0.8s ease-out forwards;
            }

            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @keyframes typeWriter {
                from {
                    width: 0
                }

                to {
                    width: 100%
                }
            }

            .animate {
                animation: fadeInUp 1s ease forwards;
                opacity: 0;
            }

            .delay-1 {
                animation-delay: 0.2s;
            }

            .delay-2 {
                animation-delay: 0.4s;
            }

            .delay-3 {
                animation-delay: 0.6s;
            }

            .typewriter {
                overflow: hidden;
                border-right: 3px solid white;
                white-space: nowrap;
                margin: 0 auto;
                letter-spacing: 2px;
                animation:
                    typeWriter 3.5s steps(40, end),
                    blinkCursor 0.75s step-end infinite;
            }

            .card-title {
                background: linear-gradient(90deg, white, #ffcc00);
                -webkit-background-clip: text;
                background-clip: text;
                color: transparent;
            }

            @keyframes blinkCursor {

                from,
                to {
                    border-color: transparent
                }

                50% {
                    border-color: white
                }
            }

            /* Efecto de partículas */
            #particles-js {
                position: absolute;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                z-index: 1;
            }

            /* Responsive */
            @media (max-width: 768px) {
                .hero-title {
                    font-size: 2.5rem;
                }

                .section-title {
                    font-size: 2rem;
                }

                .hero {
                    text-align: center;
                    background-position: 60% center;
                }
            }
        </style>
    @endpush
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="">
                <img src="{{ asset('image/home/icono-logo.png') }}" class="logo-navbar">ASO Karate Do
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#dojos">Dojos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#senseis">Senseis</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#atletas">Atletas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#eventos">Eventos</a>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-outline-light rounded-pill" href="{{route('login')}}">
                            <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <h1 class="hero-title" id="typewriter"></h1>
                        <p class="hero-subtitle animate">Sistema completo para administrar dojos, senseis, atletas y
                            eventos en una sola plataforma</p>

                        <div class="system-info animate delay-1">
                            <p class="hero-subtitle" style="font-size:1rem; text-align: start"><i
                                    class="fas fa-check-circle"></i> Gestión centralizada de todos tus dojos</p>
                            <p class="hero-subtitle" style="font-size:1rem; text-align: start"><i
                                    class="fas fa-check-circle"></i> Control completo de senseis y atletas</p>
                            <p class="hero-subtitle" style="font-size:1rem; text-align: start"><i
                                    class="fas fa-check-circle"></i> Organización de eventos</p>
                            <p class="hero-subtitle" style="font-size:1rem; text-align: start"><i
                                    class="fas fa-check-circle"></i> Reportes y estadísticas en tiempo real</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <img src="{{ asset('image/home/home-inicio-front.webp') }}" alt="Hero Image"
                        class="img-fluid floating animate-slide-right"
                        style="animation-delay: 0.5s; border-radius: 15px; border: 2px solid rgba(255,255,255,0.2);max-height: 500px;">
                </div>
            </div>
        </div>
    </section>

    <!-- Estadísticas Section -->
    <section id="estadisticas" class="section stats-bg" style="">
        <div class="container stats-content">
            <h2 class="section-title animate">Estadísticas Generales</h2>
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="glass-card text-center animate animate-scale">
                        <i class="fas fa-vihara card-title stat-icon waving" style="animation-delay: 0.5s"></i>
                        <h3 class="stat-number">{{ $dojosCount }}</h3>
                        <p class="stat-title">Dojos Registrados</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="glass-card text-center animate delay-1 animate-scale">
                        <i class="fas fa-user-ninja card-title stat-icon waving" style="animation-delay: 0.7s"></i>
                        <h3 class="stat-number">{{ $senseisActive }}</h3>
                        <p class="stat-title">Senseis Activos</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="glass-card text-center animate delay-2 animate-scale">
                        <i class="fas fa-user-graduate card-title stat-icon waving" style="animation-delay: 0.9s"></i>
                        <h3 class="stat-number">{{ $studentsCount }}</h3>
                        <p class="stat-title">Atletas Registrados</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="glass-card text-center animate delay-3 animate-scale">
                        <i class="fas fa-calendar-alt card-title stat-icon waving" style="animation-delay: 1.1s"></i>
                        <h3 class="stat-number">{{ $eventosUpcoming }}</h3>
                        <p class="stat-title">Próximos Eventos</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Dojos Section -->
    <section id="dojos" class="section stats-bg dojos">
        <div class="container">
            <h2 class="section-title animate">Nuestros Dojos</h2>
            <div class="row">
                @php $flag= 0; @endphp
                @foreach ($dojos as $dojo)
                    @php $flag++ @endphp
                    <div class="col-lg-4 col-md-6">
                        <div
                            class="dojo-card animate 
                            @if ($flag == 1) animate-slide-left
                            @elseif($flag == 2)
                                delay-3
                            @else
                                animate-slide-right @endif">
                            @if ($dojo->photo)
                                <div class="dojo-image-ultimate">
                                    <img src="{{ asset('storage/' . $dojo->photo) }}" class="card-img-top dojo-img"
                                        alt="Dojo Shorinji">
                                </div>
                            @else
                                <div class="dojo-image-ultimate">
                                    <img src="{{ asset('image/dojo-default.jpg') }}">
                                </div>
                            @endif
                            <div class="card-body dojo-body">
                                <h5 class="card-title mb-2"><i class="fa-solid fa-vihara card-title"></i>
                                    {{ $dojo->name }}</h5>
                                <p class="card-text"><i class="fas fa-map-marker-alt me-2"></i> {{ $dojo->location }}
                                </p>
                                <p class="card-text"><i class="fas fa-user-ninja me-2"></i>Sensei:
                                    {{ $dojo->sensei->name }}</p>
                                <p class="card-text"><i class="fas fa-users me-2"></i>Atletas:
                                    {{ $dojo->student_count }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Senseis Section -->
    <section id="senseis" class="section stats-bg senseis">
        <div class="container">
            <h2 class="section-title animate">Nuestros Senseis</h2>
            <div class="row justify-content-center">
                @foreach ($senseis as $sensei)
                    <div class="col-lg-4 col-md-6" style="width:28%">
                        <div class="sensei-card animate animate-slide-left">
                            <div class="sensei-img-container">
                                <img src="{{ asset('storage/' . $sensei->photo) }}" class="sensei-img"
                                    alt="Sensei 1">
                                <div class="sensei-img sensei-img-back">
                                    <p class="text-sensei-img-back fs-4 mb-0">{{ $sensei->dan }}</p>
                                    <i class="fa-solid fa-medal fa-2x text-sensei-img-back"></i>
                                </div>
                            </div>
                            <h5 class="card-title mb-2"><i class="fa-solid fa-user-ninja"></i> {{ $sensei->name }}
                            </h5>
                            <p class="m-1"><i class="fas fa-vihara me-2"></i>Dojo:
                                {{ $sensei->dojo->name ?? 'sin dojo' }}</p>
                            <p class="m-1"><i class="fas fa-cake me-2"></i> Edad:
                                {{ \Carbon\Carbon::parse($sensei->date_of_birth)->age }} años</p>
                            <p class="m-1"><i class="fas fa-calendar-days me-2"></i> Eventos:
                                {{ $sensei->event_count }}</p>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Atletas Section -->
    <section id="atletas" class="section stats-bg students">
        <div class="container">
            <h2 class="section-title animate">Nuestros Atletas</h2>
            <div class="row justify-content-center">
                @foreach ($students as $student)
                    <div class="col-lg-4 col-md-6" style="width:28%">
                        <div class="sensei-card animate animate-slide-right">
                            <div class="sensei-img-container">
                                <img src="{{ asset('storage/' . $student->photo) }}" class="sensei-img"
                                    alt="Sensei 1">
                                <div class="sensei-img sensei-img-back">
                                    <p class="text-sensei-img-back fs-4 mb-0">{{ $student->kyu }}</p>
                                    <i class="fa-solid fa-medal fa-2x text-sensei-img-back"></i>
                                </div>
                            </div>
                            <h5 class="card-title mb-2"><i class="fa-solid fa-user-graduate"></i>
                                {{ $student->name }}</h5>
                            <p class="m-1"><i class="fas fa-vihara me-2"></i>Dojo:
                                {{ $student->dojo->name ?? 'sin dojo' }}</p>
                            <p class="m-1"><i class="fas fa-cake me-2"></i> Edad:
                                {{ \Carbon\Carbon::parse($student->date_of_birth)->age }} años</p>
                            <p class="m-1"><i class="fas fa-calendar-days me-2"></i> Eventos:
                                {{ $student->event_count }}</p>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Eventos Section -->
    <section id="eventos" class="section stats-bg events">
        <div class="container">
            
            <div class="row">
                <h2 class="section-title animate mb-3">Próximos Eventos</h2> 
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        @foreach($eventsUpcoming->chunk(4) as $index => $grupoEventos) <!-- Un botón por cada grupo de eventos -->
                            <button type="button" data-bs-target="#eventCarousel" data-bs-slide-to="{{ $index }}"
                                class="@if($loop->first) active @endif" 
                                aria-label="Slide {{ $index + 1 }}"></button>
                        @endforeach
                    </div>
                    <div class="carousel-inner">
                        @foreach($eventsUpcoming->chunk(4) as $grupoEventos) <!-- Agrupa de 4 en 4 (2 filas por item) -->
                            <div class="carousel-item @if($loop->first) active @endif">
                                
                                @foreach($grupoEventos->chunk(2) as $filaEventos) <!-- Agrupa de 2 en 2 para cada fila -->
                                <div class="row justify-content-center mb-3">
                                    @foreach($filaEventos as $evento)
                                    <div class="col-md-4 mb-4" style="min-width: 300px; max-width: 300px;">
                                        <div class="glass-card event-card animate animate-slide-left">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="event-date me-3">
                                                    <div class="fw-bold" style="font-size: 1.5rem;">{{ \Carbon\Carbon::parse($evento->start_date)->format('d') }}</div>
                                                    <div>{{ strtoupper(\Carbon\Carbon::parse($evento->start_date)->format('M')) }}</div>
                                                    <small class="end-date">{{ \Carbon\Carbon::parse($evento->end_date)->format('d M') }}</small>
                                                </div>
                                                <div>
                                                    <h5 class="mb-0 card-title">{{ $evento->name }}</h5>
                                                    <p class="text-secondary-color"><i class="fa-solid fa-location-dot me-1"></i>{{ $evento->location }}</p>
                                                </div>
                                            </div>
                                            <p>{{ $evento->description }}</p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @endforeach
                            
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            @if($eventsCurrent)
            <div class="row">
                <h2 class="section-title animate mb-3">Eventos Actuales</h2> 
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        @foreach($eventsCurrent->chunk(4) as $index => $grupoEventos) <!-- Un botón por cada grupo de eventos -->
                            <button type="button" data-bs-target="#eventCarousel" data-bs-slide-to="{{ $index }}"
                                class="@if($loop->first) active @endif" 
                                aria-label="Slide {{ $index + 1 }}"></button>
                        @endforeach
                    </div>
                    <div class="carousel-inner">
                        @foreach($eventsCurrent->chunk(4) as $grupoEventos) <!-- Agrupa de 4 en 4 (2 filas por item) -->
                            <div class="carousel-item @if($loop->first) active @endif">
                                
                                @foreach($grupoEventos->chunk(2) as $filaEventos) <!-- Agrupa de 2 en 2 para cada fila -->
                                <div class="row justify-content-center mb-3">
                                    @foreach($filaEventos as $evento)
                                    <div class="col-md-4 mb-4" style="min-width: 300px; max-width: 300px;">
                                        <div class="glass-card event-card animate animate-slide-left">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="event-date me-3">
                                                    <div class="fw-bold" style="font-size: 1.5rem;">{{ \Carbon\Carbon::parse($evento->start_date)->format('d') }}</div>
                                                    <div>{{ strtoupper(\Carbon\Carbon::parse($evento->start_date)->format('M')) }}</div>
                                                    <small class="end-date">{{ \Carbon\Carbon::parse($evento->end_date)->format('d M') }}</small>
                                                </div>
                                                <div>
                                                    <h5 class="mb-0 card-title">{{ $evento->name }}</h5>
                                                    <p class="text-secondary-color"><i class="fa-solid fa-location-dot me-1"></i>{{ $evento->location }}</p>
                                                </div>
                                            </div>
                                            <p>{{ $evento->description }}</p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @endforeach
                            
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5>
                        <a class="navbar-brand" href="">
                            <img src="{{ asset('image/home/icono-logo.png') }}" class="logo-navbar">
                        </a>ASO Karate Do de Barinas
                    </h5>
                    <p>Sistema de gestión integral para dojos de karate. Controla dojos, senseis, atletas y eventos en
                        una sola plataforma.</p>
                    
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5>Enlaces</h5>
                    <ul class="list-unstyled">
                        <li><a href="#home" class="text-white">Inicio</a></li>
                        <li><a href="#dojos" class="text-white">Dojos</a></li>
                        <li><a href="#senseis" class="text-white">Senseis</a></li>
                        <li><a href="#atletas" class="text-white">Atletas</a></li>
                        <li><a href="#eventos" class="text-white">Eventos</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Contacto</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-map-marker-alt me-2"></i> Barinas, Venezuela</li>
                        <li><i class="fas fa-phone me-2"></i> +58 414 123 4567</li>
                        <li><i class="fas fa-envelope me-2"></i> info@karatedo.com</li>
                    </ul>
                </div>
                <div class="col-lg-3 mb-4">
                    <h5>Redes Sociales</h5>
                    <p>Siguenos para seguir al tanto de las ultimas novedades</p>
                    <div class="social-links mt-3">
                        <a href="#" target="_blanck" class="text-white text-decoration-none"><i class="fab fa-facebook"></i></a>
                        <a href="#" target="_blanck" class="text-white text-decoration-none"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.instagram.com/asokaratedo.barinas/" target="_blanck" class="text-white text-decoration-none"><i class="fab fa-instagram"></i></a>
                        <a href="#" target="_blanck" class="text-white text-decoration-none"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <hr class="my-4 bg-light">
            <div class="text-center">
                <p class="mb-0">&copy; 2025 ASO Karate Do de Barinas. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>


    <script>
        // Animación de escritura
        const text = "Asociación de Karate Do de Barinas";
        let i = 0;
        const speed = 100;

        function typeWriter() {
            if (i < text.length) {
                document.getElementById("typewriter").innerHTML += text.charAt(i);
                i++;
                setTimeout(typeWriter, speed);
            } else {
                // Esperar un tiempo antes de reiniciar
                setTimeout(() => {
                    document.getElementById("typewriter").innerHTML = "";
                    i = 0;
                    typeWriter(); // Reiniciar animación
                }, 2000); // Espera 2 segundos antes de reiniciar
            }
        }


        // Inicializar animaciones al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            // Animación de escritura
            typeWriter();

            // Animación al hacer scroll
            const animateElements = document.querySelectorAll('.animate, .delay-1, .delay-2, .delay-3');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';

                        // Agregar animaciones adicionales según la clase
                        if (entry.target.classList.contains('animate-scale')) {
                            entry.target.style.animation = 'scaleIn 0.8s ease-out forwards';
                        }
                        if (entry.target.classList.contains('animate-slide-left')) {
                            entry.target.style.animation = 'slideInLeft 0.8s ease-out forwards';
                        }
                        if (entry.target.classList.contains('animate-slide-right')) {
                            entry.target.style.animation = 'slideInRight 0.8s ease-out forwards';
                        }
                        if (entry.target.classList.contains('animate-float')) {
                            entry.target.style.animation = 'float 4s ease-in-out infinite';
                        }
                    }
                });
            }, {
                threshold: 0.1
            });

            animateElements.forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(30px)';
                el.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
                observer.observe(el);
            });

            // Smooth scrolling para los enlaces
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();

                    const targetId = this.getAttribute('href');
                    const targetElement = document.querySelector(targetId);

                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 80,
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // Efecto de onda aleatorio en elementos
            setInterval(() => {
                const wavingElements = document.querySelectorAll('.waving');
                wavingElements.forEach(el => {
                    el.style.animationDelay = `${Math.random() * 2}s`;
                });
            }, 3000);
        });
    </script>

    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener("click", function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute("href"));
                if (target) {
                    window.scrollTo({
                        top: target.offsetTop - 50,
                        /* Ajusta según el espacio que queda */
                        behavior: "smooth"
                    });
                }
            });
        });
    </script>

</div>
