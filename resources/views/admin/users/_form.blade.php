@php($editing = isset($user))

<div class="row g-3">
    <div class="col-md-6">
        <label for="name" class="form-label">Nombre</label>
        <input id="name" name="name" type="text" value="{{ old('name', $user->name ?? '') }}" required
               class="form-control bg-dark text-white border-secondary">
        @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label for="email" class="form-label">Correo</label>
        <input id="email" name="email" type="email" value="{{ old('email', $user->email ?? '') }}" required
               class="form-control bg-dark text-white border-secondary">
        @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label for="telefono" class="form-label">Teléfono</label>
        <input id="telefono" name="telefono" type="text" value="{{ old('telefono', $user->telefono ?? '') }}"
               class="form-control bg-dark text-white border-secondary">
        @error('telefono') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label for="role" class="form-label">Rol</label>
        <select id="role" name="role" required class="form-select bg-dark text-white border-secondary">
            @foreach ($roles as $role)
                <option value="{{ $role->value }}"
                    @selected(old('role', isset($user) ? $user->role->value : 'cliente') === $role->value)>
                    {{ $role->label() }}
                </option>
            @endforeach
        </select>
        @error('role') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label for="password" class="form-label">
            Contraseña {{ $editing ? '(opcional para conservar la actual)' : '' }}
        </label>
        <input id="password" name="password" type="password" {{ $editing ? '' : 'required' }}
               class="form-control bg-dark text-white border-secondary">
        @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
        <input id="password_confirmation" name="password_confirmation" type="password" {{ $editing ? '' : 'required' }}
               class="form-control bg-dark text-white border-secondary">
    </div>
</div>
