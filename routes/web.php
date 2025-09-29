<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SpreadsheetLinkController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.welcome.welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Test route for Google Sheets data
Route::get('/test-sheets', [DashboardController::class, 'showSheetsData'])
    ->middleware(['auth'])
    ->name('test.sheets');

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

    // Logo guide page
    Route::get('/logo-guide', function () {
        return view('tools.logo-guide');
    })->name('logo.guide');

    // Logo background remover tool
    Route::get('/logo-background-remover', function () {
        return view('tools.logo-background-remover');
    })->name('logo.background.remover');
});

require __DIR__ . '/auth.php';
