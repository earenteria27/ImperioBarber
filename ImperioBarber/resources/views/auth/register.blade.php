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
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input id="telefono" name="telefono" type="text" value="{{ old('telefono') }}" required
                            inputmode="numeric" pattern="[0-9]{7,15}"
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

                    <div class="form-check mb-2">
                        <input id="acepta_datos" name="acepta_datos" type="checkbox" value="1" required
                            {{ old('acepta_datos') ? 'checked' : '' }}
                            class="form-check-input @error('acepta_datos') is-invalid @enderror">
                        <label for="acepta_datos" class="form-check-label">
                            Autorizo el tratamiento de mis datos personales según la Política de Tratamiento de la Información.
                        </label>
                        @error('acepta_datos')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <details class="mb-3 small text-muted">
                        <summary class="text-dark">Ver Política de Tratamiento de la Información</summary>
                        <div class="mt-2">
                            <p class="mb-1"><strong>Responsable:</strong> ImperioBarber.</p>
                            <p class="mb-1"><strong>Datos que recolectamos:</strong> nombre, correo electrónico y teléfono.</p>
                            <p class="mb-1"><strong>Finalidad:</strong> crear tu cuenta, gestionar tus citas y contactarte sobre ellas, incluyendo recordatorios.</p>
                            <p class="mb-1"><strong>Tus derechos:</strong> como titular puedes conocer, actualizar, rectificar y solicitar la supresión de tus datos, o revocar esta autorización, según la Ley 1581 de 2012 y el Decreto 1377 de 2013.</p>
                            <p class="mb-0">Tus datos no se venden ni se comparten con terceros.</p>
                        </div>
                    </details>

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