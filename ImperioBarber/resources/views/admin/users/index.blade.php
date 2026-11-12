@extends('layouts.app')

@section('title', 'Usuarios · ImperioBarber')

@section('content')
@if (session('status'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('status') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
</div>
@endif
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2 mb-0">Usuarios</h1>
    @can('create', App\Models\User::class)
    <a href="{{ route('admin.usuarios.create') }}" class="btn btn-warning">Nuevo usuario</a>
    @endcan
</div>



<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Rol</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->telefono ?? '—' }}</td>
                    <td>
                        <span class="badge text-bg-warning">{{ $user->role->label() }}</span>
                    </td>
                    <td class="text-end">
                        @can('update', $user)
                        <a href="{{ route('admin.usuarios.edit', $user) }}"
                            class="btn btn-sm btn-outline-secondary">Editar</a>
                        @endcan
                        @can('update', $user)
                        @if (! $user->is(auth()->user()))
                        <form method="POST" action="{{ route('admin.usuarios.activo', $user) }}" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                class="btn btn-sm {{ $user->activo ? 'btn-outline-warning' : 'btn-outline-success' }}">
                                {{ $user->activo ? 'Desactivar' : 'Activar' }}
                            </button>
                        </form>
                        @endif
                        @endcan

                        @can('delete', $user)
                        <form method="POST" action="{{ route('admin.usuarios.destroy', $user) }}"
                            class="d-inline"
                            onsubmit="return confirm('¿Eliminar a {{ $user->name }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                        </form>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">{{ $users->links() }}</div>
@endsection