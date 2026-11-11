@extends('layouts.app')

@section('title', 'Usuarios · ImperioBarber')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-3xl font-bold text-amber-400">Usuarios</h1>
        @can('create', App\Models\User::class)
            <a href="{{ route('admin.usuarios.create') }}"
               class="rounded bg-amber-400 px-4 py-2 font-semibold text-zinc-900 hover:bg-amber-300">
                Nuevo usuario
            </a>
        @endcan
    </div>

    <div class="overflow-x-auto rounded-lg border border-zinc-800">
        <table class="w-full text-left text-sm">
            <thead class="bg-zinc-900 text-zinc-400">
                <tr>
                    <th class="px-4 py-3">Nombre</th>
                    <th class="px-4 py-3">Correo</th>
                    <th class="px-4 py-3">Teléfono</th>
                    <th class="px-4 py-3">Rol</th>
                    <th class="px-4 py-3 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-800">
                @foreach ($users as $user)
                    <tr>
                        <td class="px-4 py-3">{{ $user->name }}</td>
                        <td class="px-4 py-3">{{ $user->email }}</td>
                        <td class="px-4 py-3">{{ $user->telefono ?? '—' }}</td>
                        <td class="px-4 py-3">
                            <span class="rounded-full bg-amber-400/10 px-2 py-1 text-xs text-amber-300">
                                {{ $user->role->label() }}
                            </span>
                        </td>
                        <td class="flex justify-end gap-3 px-4 py-3">
                            @can('update', $user)
                                <a href="{{ route('admin.usuarios.edit', $user) }}" class="text-amber-400 hover:underline">Editar</a>
                            @endcan

                            @can('delete', $user)
                                <form method="POST" action="{{ route('admin.usuarios.destroy', $user) }}"
                                      onsubmit="return confirm('¿Eliminar a {{ $user->name }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:underline">Eliminar</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $users->links() }}</div>
@endsection
