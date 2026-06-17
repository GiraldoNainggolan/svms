<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KioskController;

/*
|--------------------------------------------------------------------------
| Landing Page
|--------------------------------------------------------------------------
*/
Route::view('/', 'landing')->name('landing');


/*
|--------------------------------------------------------------------------
| KIOSK ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix('kiosk')
    ->name('kiosk.')
    ->group(function () {

        Route::get('/', [KioskController::class, 'form'])->name('form');
        Route::get('/camera', [KioskController::class, 'camera'])->name('camera');
        Route::get('/signature', [KioskController::class, 'signature'])->name('signature');
        Route::get('/success', [KioskController::class, 'success'])->name('success');
    });


/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])
    ->get('/dashboard', function () {
        return view('dashboard');
    })
    ->name('dashboard');


/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';