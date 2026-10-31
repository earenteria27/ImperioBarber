@php($editing = isset($user))

<div>
    <label for="name" class="mb-1 block text-sm">Nombre</label>
    <input id="name" name="name" type="text" value="{{ old('name', $user->name ?? '') }}" required
           class="w-full rounded border border-zinc-700 bg-zinc-800 px-3 py-2">
    @error('name') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
</div>

<div>
    <label for="email" class="mb-1 block text-sm">Correo</label>
    <input id="email" name="email" type="email" value="{{ old('email', $user->email ?? '') }}" required
           class="w-full rounded border border-zinc-700 bg-zinc-800 px-3 py-2">
    @error('email') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
</div>

<div>
    <label for="telefono" class="mb-1 block text-sm">Teléfono</label>
    <input id="telefono" name="telefono" type="text" value="{{ old('telefono', $user->telefono ?? '') }}"
           class="w-full rounded border border-zinc-700 bg-zinc-800 px-3 py-2">
    @error('telefono') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
</div>

<div>
    <label for="role" class="mb-1 block text-sm">Rol</label>
    <select id="role" name="role" required
            class="w-full rounded border border-zinc-700 bg-zinc-800 px-3 py-2">
        @foreach ($roles as $role)
            <option value="{{ $role->value }}"
                @selected(old('role', isset($user) ? $user->role->value : 'cliente') === $role->value)>
                {{ $role->label() }}
            </option>
        @endforeach
    </select>
    @error('role') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
</div>

<div>
    <label for="password" class="mb-1 block text-sm">
        Contraseña {{ $editing ? '(déjala vacía para no cambiarla)' : '' }}
    </label>
    <input id="password" name="password" type="password" {{ $editing ? '' : 'required' }}
           class="w-full rounded border border-zinc-700 bg-zinc-800 px-3 py-2">
    @error('password') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
</div>

<div>
    <label for="password_confirmation" class="mb-1 block text-sm">Confirmar contraseña</label>
    <input id="password_confirmation" name="password_confirmation" type="password" {{ $editing ? '' : 'required' }}
           class="w-full rounded border border-zinc-700 bg-zinc-800 px-3 py-2">
</div>
