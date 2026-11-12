@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Agenda de citas</h2>

    <a href="{{ route('citas.create') }}" class="btn btn-primary">
        Nueva cita
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Cliente</th>
                        <th>Servicio</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Estado</th>
                        <th>Notas</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($citas as $cita)
                        <tr>
                            <td>{{ $cita->cliente->nombre }}</td>
                            <td>{{ $cita->servicio->nombre }}</td>
                            <td>{{ \Carbon\Carbon::parse($cita->fecha)->translatedFormat('d/m/Y') }}</td>
                            <td>{{ $cita->hora }}</td>
                            <td>
                                <span class="badge bg-{{ $cita->estado === 'pendiente' ? 'warning text-dark' : ($cita->estado === 'confirmada' ? 'primary' : ($cita->estado === 'completada' ? 'success' : 'secondary')) }}">
                                    {{ ucfirst($cita->estado) }}
                                </span>
                            </td>
                            <td>{{ $cita->notas ?: 'Sin notas' }}</td>
                            <td>
                                @if(!auth()->user()->isCliente())
                                    <a href="{{ route('citas.edit', $cita) }}" class="btn btn-warning btn-sm">
                                        Editar
                                    </a>

                                    <form action="{{ route('citas.destroy', $cita) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Deseas eliminar esta cita?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Eliminar
                                        </button>
                                    </form>
                                @else
                                    <span class="text-muted">Solo lectura</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                No hay citas agendadas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $citas->links() }}
        </div>
    </div>
</div>

@endsection
