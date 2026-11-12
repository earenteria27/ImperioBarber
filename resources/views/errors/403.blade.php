@extends('layouts.app')

@section('title', 'Acceso denegado · ImperioBarber')

@section('content')
    <div class="py-16 text-center">
        <p class="text-6xl font-extrabold text-amber-400">403</p>
        <h1 class="mt-4 text-2xl font-bold">Acceso denegado</h1>
        <p class="mt-2 text-zinc-400">No tienes permiso para ver esta página.</p>
        @auth
            <a href="{{ route('dashboard') }}"
               class="mt-6 inline-block rounded bg-amber-400 px-5 py-2 font-semibold text-zinc-900 hover:bg-amber-300">
                Volver a mi panel
            </a>
        @endauth
    </div>
@endsection
