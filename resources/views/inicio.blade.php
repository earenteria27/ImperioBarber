@extends('layouts.app')

@section('content')
<style>
    .inicio-hero {
        background: linear-gradient(120deg, rgba(10, 10, 10, .96), rgba(32, 24, 15, .84)),
            url('{{ asset('img/galerias/Barberia.jpeg') }}') center 45% / cover;
        color: #fff;
        border-radius: 1rem;
        min-height: 340px;
        display: flex;
        align-items: center;
    }

    .inicio-hero h1 span {
        color: #d6a64f;
    }

    .inicio-eyebrow {
        letter-spacing: .16em;
        text-transform: uppercase;
        color: #e2b45f;
        font-size: .8rem;
        font-weight: 700;
    }
 </style>

<section class="inicio-hero p-4 p-md-5 mb-5">
    <div class="col-lg-8">
        <p class="inicio-eyebrow mb-3">Tradición, estilo y precisión</p>
        <h1 class="display-4 fw-bold mb-3">Bienvenido a <span>ImperioBarber</span></h1>
        <p class="lead text-white-50 mb-4">
            Conoce nuestro espacio y descubre los estilos que podemos crear para ti.
        </p>
        <a href="#galeria" class="btn btn-warning btn-lg fw-semibold">Ver galería</a>
        @guest
            <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg ms-2">Crear cuenta</a>
        @endguest
    </div>
</section>

<section id="galeria" class="pb-4">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4">
        <div>
            <p class="inicio-eyebrow mb-2">Nuestro trabajo</p>
            <h2 class="fw-bold mb-0">Galería de servicios y estilos</h2>
        </div>
        @guest
            <p class="text-muted mb-0 mt-2 mt-md-0">Inicia sesión o regístrate para acceder a las herramientas de gestión.</p>
        @endguest
    </div>

    @include('admin.galerias._grid')
</section>
@endsection
