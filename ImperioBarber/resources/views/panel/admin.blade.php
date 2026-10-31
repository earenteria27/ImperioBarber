@extends('layouts.app')

@section('title', 'Administración · ImperioBarber')

@section('content')
    <h1 class="text-3xl font-bold text-amber-400">Panel de administración</h1>

    <div class="mt-8 grid gap-4 sm:grid-cols-3">
        @foreach ($totales as $rol => $total)
            <div class="rounded-lg border border-zinc-800 bg-zinc-900 p-6">
                <p class="text-sm text-zinc-400">{{ $rol }}s</p>
                <p class="mt-1 text-3xl font-bold text-amber-400">{{ $total }}</p>
            </div>
        @endforeach
    </div>

    <a href="{{ route('admin.usuarios.index') }}"
       class="mt-8 inline-block rounded bg-amber-400 px-5 py-2 font-semibold text-zinc-900 hover:bg-amber-300">
        Gestionar usuarios
    </a>
@endsection
