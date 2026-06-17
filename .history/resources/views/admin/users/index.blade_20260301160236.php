@extends('layouts.admin')

@section('title', 'User Management')
@section('page-title', 'User Management')
@section('page-description', 'Kelola semua user sistem SVMS')

@section('content')

    {{-- HEADER BAR --}}
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <div class="flex items-center gap-2 bg-white/[0.04] border border-white/[0.06] rounded-xl px-4 py-2">
                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>
                <span class="text-sm text-slate-400">{{ $users->count() }} users</span>
            </div>
        </div>
        <a href="{{ route('admin.users.create') }}"
           class="bg-blue-600 hover:bg-blue-500 px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 flex items-center gap-2 shadow-lg shadow-blue-600/20">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Tambah User
        </a>
    </div>

    {{-- ROLE SUMMARY --}}
    <div class="grid grid-cols-3 gap-4 mb-6">
        @php
            $adminCount    = $users->where('role', 'super_admin')->count();
            $securityCount = $users->where('role', 'security')->count();
            $staffCount    = $users->where('role', 'staff')->count();
        @endphp
        <div class="glass-card p-4 flex items-center gap-3">
            <div class="w-9 h-9 bg-amber-500/10 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                </svg>
            </div>
            <div>
                <p class="text-lg font-bold">{{ $adminCount }}</p>
                <p class="text-[10px] text-slate-500 uppercase tracking-wide">Super Admin</p>
            </div>
        </div>
        <div class="glass-card p-4 flex items-center gap-3">
            <div class="w-9 h-9 bg-blue-500/10 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                </svg>
            </div>
            <div>
                <p class="text-lg font-bold">{{ $securityCount }}</p>
                <p class="text-[10px] text-slate-500 uppercase tracking-wide">Security</p>
            </div>
        </div>
        <div class="glass-card p-4 flex items-center gap-3">
            <div class="w-9 h-9 bg-violet-500/10 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-violet-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0" />
                </svg>
            </div>
            <div>
                <p class="text-lg font-bold">{{ $staffCount }}</p>
                <p class="text-[10px] text-slate-500 uppercase tracking-wide">Staff</p>
            </div>
        </div>
    </div>

    {{-- USER TABLE --}}
    <div class="glass-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-white/[0.06]">
                        <th class="text-left py-3.5 px-6 text-[10px] text-slate-500 uppercase tracking-wider font-semibold">User</th>
                        <th class="text-left py-3.5 px-6 text-[10px] text-slate-500 uppercase tracking-wider font-semibold">Email</th>
                        <th class="text-left py-3.5 px-6 text-[10px] text-slate-500 uppercase tracking-wider font-semibold">Role</th>
                        <th class="text-left py-3.5 px-6 text-[10px] text-slate-500 uppercase tracking-wider font-semibold">Bergabung</th>
                        <th class="text-right py-3.5 px-6 text-[10px] text-slate-500 uppercase tracking-wider font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    @php
                        $roleType = match($user->role) {
                            'super_admin' => 'admin',
                            'security'    => 'security',
                            'staff'       => 'staff',
                            default       => 'default',
                        };
                        $avatarGradient = [
                            'admin'    => 'bg-gradient-to-br from-amber-500 to-orange-600',
                            'security' => 'bg-gradient-to-br from-blue-500 to-cyan-600',
                            'staff'    => 'bg-gradient-to-br from-violet-500 to-purple-600',
                            'default'  => 'bg-gradient-to-br from-slate-500 to-slate-700',
                        ][$roleType];
                        $badgeStyle = [
                            'admin'    => 'bg-amber-500/10 text-amber-400 border border-amber-500/20',
                            'security' => 'bg-blue-500/10 text-blue-400 border border-blue-500/20',
                            'staff'    => 'bg-violet-500/10 text-violet-400 border border-violet-500/20',
                            'default'  => 'bg-slate-500/10 text-slate-400 border border-slate-500/20',
                        ][$roleType];
                        $dotColor = [
                            'admin'    => 'bg-amber-400',
                            'security' => 'bg-blue-400',
                            'staff'    => 'bg-violet-400',
                            'default'  => 'bg-slate-400',
                        ][$roleType];
                    @endphp
                    <tr class="border-b border-white/[0.03] hover:bg-white/[0.02] transition-colors">
                        <td class="py-3.5 px-6">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center text-xs font-bold {{ $avatarGradient }}">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <span class="font-medium">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="py-3.5 px-6 text-slate-500">{{ $user->email }}</td>
                        <td class="py-3.5 px-6">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[11px] font-semibold {{ $badgeStyle }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $dotColor }}"></span>
                                {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                            </span>
                        </td>
                        <td class="py-3.5 px-6 text-slate-500 text-xs">{{ $user->created_at->format('d M Y') }}</td>
                        <td class="py-3.5 px-6 text-right">
                            @if($user->id !== auth()->id())
                            <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}"
                                  onsubmit="return confirm('Hapus user {{ $user->name }}?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-400/60 hover:text-red-400 transition text-xs font-medium px-3 py-1.5 rounded-lg hover:bg-red-500/10">
                                    Hapus
                                </button>
                            </form>
                            @else
                            <span class="text-slate-600 text-xs italic">Anda</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
