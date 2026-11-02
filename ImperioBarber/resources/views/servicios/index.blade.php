@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Gestión de Servicios</h2>

    <a href="{{ route('servicios.create') }}" class="btn btn-primary">
        Nuevo servicio
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <form method="GET" action="{{ route('servicios.index') }}" class="row g-2 mb-3">
            <div class="col-md-5">
                <input type="text" name="buscar" class="form-control"
                    placeholder="Buscar por nombre" value="{{ request('buscar') }}">
            </div>
            <div class="col-md-2">
                <input type="number" name="precio_min" class="form-control"
                    placeholder="Precio mín." min="0" value="{{ request('precio_min') }}">
            </div>
            <div class="col-md-2">
                <input type="number" name="precio_max" class="form-control"
                    placeholder="Precio máx." min="0" value="{{ request('precio_max') }}">
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Filtrar</button>
                <a href="{{ route('servicios.index') }}" class="btn btn-outline-secondary">Limpiar</a>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Duración (min)</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($servicios as $servicio)
                    <tr>
                        <td>{{ $servicio->nombre }}</td>
                        <td>{{ $servicio->descripcion }}</td>
                        <td>${{ number_format($servicio->precio, 0, ',', '.') }}</td>
                        <td>{{ $servicio->duracion_minutos }}</td>
                        <td>
                            <a href="{{ route('servicios.edit', $servicio) }}"
                                class="btn btn-warning btn-sm">
                                Editar
                            </a>

                            <form action="{{ route('servicios.destroy', $servicio) }}"
                                method="POST"
                                class="d-inline"
                                onsubmit="return confirm('¿Deseas eliminar este servicio?')">

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
                            {{ request()->hasAny(['buscar', 'precio_min', 'precio_max']) ? 'No se encontraron servicios con esos filtros.' : 'No hay servicios registrados.' }}
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $servicios->links() }}
        </div>
    </div>
</div>

@endsection