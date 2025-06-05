<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PieceRecordController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\PieceController;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/formulario', [PieceRecordController::class, 'create'])->name('formulario');
    Route::post('/formulario', [PieceRecordController::class, 'store']);
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/reporte', [ReporteController::class, 'index'])->name('reporte');
});


Route::middleware(['auth'])->group(function () {
    Route::resource('projects', ProjectController::class);
    Route::resource('blocks', BlockController::class);
    Route::resource('pieces', PieceController::class);
});
require __DIR__.'/auth.php';
