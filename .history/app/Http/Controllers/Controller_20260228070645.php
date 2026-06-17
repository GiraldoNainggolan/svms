<?php

namespace App\Http\Controllers;

use App\Models\Staff;

class KioskController extends Controller
{
    public function form()
    {
        $staffs = Staff::all(); // ambil data staff
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