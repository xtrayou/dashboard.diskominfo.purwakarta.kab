<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SpreadsheetLinkController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard menu routes
    Route::get('/health-monitoring', [DashboardController::class, 'healthMonitoring'])->name('health.monitoring');
    Route::get('/subdomain-status', [DashboardController::class, 'subdomainStatus'])->name('subdomain.status');
    Route::get('/server-infrastructure', [DashboardController::class, 'serverInfrastructure'])->name('server.infrastructure');
    Route::get('/realtime-monitoring', [DashboardController::class, 'realtimeMonitoring'])->name('realtime.monitoring');

    // Admin routes for spreadsheet links
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('spreadsheet-links', SpreadsheetLinkController::class);
        Route::post('spreadsheet-links/{spreadsheetLink}/test', [SpreadsheetLinkController::class, 'testConnection'])->name('spreadsheet-links.test');
    });
});

require __DIR__ . '/auth.php';
