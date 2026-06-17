<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Landing page
Route::get('/', function () {
    return view('landing');
});

/*
|--------------------------------------------------------------------------
| KIOSK ROUTES
|--------------------------------------------------------------------------
| views:
| resources/views/kiosk/
|   - form.blade.php
|   - camera.blade.php
|   - signature.blade.php
|   - success.blade.php
*/
Route::prefix('kiosk')->group(function () {

    // /kiosk  → form.blade.php
    Route::get('/', function () {
        return view('kiosk.form');
    })->name('kiosk.form');

    // /kiosk/camera
    Route::get('/camera', function () {
        return view('kiosk.camera');
    })->name('kiosk.camera');

    // /kiosk/signature
    Route::get('/signature', function () {
        return view('kiosk.signature');
    })->name('kiosk.signature');

    // /kiosk/success
    Route::get('/success', function () {
        return view('kiosk.success');
    })->name('kiosk.success');
});

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Profile (Auth Required)
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