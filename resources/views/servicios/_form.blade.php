<div class="mb-3">
    <label class="form-label">Nombre del servicio</label>
    <input
        type="text"
        name="nombre"
        class="form-control"
        value="{{ old('nombre', $servicio->nombre ?? '') }}"
        required
    >
</div>

<div class="mb-3">
    <label class="form-label">Descripción</label>
    <textarea
        name="descripcion"
        class="form-control"
        rows="3"
    >{{ old('descripcion', $servicio->descripcion ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">Precio</label>
    <input
        type="number"
        name="precio"
        class="form-control"
        value="{{ old('precio', $servicio->precio ?? '') }}"
        min="0"
        step="0.01"
        required
    >
</div>

<div class="mb-3">
    <label class="form-label">Duración en minutos</label>
    <input
        type="number"
        name="duracion_minutos"
        class="form-control"
        value="{{ old('duracion_minutos', $servicio->duracion_minutos ?? '') }}"
        min="1"
        required
    >
</div>

<div class="mb-3">
    <label class="form-label">Imagen del servicio</label>
    <input
        type="file"
        name="imagen"
        class="form-control"
        accept="image/*"
    >
    @if(isset($servicio) && $servicio->imagen)
        <div class="mt-2">
            <small class="text-muted">Imagen actual:</small><br>
            <img src="{{ asset('storage/' . $servicio->imagen) }}" alt="Imagen del servicio" width="100" class="rounded mt-1">
        </div>
    @endif
</div>

<button type="submit" class="btn btn-success">
    Guardar servicio
</button>

<a href="{{ route('servicios.index') }}" class="btn btn-secondary">
    Cancelar
</a>
