<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'ImperioBarber')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-zinc-950 text-zinc-100 antialiased">
    <nav class="border-b border-zinc-800 bg-zinc-900">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-3">
            <a href="{{ route('home') }}" class="text-xl font-bold tracking-wide text-amber-400">
                ImperioBarber
            </a>

            <div class="flex items-center gap-4 text-sm">
                @auth
                    @role('cliente')
                        <a href="{{ route('panel.cliente') }}" class="hover:text-amber-400">Mi panel</a>
                    @endrole

                    @role('empleado', 'administrador')
                        <a href="{{ route('panel.empleado') }}" class="hover:text-amber-400">Agenda</a>
                    @endrole

                    @role('administrador')
                        <a href="{{ route('panel.admin') }}" class="hover:text-amber-400">Administración</a>
                        <a href="{{ route('admin.usuarios.index') }}" class="hover:text-amber-400">Usuarios</a>
                    @endrole

                    <span class="rounded-full bg-amber-400/10 px-3 py-1 text-xs text-amber-300">
                        {{ auth()->user()->name }} · {{ auth()->user()->role->label() }}
                    </span>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="rounded bg-zinc-800 px-3 py-1 hover:bg-zinc-700">
                            Cerrar sesión
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="hover:text-amber-400">Ingresar</a>
                    <a href="{{ route('register') }}"
                       class="rounded bg-amber-400 px-3 py-1 font-semibold text-zinc-900 hover:bg-amber-300">
                        Registrarme
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="mx-auto max-w-6xl px-4 py-8">
        @if (session('status'))
            <div class="mb-6 rounded border border-emerald-600 bg-emerald-900/40 px-4 py-3 text-emerald-200">
                {{ session('status') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
