<?php

namespace App\Http\Controllers;

use App\Models\Visitor;

class SecurityController extends Controller
{
    public function index()
    {
        $visitors = Visitor::where('status','IN')->latest()->get();
        return view('security.dashboard', compact('visitors'));
    }
}