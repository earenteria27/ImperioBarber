@extends('layouts.app')

@section('title', 'Mi panel · ImperioBarber')

@section('content')
    <h1 class="text-3xl font-bold text-amber-400">Hola, {{ auth()->user()->name }}</h1>
    <p class="mt-2 text-zinc-300">Desde aquí podrás reservar y consultar tus citas.</p>

    <div class="mt-8 rounded-lg border border-zinc-800 bg-zinc-900 p-6 text-zinc-400">
        Aquí irán tus servicios y citas (próximo módulo).
    </div>
@endsection
