@extends('layouts.app')

@section('title', 'Agenda · ImperioBarber')

@section('content')
<h1 class="h2">Panel de empleado</h1>
<p class="text-muted">Bienvenido, {{ auth()->user()->name }}. Aquí verás la agenda de citas.</p>

<div class="card shadow-sm mt-4">
    <div class="card-body text-muted">
        Aquí irá la agenda de citas (próximo módulo).
    </div>
</div>
@endsection