<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\ClienteController;

Route::get('/', function () {
    return redirect()->route('servicios.index');
});

Route::resource('servicios', ServicioController::class)
    ->except(['show']);

Route::resource('clientes', ClienteController::class)
    ->except(['show']);
