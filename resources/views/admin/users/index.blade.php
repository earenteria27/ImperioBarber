@extends('layouts.app')

@section('title', 'Usuarios · ImperioBarber')

@section('content')
    <section class="panel-banner mb-4">
        <div class="w-100 d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3">
            <div>
                <p class="panel-eyebrow mb-2">Administración</p>
                <h1 class="display-5 fw-bold mb-2">Gestión de usuarios</h1>
                <p class="lead text-white-50 mb-0">Administra las cuentas y los roles de ImperioBarber.</p>
            </div>
        @can('create', App\Models\User::class)
            <a href="{{ route('admin.usuarios.create') }}" class="btn btn-imperio">
                Nuevo usuario
            </a>
        @endcan
        </div>
    </section>

    <div class="card bg-dark border-secondary text-white shadow-sm">
        <div class="card-header border-secondary d-flex justify-content-between align-items-center py-3">
            <h2 class="h5 mb-0">Directorio de usuarios</h2>
            <span class="badge rounded-pill bg-warning text-dark">{{ $users->total() }} registrados</span>
        </div>
        <div class="table-responsive">
            <table class="table table-dark table-hover align-middle mb-0">
                <thead>
                <tr>
                    <th class="px-3 py-3">Nombre</th>
                    <th class="px-3 py-3">Correo</th>
                    <th class="px-3 py-3">Teléfono</th>
                    <th class="px-3 py-3">Rol</th>
                    <th class="px-3 py-3 text-end">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td class="px-3 py-3 fw-semibold">{{ $user->name }}</td>
                        <td class="px-3 py-3">{{ $user->email }}</td>
                        <td class="px-3 py-3">{{ $user->telefono ?? '—' }}</td>
                        <td class="px-3 py-3">
                            <span class="badge rounded-pill bg-warning text-dark">
                                {{ $user->role->label() }}
                            </span>
                        </td>
                        <td class="px-3 py-3 text-end text-nowrap">
                            @can('update', $user)
                                <a href="{{ route('admin.usuarios.edit', $user) }}" class="btn btn-sm btn-outline-warning me-1">Editar</a>
                            @endcan

                            @can('delete', $user)
                                <form method="POST" action="{{ route('admin.usuarios.destroy', $user) }}"
                                      class="d-inline" onsubmit="return confirm('¿Eliminar a {{ $user->name }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-white-50 py-4">No hay usuarios registrados.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">{{ $users->links('pagination::bootstrap-5') }}</div>
@endsection
