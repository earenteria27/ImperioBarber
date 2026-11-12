@php($editing = isset($franja))

<div class="mb-3">
    <label for="barbero_id" class="form-label">Barbero</label>
    <select id="barbero_id" name="barbero_id" required
        class="form-select @error('barbero_id') is-invalid @enderror">
        <option value="">Selecciona un barbero</option>
        @foreach ($barberos as $barbero)
        <option value="{{ $barbero->id }}"
            @selected(old('barbero_id', $franja->barbero_id ?? '') == $barbero->id)>
            {{ $barbero->name }}
        </option>
        @endforeach
    </select>
    @error('barbero_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="fecha" class="form-label">Fecha</label>
    <input id="fecha" name="fecha" type="date" required
        value="{{ old('fecha', $editing ? $franja->fecha->format('Y-m-d') : '') }}"
        class="form-control @error('fecha') is-invalid @enderror">
    @error('fecha') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="row">
    <div class="col-6 mb-3">
        <label for="hora_inicio" class="form-label">Hora de inicio</label>
        <input id="hora_inicio" name="hora_inicio" type="time" required
            value="{{ old('hora_inicio', $editing ? substr($franja->hora_inicio, 0, 5) : '') }}"
            class="form-control @error('hora_inicio') is-invalid @enderror">
        @error('hora_inicio') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-6 mb-3">
        <label for="hora_fin" class="form-label">Hora de fin</label>
        <input id="hora_fin" name="hora_fin" type="time" required
            value="{{ old('hora_fin', $editing ? substr($franja->hora_fin, 0, 5) : '') }}"
            class="form-control @error('hora_fin') is-invalid @enderror">
        @error('hora_fin') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

@if ($editing)
<div class="mb-3">
    <label for="estado" class="form-label">Estado</label>
    <select id="estado" name="estado" required
        class="form-select @error('estado') is-invalid @enderror">
        <option value="disponible" @selected(old('estado', $franja->estado) === 'disponible')>Disponible</option>
        <option value="ocupada" @selected(old('estado', $franja->estado) === 'ocupada')>Ocupada</option>
    </select>
    @error('estado') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
@endif