@extends('layouts.app')

@section('title', 'Nueva franja · ImperioBarber')

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-6">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h1 class="h3 mb-4">Nueva franja</h1>

                <form method="POST" action="{{ route('franjas.store') }}">
                    @csrf
                    @include('franjas._form')

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-warning">Guardar</button>
                        <a href="{{ route('franjas.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection