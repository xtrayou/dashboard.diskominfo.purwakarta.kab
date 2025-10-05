<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SpreadsheetLinkController;
use Illuminate\Support\Facades\Route;

// Landing page route
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Dashboard routes - accessible without login for public monitoring
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Public monitoring routes - accessible to everyone
Route::get('/health-monitoring', [DashboardController::class, 'healthMonitoring'])->name('health.monitoring');
Route::get('/subdomain-status', [DashboardController::class, 'subdomainStatus'])->name('subdomain.status');
Route::get('/server-infrastructure', [DashboardController::class, 'serverInfrastructure'])->name('server.infrastructure');
Route::get('/realtime-monitoring', [DashboardController::class, 'realtimeMonitoring'])->name('realtime.monitoring');

// Test routes for Google Sheets data (public for testing)
Route::get('/test-sheets', [DashboardController::class, 'showSheetsData'])->name('test.sheets');
Route::get('/sheet-info/{sheetName?}', [DashboardController::class, 'getSheetInfo'])->name('sheet.info');

// Authenticated routes - require login
Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin routes for spreadsheet links - requires admin role
    Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
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
