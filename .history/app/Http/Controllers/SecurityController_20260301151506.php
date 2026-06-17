<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Visitor;
use Illuminate\Http\Request;

class SecurityController extends Controller
{
    public function index()
    {
        $visitors = Visitor::with('staff')->where('status', 'IN')->latest()->get();
        return view('security.dashboard', compact('visitors'));
    }

    public function checkout(Visitor $visitor)
    {
        $visitor->update([
            'status'        => 'OUT',
            'checkout_time' => now(),
        ]);

        ActivityLog::log('visitor_checkout', "Tamu check-out: {$visitor->name}", $visitor);

        return back()->with('success', "{$visitor->name} berhasil di-checkout.");
    }
}
