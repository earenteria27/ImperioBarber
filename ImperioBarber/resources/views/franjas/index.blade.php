@extends('layouts.app')

@section('title', 'Franjas horarias · ImperioBarber')

@section('content')


<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2 mb-0">Franjas horarias</h1>
    <a href="{{ route('franjas.create') }}" class="btn btn-warning">Nueva franja</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="GET" action="{{ route('franjas.index') }}" class="row g-2 mb-3">
            <div class="col-12 col-md-4">
                <select name="barbero_id" class="form-select">
                    <option value="">Todos los barberos</option>
                    @foreach ($barberos as $barbero)
                    <option value="{{ $barbero->id }}" @selected(request('barbero_id')==$barbero->id)>
                        {{ $barbero->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-md-3">
                <input type="date" name="fecha" value="{{ request('fecha') }}" class="form-control">
            </div>
            <div class="col-12 col-md-3">
                <select name="estado" class="form-select">
                    <option value="">Todos los estados</option>
                    <option value="disponible" @selected(request('estado')==='disponible' )>Disponible</option>
                    <option value="ocupada" @selected(request('estado')==='ocupada' )>Ocupada</option>
                </select>
            </div>
            <div class="col-12 col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Filtrar</button>
                <a href="{{ route('franjas.index') }}" class="btn btn-outline-secondary">Limpiar</a>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Barbero</th>
                        <th>Fecha</th>
                        <th>Hora inicio</th>
                        <th>Hora fin</th>
                        <th>Estado</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($franjas as $franja)
                    <tr>
                        <td>{{ $franja->barbero->name ?? '—' }}</td>
                        <td>{{ $franja->fecha->format('d/m/Y') }}</td>
                        <td>{{ substr($franja->hora_inicio, 0, 5) }}</td>
                        <td>{{ substr($franja->hora_fin, 0, 5) }}</td>
                        <td>
                            <span class="badge {{ $franja->estado === 'disponible' ? 'text-bg-success' : 'text-bg-secondary' }}">
                                {{ ucfirst($franja->estado) }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('franjas.edit', $franja) }}"
                                class="btn btn-sm btn-outline-secondary">Editar</a>
                            <form method="POST" action="{{ route('franjas.destroy', $franja) }}"
                                class="d-inline"
                                onsubmit="return confirm('¿Eliminar esta franja?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">No hay registros</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">{{ $franjas->links() }}</div>
    </div>
</div>
@endsection