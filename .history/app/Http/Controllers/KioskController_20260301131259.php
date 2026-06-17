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
    /**
     * Helper: get visitor session data safely.
     */
    private function getVisitorSession(): array
    {
        return session('visitor_data', []);
    }

    public function form()
    {
        $staffs = Staff::all();

        return view('kiosk.form', compact('staffs'));
    }

    public function camera(Request $request)
    {
        $data = $this->getVisitorSession();

        $data = array_merge($data, [
            'name'        => $request->input('name'),
            'phone'       => $request->input('phone'),
            'institution' => $request->input('institution'),
            'staff_id'    => $request->input('staff_id'),
            'purpose'     => $request->input('purpose'),
        ]);

        session(['visitor_data' => $data]);

        return view('kiosk.camera');
    }

    public function signature(Request $request)
    {
        $data = $this->getVisitorSession();

        // Guard: redirect back if session lost
        if (empty($data['name'])) {
            return redirect('/kiosk')->with('error', 'Session expired. Silakan isi ulang.');
        }

        $data['photo'] = $request->input('photo');
        session(['visitor_data' => $data]);

        return view('kiosk.signature');
    }

    public function store(Request $request)
    {
        $data = $this->getVisitorSession();

        // Guard: redirect back if session lost
        if (empty($data['name'])) {
            return redirect('/kiosk')->with('error', 'Session hilang. Silakan ulangi.');
        }

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
            'name'           => $data['name'],
            'phone'          => $data['phone'] ?? null,
            'institution'    => $data['institution'] ?? null,
            'staff_id'       => $data['staff_id'] ?? null,
            'purpose'        => $data['purpose'] ?? null,
            'photo'          => $photoPath,
            'signature_path' => $signaturePath,
        ]);

        session()->forget('visitor_data');

        // Return JSON for AJAX, or redirect for normal request
        if ($request->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('kiosk.success');
    }

    public function success()
    {
        return view('kiosk.success');
    }
}
