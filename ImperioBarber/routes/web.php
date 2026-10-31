<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PanelController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/registro', [RegisterController::class, 'create'])->name('register');
    Route::post('/registro', [RegisterController::class, 'store']);

    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->middleware('throttle:5,1');
});

Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::get('/cliente', [PanelController::class, 'cliente'])
        ->middleware('role:cliente')
        ->name('panel.cliente');

    Route::get('/empleado', [PanelController::class, 'empleado'])
        ->middleware('role:empleado,administrador')
        ->name('panel.empleado');

    Route::middleware('role:administrador')->prefix('admin')->group(function () {
        Route::get('/', [PanelController::class, 'admin'])->name('panel.admin');

        Route::resource('usuarios', UserController::class)
            ->except('show')
            ->parameters(['usuarios' => 'user'])
            ->names('admin.usuarios');
    });
});
