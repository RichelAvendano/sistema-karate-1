<x-app2-layout>
    <div class="container-fluid bg-dark text-white py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h1 class="display-4 fw-bold mb-4">Asociación de Karate-Do</h1>
                <p class="lead mb-4">Dedicados a la enseñanza y la práctica del Karate-Do tradicional.</p>
                <a href="{{route('login')}}" class="btn btn-primary btn-lg">Únete a Nosotros</a>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Sobre Nosotros</h2>
        <div class="row">
            <div class="col-md-6">
                <p class="lead">Nuestra asociación se fundó en [Año] con la misión de promover los valores y la disciplina del Karate-Do. Creemos en el desarrollo integral de nuestros miembros, tanto física como mentalmente. Nuestros instructores altamente calificados están comprometidos a brindar una enseñanza de calidad en un ambiente seguro y respetuoso.</p>
                <p>Fomentamos la perseverancia, el autocontrol y el espíritu de superación a través de la práctica constante del Karate-Do. Ya seas un principiante o un practicante avanzado, encontrarás un lugar en nuestra comunidad.</p>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('image/home/karate_about.jpg') }}" alt="Sobre Nosotros" class="img-fluid rounded shadow-sm">
            </div>
        </div>

        <h2 class="text-center mt-5 mb-4">Nuestros Estilos</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="card h-100 text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Shotokan</h5>
                        <p class="card-text">Un estilo de karate tradicional caracterizado por sus técnicas poderosas y directas. Se enfoca en el desarrollo de la fuerza y la velocidad.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Goju-Ryu</h5>
                        <p class="card-text">Un estilo que combina técnicas duras y blandas, enfatizando la respiración y el combate a corta distancia.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-primary">[Otro Estilo]</h5>
                        <p class="card-text">[Breve descripción del otro estilo que enseñan].</p>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="text-center mt-5 mb-4">Clases y Entrenamiento</h2>
        <div class="row">
            <div class="col-md-6">
                <h4>Horario de Clases</h4>
                <p class="lead">Consulta nuestro horario de clases para encontrar el horario que mejor se adapte a ti.</p>
                <ul class="list-unstyled">
                    <li><i class="fas fa-check-circle text-success me-2"></i> Lunes y Miércoles: 18:00 - 19:30 (Principiantes)</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i> Martes y Jueves: 19:00 - 20:30 (Avanzados)</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i> Sábados: 10:00 - 12:00 (Clase General)</li>
                </ul>
            </div>
            <div class="col-md-6">
                <h4>¿Qué esperar?</h4>
                <p class="lead">Nuestras clases incluyen calentamiento, acondicionamiento físico, práctica de técnicas básicas (kihon), formas (kata) y combate (kumite) supervisado. Fomentamos un ambiente de aprendizaje positivo y de apoyo.</p>
                <p>Todos los niveles son bienvenidos. ¡Ven y prueba tu primera clase gratis!</p>
            </div>
        </div>

        <h2 class="text-center mt-5 mb-4">Galería</h2>
        <div id="carouselExampleRide" class="carousel slide mx-auto" data-bs-ride="true" style="width: 40vw;">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('image/home/karate_gallery1.jpg') }}" class="d-block w-100 mh-50" alt="Imagen de la galería 1" style="object-fit: cover; height: 50vh;">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('image/home/karate_gallery2.jpg') }}" class="d-block w-100 mh-50" alt="Imagen de la galería 2" style="object-fit: cover; height: 50vh;">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('image/home/karate_gallery3.jpg') }}" class="d-block w-100 mh-50" alt="Imagen de la galería 3" style="object-fit: cover; height: 50vh;">
                </div>
                </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <h2 class="text-center mt-5 mb-4">Testimonios</h2>
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <div class="col">
                <blockquote class="blockquote bg-light p-3 rounded shadow-sm border-start border-primary border-5">
                    <p class="mb-0">"Desde que me uní a esta asociación, he notado una gran mejora en mi condición física y mi disciplina mental. Los instructores son excelentes y la comunidad es muy acogedora."</p>
                    <footer class="blockquote-footer mt-2">Juan Pérez, <cite title="Source Title">Miembro</cite></footer>
                </blockquote>
            </div>
            <div class="col">
                <blockquote class="blockquote bg-light p-3 rounded shadow-sm border-start border-primary border-5">
                    <p class="mb-0">"El Karate-Do no solo me ha enseñado defensa personal, sino también respeto y perseverancia. Estoy muy agradecido de ser parte de esta asociación."</p>
                    <footer class="blockquote-footer mt-2">María Gómez, <cite title="Source Title">Miembro</cite></footer>
                </blockquote>
            </div>
        </div>

        <h2 class="text-center mt-5 mb-4">Contáctanos</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <p class="lead">¿Tienes alguna pregunta o deseas unirte a nuestra asociación? ¡No dudes en contactarnos!</p>
                <p><i class="fas fa-map-marker-alt text-primary me-2"></i> <strong>Dirección:</strong> [Tu Dirección Aquí]</p>
                <p><i class="fas fa-phone text-primary me-2"></i> <strong>Teléfono:</strong> [Tu Número de Teléfono Aquí]</p>
                <p><i class="fas fa-envelope text-primary me-2"></i> <strong>Email:</strong> [Tu Correo Electrónico Aquí]</p>
                <div class="mt-3">
                    <a href="#" class="btn btn-outline-primary">Formulario de Contacto</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // No necesitas lógica Alpine.js específica para este HTML estático
        // Puedes añadir funcionalidades interactivas con Alpine.js si lo deseas
    </script>
</x-app2-layout>