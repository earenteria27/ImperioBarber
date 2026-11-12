@extends('layouts.app')

@section('title', 'Administración · ImperioBarber')

@section('content')
@php
$plurales = [
'cliente' => 'Clientes',
'empleado' => 'Empleados',
'administrador' => 'Administradores',
];
@endphp

<h1 class="h2 mb-4">Panel de administración</h1>

<div class="row g-3">
    @foreach ($totales as $rol => $total)
    <div class="col-12 col-sm-4">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <p class="text-muted mb-1">{{ $plurales[strtolower($rol)] ?? $rol }}</p>
                <p class="display-6 fw-bold mb-0">{{ $total }}</p>
            </div>
        </div>
    </div>
    @endforeach
</div>

<a href="{{ route('admin.usuarios.index') }}" class="btn btn-warning mt-4">
    Gestionar usuarios
</a>
@endsection