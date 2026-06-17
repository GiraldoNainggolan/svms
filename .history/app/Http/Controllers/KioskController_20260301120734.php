<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\Visitor;
use Illuminate\Http\Request;

class KioskController extends Controller
{
    public function form()
    {
        $staffs = Staff::all();

        return view('kiosk.form', compact('staffs'));
    }

    public function camera(Request $request)
    {
        session(['visitor_data' => $request->only('name', 'phone', 'institution', 'staff_id', 'purpose')]);

        return view('kiosk.camera');
    }

    public function signature(Request $request)
    {
        $data = session('visitor_data', []);
        $data['photo'] = $request->input('photo');
        session(['visitor_data' => $data]);

        return view('kiosk.signature');
    }

    public function store(Request $request)
    {
        $data = session('visitor_data', []);

        Visitor::create([
            'name'        => $data['name'] ?? null,
            'phone'       => $data['phone'] ?? null,
            'institution' => $data['institution'] ?? null,
            'staff_id'    => $data['staff_id'] ?? null,
            'purpose'     => $data['purpose'] ?? null,
            'photo'       => $data['photo'] ?? null,
            'signature'   => $request->input('signature'),
        ]);

        session()->forget('visitor_data');

        return redirect()->route('kiosk.success');
    }

    public function success()
    {
        return view('kiosk.success');
    }
}
