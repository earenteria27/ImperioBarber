<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\ServicioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('inicio');
})->name('home');

Route::get('/home', function () {
    return redirect()->route('home');
});

Route::get('/galeria', function () {
    return view('admin.galerias.index');
})->name('galeria');

Route::get('/admin/galerias', function () {
    return redirect()->route('galeria');
})->name('admin.galerias');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);

    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    Route::get('/registro', [RegisterController::class, 'create'])->name('registro');
    Route::post('/registro', [RegisterController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::resource('servicios', ServicioController::class)
        ->except(['show']);

    Route::resource('citas', CitaController::class)
        ->only(['index', 'create', 'store']);

    Route::get('/descargar-pdf', [ServicioController::class, 'generarPdf'])->name('servicios.pdf');
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::get('/cliente', [PanelController::class, 'cliente'])->name('panel.cliente')->middleware('role:cliente');
    Route::get('/empleado', [PanelController::class, 'empleado'])->name('panel.empleado')->middleware('role:administrador,empleado');
    Route::get('/admin', [PanelController::class, 'admin'])->name('panel.admin')->middleware('role:administrador');

    Route::middleware('role:administrador,empleado')->group(function () {
        Route::resource('clientes', ClienteController::class)->except(['show']);
        Route::resource('citas', CitaController::class)->only(['edit', 'update', 'destroy']);
    });

    Route::prefix('admin')->name('admin.')->middleware('role:administrador')->group(function () {
        Route::resource('usuarios', UserController::class)->parameters(['usuarios' => 'user']);
    });
});