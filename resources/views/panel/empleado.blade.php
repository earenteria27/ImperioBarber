@extends('layouts.app')

@section('title', 'Agenda · ImperioBarber')

@section('content')
    <section class="panel-banner mb-4">
        <div>
            <p class="panel-eyebrow mb-2">Panel de empleado</p>
            <h1 class="display-5 fw-bold mb-3">Bienvenido, <span class="panel-highlight">{{ auth()->user()->name }}</span></h1>
            <p class="lead text-white-50 mb-4">Todo listo para ofrecer una gran experiencia a cada cliente.</p>
            <a href="{{ route('citas.index') }}" class="btn btn-imperio btn-lg">Abrir agenda</a>
        </div>
    </section>

    <div class="row g-4">
        <div class="col-md-6">
            <a href="{{ route('citas.index') }}" class="panel-card">
                <p class="panel-eyebrow mb-2">01 · Agenda</p>
                <h2 class="h4 fw-bold">Citas</h2>
                <p class="panel-card-muted mb-0">Consulta y administra las citas agendadas.</p>
            </a>
        </div>
        <div class="col-md-6">
            <a href="{{ route('servicios.index') }}" class="panel-card">
                <p class="panel-eyebrow mb-2">02 · Servicios</p>
                <h2 class="h4 fw-bold">Servicios disponibles</h2>
                <p class="panel-card-muted mb-0">Revisa los servicios y sus duraciones.</p>
            </a>
        </div>
    </div>
@endsection
