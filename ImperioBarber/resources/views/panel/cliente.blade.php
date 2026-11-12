@extends('layouts.app')

@section('title', 'Mi panel · ImperioBarber')

@section('content')
<h1 class="h2">Hola, {{ auth()->user()->name }}</h1>
<p class="text-muted">Desde aquí podrás reservar y consultar tus citas.</p>

<div class="card shadow-sm mt-4">
    <div class="card-body text-muted">
        Aquí irán tus servicios y citas (próximo módulo).
    </div>
</div>
@endsection