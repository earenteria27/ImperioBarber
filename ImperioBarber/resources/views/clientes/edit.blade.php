@extends('layouts.app')

@section('content')

<h2 class="mb-4">Editar cliente</h2>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('clientes.update', $cliente) }}" method="POST">
            @csrf
            @method('PUT')

            @include('clientes._form')

        </form>

    </div>
</div>

@endsection
