@extends('layouts.app')

@section('title', 'Administración · ImperioBarber')

@section('content')
    <section class="panel-banner mb-4">
        <div>
            <p class="panel-eyebrow mb-2">Centro de control</p>
            <h1 class="display-5 fw-bold mb-3">Panel de administración</h1>
            <p class="lead text-white-50 mb-0">Bienvenido, {{ auth()->user()->name }}. Gestiona tu barbería desde aquí.</p>
        </div>
    </section>

    <h2 class="h4 fw-bold mb-3">Usuarios registrados</h2>
    <div class="row g-3">
        @foreach ($totales as $rol => $total)
            <div class="col-sm-6 col-lg-4">
                <div class="panel-card">
                    <p class="panel-card-muted mb-1">{{ $rol }}s</p>
                    <p class="display-6 fw-bold panel-highlight mb-0">{{ $total }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <h2 class="h4 fw-bold mt-5 mb-3">Gestión de la barbería</h2>
    <div class="row g-3">
        <div class="col-sm-6 col-lg-3">
            <a href="{{ route('admin.usuarios.index') }}" class="panel-card">
                <p class="panel-eyebrow mb-2">01</p>
                <h3 class="h5 fw-bold">Usuarios</h3>
                <p class="panel-card-muted mb-0">Administra cuentas y roles.</p>
            </a>
        </div>
        <div class="col-sm-6 col-lg-3">
            <a href="{{ route('servicios.index') }}" class="panel-card">
                <p class="panel-eyebrow mb-2">02</p>
                <h3 class="h5 fw-bold">Servicios</h3>
                <p class="panel-card-muted mb-0">Actualiza el catálogo de servicios.</p>
            </a>
        </div>
        <div class="col-sm-6 col-lg-3">
            <a href="{{ route('clientes.index') }}" class="panel-card">
                <p class="panel-eyebrow mb-2">03</p>
                <h3 class="h5 fw-bold">Clientes</h3>
                <p class="panel-card-muted mb-0">Consulta y administra clientes.</p>
            </a>
        </div>
        <div class="col-sm-6 col-lg-3">
            <a href="{{ route('citas.index') }}" class="panel-card">
                <p class="panel-eyebrow mb-2">04</p>
                <h3 class="h5 fw-bold">Citas</h3>
                <p class="panel-card-muted mb-0">Revisa y organiza la agenda.</p>
            </a>
        </div>
    </div>
@endsection
