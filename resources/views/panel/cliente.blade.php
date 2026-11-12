@extends('layouts.app')

@section('title', 'Mi panel · ImperioBarber')

@section('content')
    <section class="panel-banner mb-4">
        <div>
            <p class="panel-eyebrow mb-2">Panel de cliente</p>
            <h1 class="display-5 fw-bold mb-3">Hola, <span class="panel-highlight">{{ auth()->user()->name }}</span></h1>
            <p class="lead text-white-50 mb-4">Tu próximo estilo empieza con una buena cita.</p>
            <a href="{{ route('citas.create') }}" class="btn btn-imperio btn-lg">Agendar cita</a>
        </div>
    </section>

    <div class="row g-4">
        <div class="col-md-6">
            <a href="{{ route('servicios.index') }}" class="panel-card">
                <p class="panel-eyebrow mb-2">01 · Descubre</p>
                <h2 class="h4 fw-bold">Nuestros servicios</h2>
                <p class="panel-card-muted mb-0">Conoce los servicios disponibles en ImperioBarber.</p>
            </a>
        </div>
        <div class="col-md-6">
            <a href="{{ route('citas.index') }}" class="panel-card">
                <p class="panel-eyebrow mb-2">02 · Organiza</p>
                <h2 class="h4 fw-bold">Agenda de citas</h2>
                <p class="panel-card-muted mb-0">Consulta las citas y elige cuándo visitarnos.</p>
            </a>
        </div>
    </div>
@endsection
