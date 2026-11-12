@extends('layouts.app')

@section('content')

<h2 class="mb-4">Editar cita</h2>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('citas.update', $cita) }}" method="POST">
            @csrf
            @method('PUT')

            @include('citas._form')
        </form>

    </div>
</div>

@endsection
