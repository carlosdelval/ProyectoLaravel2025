<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\AdminClientesController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/users', function () {
    return view('users.index');
})->middleware('auth')->name('users.index');

Route::get('/users/{user}', [UserController::class, 'show'])
    ->middleware('auth')
    ->name('users.show');

Route::get('/reservar', [CitaController::class, 'create'])
    ->middleware('auth')
    ->name('user.reserva');

Route::post('/reservar', [CitaController::class, 'store'])
    ->middleware('auth')
    ->name('user.reserva.store');

Route::get('/dashboard', [CitaController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

Route::delete('/citas/{id}', [CitaController::class, 'destroy'])
    ->middleware('auth')
    ->name('citas.destroy');

Route::middleware(['auth'])->prefix('admin/citas')->name('admin.citas.')->group(function () {
    Route::get('/{cita}/editar', [CitaController::class, 'edit'])->name('edit'); // Formulario de edición
    Route::put('/{cita}', [CitaController::class, 'update'])->name('update'); // Actualizar la cita
});

Route::middleware(['auth'])->group(function () {
    Route::get('admin/usuarios', [AdminClientesController::class, 'index'])->name('admin.clientes');
    Route::get('admin/usuarios/{user}/editar', [AdminClientesController::class, 'edit'])->name('admin.usuarios.editar');
    Route::get('admin/usuarios/{user}/historial', [AdminClientesController::class, 'historial'])->name('admin.usuarios.historial');
});

Route::middleware(['auth'])->group(function(){
    Route::get('admin/historial', [AdminClientesController::class, 'index'])->name('admin.historial');
    Route::get('admin/historial/{historialVista}/borrar', [AdminClientesController::class, 'index'])->name('admin.historial.destroy');
    Route::put('admin/historial/{historialVista}/editar', [AdminClientesController::class, 'index'])->name('admin.historial.edit');

});


require __DIR__ . '/auth.php';
