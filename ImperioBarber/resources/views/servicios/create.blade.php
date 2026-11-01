@extends('layouts.app')

@section('content')

<h2 class="mb-4">Registrar nuevo servicio</h2>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('servicios.store') }}" method="POST">
            @csrf

            @include('servicios._form')

        </form>

    </div>
</div>

@endsection
