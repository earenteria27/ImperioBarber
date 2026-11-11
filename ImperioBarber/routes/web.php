<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('servicios', ServicioController::class)
    ->except(['show']);

Route::resource('clientes', ClienteController::class)
    ->except(['show']);

// Ruta para descargar el PDF de servicios
Route::get('/descargar-pdf', [ServicioController::class, 'generarPdf'])->name('servicios.pdf');
// Rutas para el Login
Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

// Rutas para el Registro
Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
