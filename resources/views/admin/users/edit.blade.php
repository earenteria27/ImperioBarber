@extends('layouts.app')

@section('title', 'Editar usuario · ImperioBarber')

@section('content')
    <section class="panel-banner mb-4">
        <div>
            <p class="panel-eyebrow mb-2">Administración</p>
            <h1 class="display-5 fw-bold mb-2">Editar usuario</h1>
            <p class="lead text-white-50 mb-0">Actualiza la información de {{ $user->name }}.</p>
        </div>
    </section>

    <div class="card bg-dark border-secondary text-white shadow-sm mx-auto" style="max-width: 860px;">
        <form method="POST" action="{{ route('admin.usuarios.update', $user) }}">
            @csrf
            @method('PUT')
            <div class="card-body p-4 p-md-5">
                @include('admin.users._form')
            </div>
            <div class="card-footer border-secondary d-flex gap-2 p-3">
                <button type="submit" class="btn btn-imperio">Guardar cambios</button>
                <a href="{{ route('admin.usuarios.index') }}" class="btn btn-outline-light">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
