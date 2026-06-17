<?php



























}    }        ));            'totalUsers',            'totalStaff',            'activeVisitors',            'todayVisitors',            'totalVisitors',        return view('admin.dashboard', compact(        $totalUsers = User::count();        $totalStaff = Staff::count();        $activeVisitors = Visitor::where('status', 'IN')->count();        $todayVisitors = Visitor::whereDate('created_at', today())->count();        $totalVisitors = Visitor::count();    {    public function index(){class AdminController extends Controlleruse App\Models\User;use App\Models\Staff;use App\Models\Visitor;namespace App\Http\Controllers;use Illuminate\Support\Facades\Route;
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
    Route::middleware('role:super_admin')
        ->get('/admin', [AdminController::class, 'index'])
        ->name('admin.dashboard');

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
