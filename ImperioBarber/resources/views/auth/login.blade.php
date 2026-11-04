@extends('layouts.app')

@section('title', 'Iniciar Sesión · ImperioBarber')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5 col-lg-4">
        <div class="card shadow border-0 rounded-3">
            <div class="card-body p-4">
                <h3 class="mb-4 text-center fw-bold text-dark">Iniciar sesión</h3>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                               class="form-control @error('email') is-invalid @enderror">
                        @error('email')
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

                    <div class="form-check mb-3">
                        <input type="checkbox" name="remember" id="remember" class="form-check-input">
                        <label for="remember" class="form-check-label">Recordarme</label>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-dark py-2 fw-bold">Ingresar</button>
                    </div>
                </form>

                <div class="mt-4 text-center">
                    <small class="text-muted">
                        ¿No tienes cuenta? 
                        <a href="{{ route('register') }}" class="fw-bold text-dark text-decoration-none">Regístrate</a>
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
