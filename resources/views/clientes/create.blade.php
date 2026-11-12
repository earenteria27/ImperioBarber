@extends('layouts.app')

@section('content')

<h2 class="mb-4">Registrar nuevo cliente</h2>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('clientes.store') }}" method="POST">
            @csrf

            @include('clientes._form')

        </form>

    </div>
</div>

@endsection
