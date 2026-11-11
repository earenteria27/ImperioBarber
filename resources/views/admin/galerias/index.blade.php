@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-black">Galería de Servicios y Estilos</h2>

    <div class="row">
        @php
            $imagenes = [
                ['archivo' => 'Barberia.jpeg', 'titulo' => 'Nuestras Instalaciones'],
                ['archivo' => 'foto1.jpeg', 'titulo' => 'Corte Fade Moderno'],
                ['archivo' => 'foto2.jpeg', 'titulo' => 'Estilo Clásico'],
                ['archivo' => 'foto3.jpeg', 'titulo' => 'Diseño y Barba'],
                ['archivo' => 'foto4.jpeg', 'titulo' => 'Perfilado de Barba'],
                ['archivo' => 'foto5.jpeg', 'titulo' => 'Corte Texturizado'],
                ['archivo' => 'foto6.jpeg', 'titulo' => 'Estilo Urbano'],
            ];
        @endphp

        @foreach($imagenes as $img)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0 bg-dark text-white">
                    <img src="{{ asset('img/galerias/' . $img['archivo']) }}" class="card-img-top" alt="Servicio de barbería" style="height: 220px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $img['titulo'] }}</h5>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection