<div class="mb-3">
    <label class="form-label">Nombre completo</label>
    <input
        type="text"
        name="nombre"
        class="form-control"
        value="{{ old('nombre', $cliente->nombre ?? '') }}"
        required
    >
</div>

<div class="mb-3">
    <label class="form-label">Teléfono</label>
    <input
        type="text"
        name="telefono"
        class="form-control"
        value="{{ old('telefono', $cliente->telefono ?? '') }}"
        required
    >
</div>

<div class="mb-3">
    <label class="form-label">Correo electrónico</label>
    <input
        type="email"
        name="email"
        class="form-control"
        value="{{ old('email', $cliente->email ?? '') }}"
    >
</div>

<div class="mb-3">
    <label class="form-label">Notas</label>
    <textarea
        name="notas"
        class="form-control"
        rows="3"
    >{{ old('notas', $cliente->notas ?? '') }}</textarea>
</div>

<button type="submit" class="btn btn-success">
    Guardar cliente
</button>

<a href="{{ route('clientes.index') }}" class="btn btn-secondary">
    Cancelar
</a>
