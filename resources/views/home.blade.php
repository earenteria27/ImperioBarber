@extends('layouts.app')

@section('title', 'ImperioBarber')

@section('content')
    <section class="py-16 text-center">
        <h1 class="text-5xl font-extrabold text-amber-400">ImperioBarber</h1>
        <p class="mx-auto mt-4 max-w-xl text-zinc-300">
            Reserva tus servicios de barbería desde un solo lugar.
        </p>

        @guest
            <div class="mt-8 flex justify-center gap-4">
                <a href="{{ route('login') }}"
                   class="rounded bg-amber-400 px-5 py-2 font-semibold text-zinc-900 hover:bg-amber-300">Ingresar</a>
                <a href="{{ route('register') }}"
                   class="rounded border border-amber-400 px-5 py-2 font-semibold text-amber-400 hover:bg-amber-400/10">Crear cuenta</a>
            </div>
        @else
            <a href="{{ route('dashboard') }}"
               class="mt-8 inline-block rounded bg-amber-400 px-5 py-2 font-semibold text-zinc-900 hover:bg-amber-300">
                Ir a mi panel
            </a>
        @endguest
    </section>
@endsection
