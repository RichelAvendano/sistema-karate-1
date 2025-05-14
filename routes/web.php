<?php

use App\Http\Controllers\CorreoController;
use App\Http\Controllers\DojoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Middleware\RoleMiddleware;
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
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');  

    Route::middleware('role:administrador,sensei')->group(function () {

        Route::get('/super-admin', function () {
            return view('super-admin');
        })->name('super-admin');

        Route::get('/view-admin', function () {
            return view('view-admin');
        })->name('view-admin');

        Route::get('/view-sensei', function () {
            return view('view-sensei');
        })->name('view-sensei');

        Route::get('/view-student', function () {
            return view('view-student');
        })->name('view-student');

        Route::get('/dojos', function () {
            return view('dojos');
        })->name('dojos');

        Route::get('/view-event', function () {
            return view('view-event');
        })->name('view-event');

    });

    Route::middleware('role:administrador,sensei')->group(function () {
        Route::get('/admin-event', function () {
            return view('admin-event');
        })->name('admin-event');
    });


    Route::get('/view-dojos', function () {
        return view('view-dojos');
    })->name('view-dojos');

    Route::get('/display-event', function () {
        return view('display-event');
    })->name('display-event');
});

require __DIR__.'/auth.php';
