<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Support\Facades\Auth;

class SecurityController extends Controller
{
    public function index()
    {
        $visitors = Visitor::with('staff')
            ->whereIn('status', ['WAITING', 'ACCEPTED', 'IN'])
            ->latest()
            ->get();

        $todayCheckin   = Visitor::whereDate('created_at', today())->count();
        $todayCheckout  = Visitor::whereDate('updated_at', today())->where('status', 'OUT')->count();
        $overdueVisitors = Visitor::whereIn('status', ['WAITING', 'ACCEPTED', 'IN'])
            ->where('created_at', '<', now()->subHours(2))
            ->count();

        $logs = ActivityLog::where('user_id', Auth::id())
            ->latest()
            ->limit(5)
            ->get();

        return view('security.dashboard', compact(
            'visitors',
            'todayCheckin',
            'todayCheckout',
            'overdueVisitors',
            'logs'
        ));
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

    public function activity()
    {
        $logs = ActivityLog::where('user_id', Auth::id())
            ->latest()
            ->paginate(20);

        return view('security.activity', compact('logs'));
    }

    public function profile()
    {
        /** @var User $user */
        $user = Auth::user();

        $totalCheckouts = ActivityLog::where('user_id', $user->id)
            ->where('action', 'visitor_checkout')
            ->count();

        $todayCheckouts = ActivityLog::where('user_id', $user->id)
            ->where('action', 'visitor_checkout')
            ->whereDate('created_at', today())
            ->count();

        $recentLogs = ActivityLog::where('user_id', $user->id)
            ->latest()
            ->limit(10)
            ->get();

        return view('security.profile', compact('user', 'totalCheckouts', 'todayCheckouts', 'recentLogs'));
    }
}
