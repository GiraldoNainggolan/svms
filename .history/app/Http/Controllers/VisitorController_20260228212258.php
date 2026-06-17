<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VisitorController extends Controller
{
    public function index()
    {
        return view('kiosk.form');
    }

public function store(Request $request)
{
    $data = session('visitor_data');

    $signaturePath = null;

    // SAVE SIGNATURE FILE
    if ($request->signature) {

        $image = $request->signature;

        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);

        $fileName = 'signatures/'.Str::uuid().'.png';

        Storage::disk('public')->put(
            $fileName,
            base64_decode($image)
        );

        $signaturePath = $fileName;
    }

    Visitor::create([
        'name' => $data['name'],
        'phone' => $data['phone'],
        'institution' => $data['institution'],
        'purpose' => $data['purpose'],
        'staff_id' => $data['staff_id'],
        'signature_path' => $signaturePath,
        'checkin_time' => now(),
    ]);

    session()->forget('visitor_data');

    return redirect('/kiosk/success');
}
}