'role' => \App\Http\Middleware\RoleMiddleware::class,

Route::middleware(['auth','role:super_admin'])
->get('/admin',[AdminController::class,'index']);

Route::middleware(['auth','role:security'])
->get('/security',[SecurityController::class,'index']);

Route::middleware(['auth','role:staff'])
->get('/staff',[StaffController::class,'index']);