<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use App\Models\Staff;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    public function index()
    {
        // Find the staff record linked to the logged-in user's name
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $staff = Staff::where('name', $user->name)->first();

        $visitors = collect();

        if ($staff) {
            $visitors = Visitor::where('staff_id', $staff->id)
                ->latest()
                ->get();
        }

        return view('staff.dashboard', compact('visitors'));
    }
}
