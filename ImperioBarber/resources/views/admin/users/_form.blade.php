@php($editing = isset($user))

<div class="mb-3">
    <label for="name" class="form-label">Nombre</label>
    <input id="name" name="name" type="text" required
        value="{{ old('name', $user->name ?? '') }}"
        class="form-control @error('name') is-invalid @enderror">
    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="email" class="form-label">Correo</label>
    <input id="email" name="email" type="email" required
        value="{{ old('email', $user->email ?? '') }}"
        class="form-control @error('email') is-invalid @enderror">
    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="telefono" class="form-label">Teléfono</label>
    <input id="telefono" name="telefono" type="text"
        value="{{ old('telefono', $user->telefono ?? '') }}"
        class="form-control @error('telefono') is-invalid @enderror">
    @error('telefono') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="role" class="form-label">Rol</label>
    <select id="role" name="role" required
        class="form-select @error('role') is-invalid @enderror">
        @foreach ($roles as $role)
        <option value="{{ $role->value }}"
            @selected(old('role', isset($user) ? $user->role->value : 'cliente') === $role->value)>
            {{ $role->label() }}
        </option>
        @endforeach
    </select>
    @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="password" class="form-label">
        Contraseña {{ $editing ? '(déjala vacía para no cambiarla)' : '' }}
    </label>
    <input id="password" name="password" type="password" {{ $editing ? '' : 'required' }}
        class="form-control @error('password') is-invalid @enderror">
    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
    <input id="password_confirmation" name="password_confirmation" type="password"
        {{ $editing ? '' : 'required' }} class="form-control">
</div>