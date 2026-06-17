<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

        // Save photo to file
        $photoPath = null;
        $photo = $data['photo'] ?? null;

        if ($photo) {
            $photo = preg_replace('/^data:image\/\w+;base64,/', '', $photo);
            $photo = str_replace(' ', '+', $photo);

            $fileName = 'photos/' . Str::uuid() . '.jpg';
            Storage::disk('public')->put($fileName, base64_decode($photo));

            $photoPath = $fileName;
        }

        // Save signature to file
        $signaturePath = null;
        $signature = $request->input('signature');

        if ($signature) {
            $signature = preg_replace('/^data:image\/\w+;base64,/', '', $signature);
            $signature = str_replace(' ', '+', $signature);

            $fileName = 'signatures/' . Str::uuid() . '.png';
            Storage::disk('public')->put($fileName, base64_decode($signature));

            $signaturePath = $fileName;
        }

        Visitor::create([
            'name'           => $data['name'] ?? null,
            'phone'          => $data['phone'] ?? null,
            'institution'    => $data['institution'] ?? null,
            'staff_id'       => $data['staff_id'] ?? null,
            'purpose'        => $data['purpose'] ?? null,
            'photo'          => $photoPath,
            'signature_path' => $signaturePath,
        ]);

        session()->forget('visitor_data');

        return redirect()->route('kiosk.success');
    }

    public function success()
    {
        return view('kiosk.success');
    }
}
