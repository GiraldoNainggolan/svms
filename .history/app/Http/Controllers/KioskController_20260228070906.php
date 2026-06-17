<?php

use App\Http\Controllers\KioskController;

Route::prefix('kiosk')->name('kiosk.')->group(function () {

    Route::get('/', [KioskController::class, 'form'])->name('form');
    Route::get('/camera', [KioskController::class, 'camera'])->name('camera');
    Route::get('/signature', [KioskController::class, 'signature'])->name('signature');
    Route::get('/success', [KioskController::class, 'success'])->name('success');
});

}
