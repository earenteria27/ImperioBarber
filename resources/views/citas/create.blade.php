@extends('layouts.app')

@section('content')

<h2 class="mb-4">Registrar nueva cita</h2>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('citas.store') }}" method="POST">
            @csrf

            @include('citas._form')
        </form>

    </div>
</div>

@endsection
