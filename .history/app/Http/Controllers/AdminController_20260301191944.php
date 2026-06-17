<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Visitor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Admin Dashboard — overview with stats + chart data + recent activity.
     */
    public function index()
    {
        $totalVisitors  = Visitor::count();
        $todayVisitors  = Visitor::whereDate('created_at', today())->count();
        $activeVisitors = Visitor::where('status', 'IN')->count();
        $totalStaff     = User::where('role', 'staff')->count();
        $totalUsers     = User::count();

        // Chart data: visitors per day for the last 7 days
        $chartLabels = [];
        $chartData   = [];

        for ($i = 6; $i >= 0; $i--) {
            $date          = now()->subDays($i);
            $chartLabels[] = $date->format('d M');
            $chartData[]   = Visitor::whereDate('created_at', $date->toDateString())->count();
        }

        // Recent activity logs
        $recentLogs = ActivityLog::with('user')->latest()->take(10)->get();

        // Live status counts
        $staffAvailable  = User::where('role', 'staff')->count();
        $visitorWaiting  = Visitor::where('status', 'IN')
            ->where('created_at', '>=', now()->subHours(1))
            ->count();
        $visitorOverdue  = Visitor::where('status', 'IN')
            ->where('created_at', '<', now()->subHours(2))
            ->count();

        return view('admin.dashboard', compact(
            'totalVisitors',
            'todayVisitors',
            'activeVisitors',
            'totalStaff',
            'totalUsers',
            'chartLabels',
            'chartData',
            'recentLogs',
            'staffAvailable',
            'visitorWaiting',
            'visitorOverdue'
        ));
    }

    /**
     * Users list page.
     */
    public function usersIndex()
    {
        $users = User::latest()->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show create user form.
     */
    public function createUser()
    {
        return view('admin.users.create');
    }

    /**
     * Store a new user.
     */
    public function storeUser(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role'  => 'required|in:super_admin,security,staff',
        ]);

        $password = Str::random(8);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($password),
            'role'     => $request->role,
            'nik'      => $request->nik,
            'position' => $request->input('position'),
        ]);

        ActivityLog::log('create_user', "Menambahkan user baru: {$user->name} ({$user->role})", $user);

        return redirect()->route('admin.users.index')
            ->with('success', "User {$user->name} berhasil dibuat. Password: {$password}");
    }

    /**
     * Delete a user.
     */
    public function destroyUser(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri.');
        }

        $name = $user->name;
        $user->delete();

        ActivityLog::log('delete_user', "Menghapus user: {$name}");

        return back()->with('success', "User {$name} berhasil dihapus.");
    }

    /**
     * Visitor Activity page — all visitors with filtering.
     */
    public function visitors(Request $request)
    {
        $query = Visitor::with('staff')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('institution', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $visitors = $query->paginate(15);

        return view('admin.visitors', compact('visitors'));
    }

    /**
     * Activity log page.
     */
    public function activity()
    {
        $logs = ActivityLog::with('user')->latest()->paginate(20);
        return view('admin.activity', compact('logs'));
    }
}
