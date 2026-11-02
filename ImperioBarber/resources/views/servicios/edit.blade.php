@extends('layouts.app')

@section('content')

<h2 class="mb-4">Editar servicio</h2>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('servicios.update', $servicio) }}" method="POST">
            @csrf
            @method('PUT')

            @include('servicios._form')

        </form>

    </div>
</div>

@endsection
