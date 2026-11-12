@extends('layouts.app')

@section('title', 'Nuevo usuario · ImperioBarber')

@section('content')
    <div class="mx-auto max-w-lg rounded-lg border border-zinc-800 bg-zinc-900 p-8">
        <h1 class="mb-6 text-2xl font-bold text-amber-400">Nuevo usuario</h1>

        <form method="POST" action="{{ route('admin.usuarios.store') }}" class="space-y-4">
            @csrf
            @include('admin.users._form')

            <div class="flex gap-3">
                <button type="submit" class="rounded bg-amber-400 px-5 py-2 font-semibold text-zinc-900 hover:bg-amber-300">Guardar</button>
                <a href="{{ route('admin.usuarios.index') }}" class="rounded bg-zinc-800 px-5 py-2 hover:bg-zinc-700">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
