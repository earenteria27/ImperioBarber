@extends('layouts.app')

@section('title', 'Agenda · ImperioBarber')

@section('content')
    <h1 class="text-3xl font-bold text-amber-400">Panel de empleado</h1>
    <p class="mt-2 text-zinc-300">Bienvenido, {{ auth()->user()->name }}. Aquí verás la agenda de citas.</p>

    <div class="mt-8 rounded-lg border border-zinc-800 bg-zinc-900 p-6 text-zinc-400">
        Aquí irá la agenda de citas (próximo módulo).
    </div>
@endsection
