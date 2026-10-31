@extends('layouts.app')

@section('title', 'Ingresar · ImperioBarber')

@section('content')
    <div class="mx-auto max-w-md rounded-lg border border-zinc-800 bg-zinc-900 p-8">
        <h1 class="mb-6 text-2xl font-bold text-amber-400">Iniciar sesión</h1>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="mb-1 block text-sm">Correo</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                       class="w-full rounded border border-zinc-700 bg-zinc-800 px-3 py-2">
                @error('email') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="password" class="mb-1 block text-sm">Contraseña</label>
                <input id="password" name="password" type="password" required
                       class="w-full rounded border border-zinc-700 bg-zinc-800 px-3 py-2">
                @error('password') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
            </div>

            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="remember" class="rounded"> Recordarme
            </label>

            <button type="submit"
                    class="w-full rounded bg-amber-400 py-2 font-semibold text-zinc-900 hover:bg-amber-300">
                Ingresar
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-zinc-400">
            ¿No tienes cuenta?
            <a href="{{ route('register') }}" class="text-amber-400 hover:underline">Regístrate</a>
        </p>
    </div>
@endsection
