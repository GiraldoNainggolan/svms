<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    // ─── Dashboard (Decision Panel) ────────────────────────
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        $waitingVisitors = Visitor::where('staff_id', $user->id)
            ->where('status', 'WAITING')
            ->latest()
            ->get();

        $todayVisitors = Visitor::where('staff_id', $user->id)
            ->whereDate('created_at', today())
            ->count();

        $todayDone = Visitor::where('staff_id', $user->id)
            ->whereDate('created_at', today())
            ->whereIn('status', ['ACCEPTED', 'IN', 'OUT'])
            ->count();

        $logs = ActivityLog::where('user_id', $user->id)
            ->latest()
            ->limit(5)
            ->get();

        // Share waiting count with layout for notification badge
        $waitingCount = $waitingVisitors->count();
        view()->share('waitingCount', $waitingCount);

        return view('staff.dashboard', compact(
            'waitingVisitors',
            'todayVisitors',
            'todayDone',
            'waitingCount',
            'logs'
        ));
    }

    // ─── Accept a visitor ──────────────────────────────────
    public function accept(Visitor $visitor)
    {
        /** @var User $user */
        $user = Auth::user();

        if ($visitor->staff_id !== $user->id) {
            abort(403);
        }

        $visitor->update(['status' => 'ACCEPTED']);

        ActivityLog::log('visitor_accepted', "Menerima tamu: {$visitor->name}", $visitor);

        return back()->with('success', "Tamu {$visitor->name} diterima.");
    }

    // ─── Reject a visitor ──────────────────────────────────
    public function reject(Visitor $visitor)
    {
        /** @var User $user */
        $user = Auth::user();

        if ($visitor->staff_id !== $user->id) {
            abort(403);
        }

        $visitor->update(['status' => 'REJECTED']);

        ActivityLog::log('visitor_rejected', "Menolak tamu: {$visitor->name}", $visitor);

        return back()->with('success', "Tamu {$visitor->name} ditolak.");
    }

    // ─── My Visitors (all statuses) ────────────────────────
    public function visitors()
    {
        /** @var User $user */
        $user = Auth::user();

        $visitors = Visitor::where('staff_id', $user->id)
            ->whereDate('created_at', today())
            ->latest()
            ->get();

        $waitingCount = Visitor::where('staff_id', $user->id)
            ->where('status', 'WAITING')
            ->count();
        view()->share('waitingCount', $waitingCount);

        return view('staff.visitors', compact('visitors'));
    }

    // ─── History (paginated, all time) ─────────────────────
    public function history()
    {
        /** @var User $user */
        $user = Auth::user();

        $visitors = Visitor::where('staff_id', $user->id)
            ->latest()
            ->paginate(20);

        $waitingCount = Visitor::where('staff_id', $user->id)
            ->where('status', 'WAITING')
            ->count();
        view()->share('waitingCount', $waitingCount);

        return view('staff.history', compact('visitors'));
    }

    // ─── Profile ───────────────────────────────────────────
    public function profile()
    {
        /** @var User $user */
        $user = Auth::user();

        $totalVisitors = Visitor::where('staff_id', $user->id)->count();

        $todayVisitors = Visitor::where('staff_id', $user->id)
            ->whereDate('created_at', today())
            ->count();

        $recentLogs = ActivityLog::where('user_id', $user->id)
            ->latest()
            ->limit(10)
            ->get();

        $waitingCount = Visitor::where('staff_id', $user->id)
            ->where('status', 'WAITING')
            ->count();
        view()->share('waitingCount', $waitingCount);

        return view('staff.profile', compact('user', 'totalVisitors', 'todayVisitors', 'recentLogs'));
    }
}
