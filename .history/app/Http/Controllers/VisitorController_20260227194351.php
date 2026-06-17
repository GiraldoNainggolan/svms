<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function index()
    {
        return view('kiosk.form');
    }

    public function store(Request $request)
    {
        Visitor::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'institution' => $request->institution,
            'purpose' => $request->purpose,
            'checkin_time' => now(),
        ]);

        return redirect('/kiosk')
            ->with('success','Check-in berhasil');
    }
}