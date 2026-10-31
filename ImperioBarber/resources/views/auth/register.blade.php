@extends('layouts.app')

@section('title', 'Registro · ImperioBarber')

@section('content')
    <div class="mx-auto max-w-md rounded-lg border border-zinc-800 bg-zinc-900 p-8">
        <h1 class="mb-6 text-2xl font-bold text-amber-400">Crear cuenta de cliente</h1>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="mb-1 block text-sm">Nombre</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus
                       class="w-full rounded border border-zinc-700 bg-zinc-800 px-3 py-2">
                @error('name') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="email" class="mb-1 block text-sm">Correo</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required
                       class="w-full rounded border border-zinc-700 bg-zinc-800 px-3 py-2">
                @error('email') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="telefono" class="mb-1 block text-sm">Teléfono (opcional)</label>
                <input id="telefono" name="telefono" type="text" value="{{ old('telefono') }}"
                       class="w-full rounded border border-zinc-700 bg-zinc-800 px-3 py-2">
                @error('telefono') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="password" class="mb-1 block text-sm">Contraseña</label>
                <input id="password" name="password" type="password" required
                       class="w-full rounded border border-zinc-700 bg-zinc-800 px-3 py-2">
                @error('password') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="password_confirmation" class="mb-1 block text-sm">Confirmar contraseña</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required
                       class="w-full rounded border border-zinc-700 bg-zinc-800 px-3 py-2">
            </div>

            <button type="submit"
                    class="w-full rounded bg-amber-400 py-2 font-semibold text-zinc-900 hover:bg-amber-300">
                Registrarme
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-zinc-400">
            ¿Ya tienes cuenta?
            <a href="{{ route('login') }}" class="text-amber-400 hover:underline">Ingresa</a>
        </p>
    </div>
@endsection
