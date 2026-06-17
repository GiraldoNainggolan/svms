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
    Route::middleware('role:super_admin')->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/admin/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
        Route::post('/admin/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
        Route::delete('/admin/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
    });

    // SECURITY
    Route::middleware('role:security')
        ->get('/security', [SecurityController::class, 'index'])
        ->name('security.dashboard');

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
