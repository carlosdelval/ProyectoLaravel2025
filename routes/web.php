<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\AdminClientesController;
use App\Http\Controllers\HistorialVistaController;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

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

Route::post('/notificaciones/leidas', [UserController::class, 'marcarNotificacionesLeidas'])->name('notificaciones.leer');


Route::middleware(['role:admin'])->prefix('admin/citas')->name('admin.citas.')->group(function () {
    Route::get('/{cita}/editar', [CitaController::class, 'edit'])->name('edit'); // Formulario de edición
    Route::put('/{cita}', [CitaController::class, 'update'])->name('update'); // Actualizar la cita
});

Route::middleware(['role:admin'])->group(function () {
    Route::get('admin/usuarios', [AdminClientesController::class, 'index'])->name('admin.clientes');
    Route::get('admin/usuarios/{user}/editar', [AdminClientesController::class, 'edit'])->name('admin.usuarios.editar');
    Route::get('admin/usuarios/{user}/historial', [AdminClientesController::class, 'historial'])->name('admin.usuarios.historial');
    Route::put('admin/usuarios/{user}/update', [UserController::class, 'update'])->name('admin.usuarios.update');
    Route::delete('admin/usuarios/{user}/borrar', [UserController::class, 'destroy'])->name('usuario.destroy');
});

Route::middleware(['role:admin'])->group(function () {
    Route::get('admin/historial', [AdminClientesController::class, 'index'])->name('admin.historial');
    Route::delete('admin/historial/{historialVista}/borrar', [HistorialVistaController::class, 'destroy'])->name('historial.destroy');
    Route::put('admin/historial/{historialVista}/editar', [HistorialVistaController::class, 'edit'])->name('admin.historial.edit');
});

Route::post('historial/{id}/upload-pdf', [HistorialVistaController::class, 'uploadPdf'])->name('historial.uploadPdf')->middleware(['role:admin']);
Route::get('/historial/{id}/descargar', [HistorialVistaController::class, 'descargarPDF'])->name('historial.descargar');




require __DIR__ . '/auth.php';
