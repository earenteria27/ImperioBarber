@php
    $imagenes = [
        ['archivo' => 'Barberia.jpeg', 'titulo' => 'Nuestras instalaciones'],
        ['archivo' => 'foto1.jpeg', 'titulo' => 'Corte fade moderno'],
        ['archivo' => 'foto2.jpeg', 'titulo' => 'Estilo clásico'],
        ['archivo' => 'foto3.jpeg', 'titulo' => 'Diseño y barba'],
        ['archivo' => 'foto4.jpeg', 'titulo' => 'Perfilado de barba'],
        ['archivo' => 'foto5.jpeg', 'titulo' => 'Corte texturizado'],
        ['archivo' => 'foto6.jpeg', 'titulo' => 'Estilo urbano'],
    ];
@endphp

<div class="row g-4">
    <div class="col-12 col-lg-8">
        <article class="card h-100 shadow-sm border-0 bg-dark text-white overflow-hidden">
            <video
                class="card-img-top w-100"
                controls
                preload="metadata"
                playsinline
                poster="{{ asset('img/galerias/Barberia.jpeg') }}"
                aria-label="Video de los cortes y servicios de barbería de ImperioBarber"
                style="height: 320px; object-fit: cover;"
            >
                <source src="{{ asset('img/galerias/VideoBarber.mp4') }}" type="video/mp4">
                Tu navegador no puede reproducir este video.
            </video>
            <div class="card-body">
                <p class="text-warning text-uppercase small fw-semibold mb-2">Un vistazo a la barbería</p>
                <h3 class="h5 card-title">Tu estilo, en buenas manos</h3>
                <p class="card-text text-white-50 mb-3">
                    Cortes definidos, barba impecable y atención a cada detalle.
                </p>
                <div class="d-flex flex-wrap gap-2">
                    <span class="badge text-bg-secondary">Cortes precisos</span>
                    <span class="badge text-bg-secondary">Barba con carácter</span>
                    <span class="badge text-bg-secondary">Estilo propio</span>
                </div>
            </div>
        </article>
    </div>

    @foreach($imagenes as $img)
        <div class="col-12 col-sm-6 col-lg-4">
            <article class="card h-100 shadow-sm border-0 bg-dark text-white overflow-hidden">
                <img
                    src="{{ asset('img/galerias/' . $img['archivo']) }}"
                    class="card-img-top"
                    alt="{{ $img['titulo'] }}"
                    loading="lazy"
                    style="height: 240px; object-fit: cover;"
                >
                <div class="card-body text-center">
                    <h3 class="h5 card-title mb-0">{{ $img['titulo'] }}</h3>
                </div>
            </article>
        </div>
    @endforeach
</div>
