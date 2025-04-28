<?php

use App\Http\Controllers\CorreoController;
use App\Http\Controllers\DojoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Livewire\Counter;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/counter', Counter::class);

/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
 */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::get('/role', [RoleController::class, 'index'])->name('role');

    Route::get('/prueba', function () {
        return view('prueba');
    })->name('prueba');

    Route::get('/enviar-correo', [CorreoController::class, 'enviarCorreo'])->name('enviar-correo');

    Route::get('/dojos', [DojoController::class, 'index'])->name('dojos');

    Route::get('/super-admin', function () {
        return view('super-admin');
    })->name('super-admin');

    Route::get('/senseis', function () {
        return view('senseis');
    })->name('senseis');
});

require __DIR__.'/auth.php';
