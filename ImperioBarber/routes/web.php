<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Solo para visitantes (sin sesión iniciada)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);

    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
});

// Solo con sesión iniciada
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

    // Cada rol va a su panel
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::get('/panel/cliente', [PanelController::class, 'cliente'])
        ->middleware('role:cliente')
        ->name('panel.cliente');

    Route::get('/panel/empleado', [PanelController::class, 'empleado'])
        ->middleware('role:empleado,administrador')
        ->name('panel.empleado');

    Route::get('/panel/admin', [PanelController::class, 'admin'])
        ->middleware('role:administrador')
        ->name('panel.admin');

    // Gestión de usuarios: solo administrador
    Route::prefix('admin')->name('admin.')->middleware('role:administrador')->group(function () {
        Route::resource('usuarios', UserController::class)
            ->except(['show'])
            ->parameters(['usuarios' => 'user']);
    });

    // Solo administrador y empleado
    Route::middleware('role:administrador,empleado')->group(function () {
        Route::resource('servicios', ServicioController::class)->except(['show']);
        Route::resource('clientes', ClienteController::class)->except(['show']);
        Route::get('/descargar-pdf', [ServicioController::class, 'generarPdf'])->name('servicios.pdf');
    });
});
