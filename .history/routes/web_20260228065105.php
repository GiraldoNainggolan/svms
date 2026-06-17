<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| WEB ROUTES
|--------------------------------------------------------------------------
*/

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
| Views:
| resources/views/kiosk/
|   - form.blade.php
|   - camera.blade.php
|   - signature.blade.php
|   - success.blade.php
|--------------------------------------------------------------------------
*/
Route::prefix('kiosk')
    ->name('kiosk.')
    ->group(function () {

        // /kiosk
        Route::view('/', 'kiosk.form')->name('form');

        // /kiosk/camera
        Route::view('/camera', 'kiosk.camera')->name('camera');

        // /kiosk/signature
        Route::view('/signature', 'kiosk.signature')->name('signature');

        // /kiosk/success
        Route::view('/success', 'kiosk.success')->name('success');
    });


/*
|--------------------------------------------------------------------------
| Dashboard (Auth + Verified)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])
    ->get('/dashboard', function () {
        return view('dashboard');
    })
    ->name('dashboard');


/*
|--------------------------------------------------------------------------
| Profile Routes (Auth Required)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';