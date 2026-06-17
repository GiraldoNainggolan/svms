<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use App\Models\Staff;

class StaffController extends Controller
{
    public function index()
    {
        // Find the staff record linked to the logged-in user's name
        $staff = Staff::where('name', auth()->user()->name)->first();

        $visitors = collect();

        if ($staff) {
            $visitors = Visitor::where('staff_id', $staff->id)
                ->latest()
                ->get();
        }

        return view('staff.dashboard', compact('visitors'));
    }
}