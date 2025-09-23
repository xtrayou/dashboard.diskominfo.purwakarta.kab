<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Admin routes
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/upload', [AdminController::class, 'upload'])->name('upload');
        Route::post('/import', [AdminController::class, 'import'])->name('import');
        Route::delete('/domains/{domain}', [AdminController::class, 'destroy'])->name('domains.destroy');
    });
});

require __DIR__ . '/auth.php';
