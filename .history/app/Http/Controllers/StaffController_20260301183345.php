<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Staff;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    /**
     * Resolve the Staff record linked to the authenticated user.
     */
    private function resolveStaff(): ?Staff
    {
        /** @var User $user */
        $user = Auth::user();

        return Staff::where('name', $user->name)->first();
    }

    // ─── Dashboard (Decision Panel) ────────────────────────
    public function index()
    {
        $staff = $this->resolveStaff();
        $staffId = $staff?->id;

        $waitingVisitors = $staffId
            ? Visitor::where('staff_id', $staffId)
            ->where('status', 'WAITING')
            ->latest()
            ->get()
            : collect();

        $todayVisitors = $staffId
            ? Visitor::where('staff_id', $staffId)
            ->whereDate('created_at', today())
            ->count()
            : 0;

        $todayDone = $staffId
            ? Visitor::where('staff_id', $staffId)
            ->whereDate('created_at', today())
            ->whereIn('status', ['ACCEPTED', 'IN', 'OUT'])
            ->count()
            : 0;

        $logs = ActivityLog::where('user_id', Auth::id())
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
        $staff = $this->resolveStaff();

        if (!$staff || $visitor->staff_id !== $staff->id) {
            abort(403);
        }

        $visitor->update(['status' => 'ACCEPTED']);

        ActivityLog::log('visitor_accepted', "Menerima tamu: {$visitor->name}", $visitor);

        return back()->with('success', "Tamu {$visitor->name} diterima.");
    }

    // ─── Reject a visitor ──────────────────────────────────
    public function reject(Visitor $visitor)
    {
        $staff = $this->resolveStaff();

        if (!$staff || $visitor->staff_id !== $staff->id) {
            abort(403);
        }

        $visitor->update(['status' => 'REJECTED']);

        ActivityLog::log('visitor_rejected', "Menolak tamu: {$visitor->name}", $visitor);

        return back()->with('success', "Tamu {$visitor->name} ditolak.");
    }

    // ─── My Visitors (all statuses) ────────────────────────
    public function visitors()
    {
        $staff = $this->resolveStaff();
        $staffId = $staff?->id;

        $visitors = $staffId
            ? Visitor::where('staff_id', $staffId)
            ->whereDate('created_at', today())
            ->latest()
            ->get()
            : collect();

        $waitingCount = $staffId
            ? Visitor::where('staff_id', $staffId)->where('status', 'WAITING')->count()
            : 0;
        view()->share('waitingCount', $waitingCount);

        return view('staff.visitors', compact('visitors'));
    }

    // ─── History (paginated, all time) ─────────────────────
    public function history()
    {
        $staff = $this->resolveStaff();
        $staffId = $staff?->id;

        $visitors = $staffId
            ? Visitor::where('staff_id', $staffId)
            ->latest()
            ->paginate(20)
            : Visitor::where('id', 0)->paginate(20); // empty paginator

        $waitingCount = $staffId
            ? Visitor::where('staff_id', $staffId)->where('status', 'WAITING')->count()
            : 0;
        view()->share('waitingCount', $waitingCount);

        return view('staff.history', compact('visitors'));
    }

    // ─── Profile ───────────────────────────────────────────
    public function profile()
    {
        /** @var User $user */
        $user = Auth::user();
        $staff = $this->resolveStaff();
        $staffId = $staff?->id;

        $totalVisitors = $staffId
            ? Visitor::where('staff_id', $staffId)->count()
            : 0;

        $todayVisitors = $staffId
            ? Visitor::where('staff_id', $staffId)->whereDate('created_at', today())->count()
            : 0;

        $recentLogs = ActivityLog::where('user_id', $user->id)
            ->latest()
            ->limit(10)
            ->get();

        $waitingCount = $staffId
            ? Visitor::where('staff_id', $staffId)->where('status', 'WAITING')->count()
            : 0;
        view()->share('waitingCount', $waitingCount);

        return view('staff.profile', compact('user', 'staff', 'totalVisitors', 'todayVisitors', 'recentLogs'));
    }
}
