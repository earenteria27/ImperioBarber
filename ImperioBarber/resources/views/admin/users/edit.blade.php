@extends('layouts.app')

@section('title', 'Editar usuario · ImperioBarber')

@section('content')
    <div class="mx-auto max-w-lg rounded-lg border border-zinc-800 bg-zinc-900 p-8">
        <h1 class="mb-6 text-2xl font-bold text-amber-400">Editar usuario</h1>

        <form method="POST" action="{{ route('admin.usuarios.update', $user) }}" class="space-y-4">
            @csrf
            @method('PUT')
            @include('admin.users._form')

            <div class="flex gap-3">
                <button type="submit" class="rounded bg-amber-400 px-5 py-2 font-semibold text-zinc-900 hover:bg-amber-300">Actualizar</button>
                <a href="{{ route('admin.usuarios.index') }}" class="rounded bg-zinc-800 px-5 py-2 hover:bg-zinc-700">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
