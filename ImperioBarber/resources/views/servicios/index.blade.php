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
                                No hay servicios registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection
