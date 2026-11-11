@extends('layouts.app')

@section('title', 'Citas · ImperioBarber')

@section('content')
@php
$usuario = auth()->user();
$puedeGestionar = $usuario->isAdmin() || $usuario->isEmpleado();
@endphp

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2 mb-0">
        {{ $usuario->isCliente() ? 'Mis citas' : 'Citas' }}
    </h1>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="GET" action="{{ route('citas.index') }}" class="row g-2 mb-3">
            <div class="col-12 col-md-3">
                <input type="date" name="fecha" value="{{ request('fecha') }}" class="form-control">
            </div>
            <div class="col-12 col-md-3">
                <select name="estado" class="form-select">
                    <option value="">Todos los estados</option>
                    <option value="pendiente" @selected(request('estado')==='pendiente' )>Pendiente</option>
                    <option value="confirmada" @selected(request('estado')==='confirmada' )>Confirmada</option>
                    <option value="cancelada" @selected(request('estado')==='cancelada' )>Cancelada</option>
                </select>
            </div>
            @unless ($usuario->isEmpleado())
            <div class="col-12 col-md-3">
                <select name="barbero_id" class="form-select">
                    <option value="">Todos los barberos</option>
                    @foreach ($barberos as $barbero)
                    <option value="{{ $barbero->id }}" @selected(request('barbero_id')==$barbero->id)>
                        {{ $barbero->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            @endunless
            <div class="col-12 col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Filtrar</button>
                <a href="{{ route('citas.index') }}" class="btn btn-outline-secondary">Limpiar</a>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Cliente</th>
                        <th>Servicio</th>
                        <th>Barbero</th>
                        <th>Estado</th>
                        @if ($puedeGestionar)
                        <th class="text-end">Acciones</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse ($citas as $cita)
                    <tr>
                        <td>{{ $cita->franja->fecha->format('d/m/Y') }}</td>
                        <td>{{ substr($cita->franja->hora_inicio, 0, 5) }} - {{ substr($cita->franja->hora_fin, 0, 5) }}</td>
                        <td>{{ $cita->cliente->name ?? '—' }}</td>
                        <td>{{ $cita->servicio->nombre ?? '—' }}</td>
                        <td>{{ $cita->barbero->name ?? '—' }}</td>
                        <td>
                            @php
                            $color = match ($cita->estado) {
                            'confirmada' => 'text-bg-success',
                            'cancelada' => 'text-bg-secondary',
                            default => 'text-bg-warning',
                            };
                            @endphp
                            <span class="badge {{ $color }}">{{ ucfirst($cita->estado) }}</span>
                        </td>
                        @if ($puedeGestionar)
                        <td class="text-end">
                            @if ($cita->estado === 'pendiente')
                            <form method="POST" action="{{ route('citas.confirmar', $cita) }}" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-outline-success">Confirmar</button>
                            </form>
                            @endif

                            @if ($cita->estado !== 'cancelada')
                            <form method="POST" action="{{ route('citas.cancelar', $cita) }}" class="d-inline"
                                onsubmit="return confirm('¿Cancelar esta cita?')">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Cancelar</button>
                            </form>
                            @endif
                        </td>
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{{ $puedeGestionar ? 7 : 6 }}" class="text-center text-muted py-4">
                            No hay citas programadas
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">{{ $citas->links() }}</div>
    </div>
</div>
@endsection