<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\Admin\PeliculasController; 
use App\Http\Controllers\Admin\UserController; 

Route::get('/', function () {
    return view('welcome');
});

// Ruta del dashboard de USUARIO NORMAL
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/catalog', function () {
    return view('catalog');
})->name('catalog');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Carga rutas de login, register, logout, etc.
require __DIR__.'/auth.php';


Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // 1. Dashboard de admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard'); 
    })->name('dashboard');

    // 2. CRUD de Películas 
    Route::resource('peliculas', PeliculasController::class);

    // 3. Rutas de Usuario 
    Route::get('users', [UserController::class, 'index'])->name('users.index'); 
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy'); 
    Route::patch('users/{user}/toggle-admin', [UserController::class, 'toggleAdmin'])->name('users.toggleAdmin');
});