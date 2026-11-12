@extends('layouts.app')

@section('title', 'Nuevo usuario · ImperioBarber')

@section('content')
    <section class="panel-banner mb-4">
        <div>
            <p class="panel-eyebrow mb-2">Administración</p>
            <h1 class="display-5 fw-bold mb-2">Nuevo usuario</h1>
            <p class="lead text-white-50 mb-0">Crea una cuenta y asigna el rol correspondiente.</p>
        </div>
    </section>

    <div class="card bg-dark border-secondary text-white shadow-sm mx-auto" style="max-width: 860px;">
        <form method="POST" action="{{ route('admin.usuarios.store') }}">
            @csrf
            <div class="card-body p-4 p-md-5">
                @include('admin.users._form')
            </div>
            <div class="card-footer border-secondary d-flex gap-2 p-3">
                <button type="submit" class="btn btn-imperio">Guardar usuario</button>
                <a href="{{ route('admin.usuarios.index') }}" class="btn btn-outline-light">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
