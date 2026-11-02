@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Gestión de Clientes</h2>

    <a href="{{ route('clientes.create') }}" class="btn btn-primary">
        Nuevo cliente
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <form method="GET" action="{{ route('clientes.index') }}" class="row g-2 mb-3">
            <div class="col-md-9">
                <input type="text" name="buscar" class="form-control"
                    placeholder="Buscar por nombre, teléfono o correo"
                    value="{{ request('buscar') }}">
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Filtrar</button>
                <a href="{{ route('clientes.index') }}" class="btn btn-outline-secondary">Limpiar</a>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Correo electrónico</th>
                        <th>Notas</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->nombre }}</td>
                        <td>{{ $cliente->telefono }}</td>
                        <td>{{ $cliente->email ?? 'No registrado' }}</td>
                        <td>{{ $cliente->notas ?? 'Sin notas' }}</td>
                        <td>
                            <a href="{{ route('clientes.edit', $cliente) }}"
                                class="btn btn-warning btn-sm">
                                Editar
                            </a>

                            <form action="{{ route('clientes.destroy', $cliente) }}"
                                method="POST"
                                class="d-inline"
                                onsubmit="return confirm('¿Deseas eliminar este cliente?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger btn-sm">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            {{ request()->filled('buscar') ? 'No se encontraron clientes con esa búsqueda.' : 'No hay clientes registrados.' }}
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $clientes->links() }}
        </div>

    </div>
</div>

@endsection