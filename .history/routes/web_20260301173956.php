<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KioskController;
use App\Http\Controllers\SecurityController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Landing Page
|--------------------------------------------------------------------------
*/

Route::view('/', 'landing')->name('landing');


/*
|--------------------------------------------------------------------------
| KIOSK ROUTES (PUBLIC)
|--------------------------------------------------------------------------
*/

Route::prefix('kiosk')
    ->name('kiosk.')
    ->group(function () {

        Route::get('/', [KioskController::class, 'form'])->name('form');
        Route::post('/camera', [KioskController::class, 'camera'])->name('camera');
        Route::post('/signature', [KioskController::class, 'signature'])->name('signature');
        Route::post('/store', [KioskController::class, 'store'])->name('store');
        Route::get('/success', [KioskController::class, 'success'])->name('success');
    });


/*
|--------------------------------------------------------------------------
| ROLE DASHBOARD ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // SUPER ADMIN
    Route::middleware('role:super_admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/',              [AdminController::class, 'index'])->name('dashboard');
        Route::get('/visitors',      [AdminController::class, 'visitors'])->name('visitors');
        Route::get('/activity',      [AdminController::class, 'activity'])->name('activity');
        Route::get('/users',         [AdminController::class, 'usersIndex'])->name('users.index');
        Route::get('/users/create',  [AdminController::class, 'createUser'])->name('users.create');
        Route::post('/users',        [AdminController::class, 'storeUser'])->name('users.store');
        Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');
    });

    // SECURITY
    Route::middleware('role:security')->prefix('security')->name('security.')->group(function () {
        Route::get('/',              [SecurityController::class, 'index'])->name('dashboard');
        Route::patch('/checkout/{visitor}', [SecurityController::class, 'checkout'])->name('checkout');
        Route::get('/activity',      [SecurityController::class, 'activity'])->name('activity');
        Route::get('/profile',       [SecurityController::class, 'profile'])->name('profile');
    });

    // STAFF
    Route::middleware('role:staff')
        ->get('/staff', [StaffController::class, 'index'])
        ->name('staff.dashboard');
});


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


require __DIR__ . '/auth.php';
