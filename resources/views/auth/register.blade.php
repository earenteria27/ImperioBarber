@extends('layouts.app')

@section('title', 'Registro · ImperioBarber')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow border-0 rounded-3">
            <div class="card-body p-4">
                <h3 class="mb-4 text-center fw-bold text-dark">Crear cuenta de cliente</h3>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label font-semibold">Nombre</label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus
                               class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required
                               class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono (opcional)</label>
                        <input id="telefono" name="telefono" type="text" value="{{ old('telefono') }}"
                               class="form-control @error('telefono') is-invalid @enderror">
                        @error('telefono')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input id="password" name="password" type="password" required
                               class="form-control @error('password') is-invalid @enderror">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                               class="form-control">
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-dark py-2 fw-bold">Registrarse</button>
                    </div>
                </form>

                <div class="mt-4 text-center">
                    <small class="text-muted">
                        ¿Ya tienes cuenta? 
                        <a href="{{ route('login') }}" class="fw-bold text-dark text-decoration-none">Ingresa</a>
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
