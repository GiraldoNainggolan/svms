 <?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff; // pastikan model Staff ada

class KioskController extends Controller
{
    public function form()
    {
        // ambil data staff, kalau belum ada tabel tetap aman
        $staffs = Staff::all() ?? [];

        return view('kiosk.form', compact('staffs'));
    }

    public function camera()
    {
        return view('kiosk.camera');
    }

    public function signature()
    {
        return view('kiosk.signature');
    }

    public function success()
    {
        return view('kiosk.success');
    }
}