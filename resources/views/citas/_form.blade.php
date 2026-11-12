<div class="row g-3">
    @if(!auth()->user()->isCliente())
        <div class="col-md-6">
            <label class="form-label">Cliente</label>
            <select name="cliente_id" class="form-select" required>
                <option value="">Seleccione un cliente</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ old('cliente_id', $cita->cliente_id ?? '') == $cliente->id ? 'selected' : '' }}>
                        {{ $cliente->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
    @else
        <div class="col-12">
            <div class="alert alert-info mb-0">La cita se registrará a tu nombre y quedará pendiente de confirmación.</div>
        </div>
    @endif

    <div class="col-md-6">
        <label class="form-label">Servicio</label>
        <select name="servicio_id" class="form-select" required>
            <option value="">Seleccione un servicio</option>
            @foreach($servicios as $servicio)
                <option value="{{ $servicio->id }}" {{ old('servicio_id', $cita->servicio_id ?? '') == $servicio->id ? 'selected' : '' }}>
                    {{ $servicio->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label">Fecha</label>
        <input type="date" name="fecha" class="form-control" value="{{ old('fecha', $cita->fecha ?? '') }}" required>
    </div>

    <div class="col-md-4">
        <label class="form-label">Hora</label>
        <input type="time" name="hora" class="form-control" value="{{ old('hora', $cita->hora ?? '') }}" required>
    </div>

    @if(!auth()->user()->isCliente())
        <div class="col-md-4">
            <label class="form-label">Estado</label>
            <select name="estado" class="form-select" required>
                @foreach(['pendiente', 'confirmada', 'completada', 'cancelada'] as $estado)
                    <option value="{{ $estado }}" {{ old('estado', $cita->estado ?? 'pendiente') == $estado ? 'selected' : '' }}>
                        {{ ucfirst($estado) }}
                    </option>
                @endforeach
            </select>
        </div>
    @endif

    <div class="col-12">
        <label class="form-label">Notas</label>
        <textarea name="notas" rows="3" class="form-control">{{ old('notas', $cita->notas ?? '') }}</textarea>
    </div>
</div>

<div class="mt-4 d-flex gap-2">
    <button type="submit" class="btn btn-success">
        Guardar cita
    </button>

    <a href="{{ route('citas.index') }}" class="btn btn-secondary">
        Cancelar
    </a>
</div>
