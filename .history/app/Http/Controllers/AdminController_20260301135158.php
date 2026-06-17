<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function index()
    {
        $totalVisitors = Visitor::count();
        $todayVisitors = Visitor::whereDate('created_at', today())->count();
        $activeVisitors = Visitor::where('status', 'IN')->count();
        $totalStaff = User::where('role', 'staff')->count();
        $totalUsers = User::count();
        $users = User::latest()->get();

        return view('admin.dashboard', compact(
            'totalVisitors',
            'todayVisitors',
            'activeVisitors',
            'totalStaff',
            'totalUsers',
            'users'
        ));
    }

    public function createUser()
    {
        return view('admin.users.create');
    }

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
        ]);

        // If role is staff, also create a Staff record
        if ($request->role === 'staff') {
            Staff::firstOrCreate(
                ['name' => $request->name],
                ['position' => $request->input('position', 'Staff')]
            );
        }

        return redirect()->route('admin.dashboard')
            ->with('success', "User {$user->name} berhasil dibuat. Password: {$password}");
    }

    public function destroyUser(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri.');
        }

        $user->delete();

        return back()->with('success', "User {$user->name} berhasil dihapus.");
    }
}
