@extends('layouts.security')

@section('title', 'Dashboard')
@section('page-title', 'Security Dashboard')
@section('page-description', 'Monitor tamu aktif dan kelola checkout secara real-time')

@section('content')

    {{-- ========== MINI STATS ========== --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">

        {{-- Today Check-in --}}
        <div class="stat-card group">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-blue-500/10 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                    </svg>
                </div>
                <span class="text-[10px] text-slate-500 uppercase tracking-wider font-semibold">Hari Ini</span>
            </div>
            <p class="text-3xl font-bold tracking-tight">{{ $todayCheckin }}</p>
            <p class="text-xs text-slate-500 mt-1">Total Check-in</p>
        </div>

        {{-- Today Check-out --}}
        <div class="stat-card group">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-emerald-500/10 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                    </svg>
                </div>
                <span class="text-[10px] text-slate-500 uppercase tracking-wider font-semibold">Hari Ini</span>
            </div>
            <p class="text-3xl font-bold tracking-tight">{{ $todayCheckout }}</p>
            <p class="text-xs text-slate-500 mt-1">Total Check-out</p>
        </div>

        {{-- Overdue --}}
        <div class="stat-card group">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-red-500/10 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                </div>
                <span class="text-[10px] text-red-400/70 uppercase tracking-wider font-semibold">Perhatian</span>
            </div>
            <p class="text-3xl font-bold tracking-tight {{ $overdueVisitors > 0 ? 'text-red-400' : '' }}">{{ $overdueVisitors }}</p>
            <p class="text-xs text-slate-500 mt-1">Overdue (&gt; 2 jam)</p>
        </div>

    </div>

    {{-- ========== LIVE STATUS BAR ========== --}}
    <div class="flex items-center gap-3 mb-6">
        <div class="flex items-center gap-2 bg-emerald-500/[0.08] border border-emerald-500/20 rounded-xl px-4 py-2.5">
            <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
            <span class="text-sm font-semibold text-emerald-400">{{ $visitors->count() }}</span>
            <span class="text-xs text-emerald-400/70">tamu sedang di lokasi</span>
        </div>
        @if($overdueVisitors > 0)
            <div class="flex items-center gap-2 bg-red-500/[0.08] border border-red-500/20 rounded-xl px-4 py-2.5">
                <span class="w-2 h-2 bg-red-400 rounded-full animate-pulse"></span>
                <span class="text-sm font-semibold text-red-400">{{ $overdueVisitors }}</span>
                <span class="text-xs text-red-400/70">perlu perhatian</span>
            </div>
        @endif
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        {{-- ========== VISITOR CARDS (2 cols) ========== --}}
        <div class="xl:col-span-2 space-y-3">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-sm font-semibold text-slate-300">Tamu Aktif</h3>
                <span class="text-xs text-slate-500">{{ $visitors->count() }} orang</span>
            </div>

            @forelse($visitors as $visitor)
                @php
                    $isOverdue = $visitor->created_at->lt(now()->subHours(2));
                @endphp
                <div class="glass-card p-5 flex items-center justify-between hover:bg-white/[0.06] transition-all {{ $isOverdue ? 'border-red-500/20' : '' }}">
                    <div class="flex items-center gap-4">
                        @if($visitor->photo)
                            <img src="{{ asset('storage/' . $visitor->photo) }}" alt="foto"
                                 class="w-12 h-12 rounded-xl object-cover border border-white/[0.06]" />
                        @else
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-slate-700 to-slate-800 flex items-center justify-center text-sm font-bold text-slate-400">
                                {{ strtoupper(substr($visitor->name, 0, 1)) }}
                            </div>
                        @endif
                        <div>
                            <div class="flex items-center gap-2">
                                <p class="font-semibold">{{ $visitor->name }}</p>
                                @if($isOverdue)
                                    <span class="text-[10px] font-bold text-red-400 bg-red-500/10 px-2 py-0.5 rounded-full">OVERDUE</span>
                                @endif
                            </div>
                            <p class="text-xs text-slate-500">{{ $visitor->institution ?? '-' }} &middot; {{ $visitor->purpose ?? '-' }}</p>
                            <p class="text-[10px] text-slate-600 mt-0.5">
                                Bertemu: {{ $visitor->staff->name ?? '-' }} &middot;
                                Check-in: {{ $visitor->created_at->format('H:i') }}
                                @if($isOverdue)
                                    <span class="text-red-400/70">&middot; {{ $visitor->created_at->diffForHumans() }}</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('security.checkout', $visitor->id) }}"
                          onsubmit="return confirm('Check-out {{ $visitor->name }}?')">
                        @csrf
                        @method('PATCH')
                        <button class="bg-amber-500/10 hover:bg-amber-500/20 border border-amber-500/20 text-amber-400 px-4 py-2 rounded-xl text-sm font-semibold transition">
                            Check-out
                        </button>
                    </form>
                </div>
            @empty
                <div class="glass-card p-12 text-center">
                    <svg class="w-10 h-10 text-slate-600 mx-auto mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                    <p class="text-sm text-slate-500">Tidak ada tamu di lokasi saat ini</p>
                    <p class="text-xs text-slate-600 mt-1">Semua tamu telah check-out</p>
                </div>
            @endforelse
        </div>

        {{-- ========== RIGHT SIDEBAR (Activity + Profile) ========== --}}
        <div class="space-y-6">

            {{-- PROFILE QUICK CARD --}}
            <div class="glass-card p-5">
                <h4 class="text-xs text-slate-500 uppercase tracking-wider font-semibold mb-4">Profil Saya</h4>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-xl flex items-center justify-center text-lg font-bold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="font-semibold">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-slate-500">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-white/[0.04] rounded-xl p-3 text-center">
                        <p class="text-lg font-bold text-blue-400">{{ $todayCheckout }}</p>
                        <p class="text-[10px] text-slate-500">Checkout Hari Ini</p>
                    </div>
                    <div class="bg-white/[0.04] rounded-xl p-3 text-center">
                        <p class="text-lg font-bold text-cyan-400">{{ $todayCheckin }}</p>
                        <p class="text-[10px] text-slate-500">Visitor Hari Ini</p>
                    </div>
                </div>
                <a href="{{ route('security.profile') }}"
                   class="mt-4 block text-center text-xs text-blue-400 hover:text-blue-300 transition font-medium">
                    Lihat Profil Lengkap &rarr;
                </a>
            </div>

            {{-- MY ACTIVITY (TIMELINE) --}}
            <div class="glass-card p-5">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-xs text-slate-500 uppercase tracking-wider font-semibold">Aktivitas Saya Hari Ini</h4>
                    <a href="{{ route('security.activity') }}" class="text-[10px] text-blue-400 hover:text-blue-300 transition font-medium">
                        Lihat Semua &rarr;
                    </a>
                </div>

                @forelse($logs as $log)
                    @php
                        $actionType = match(true) {
                            str_contains($log->action, 'checkout') => 'checkout',
                            str_contains($log->action, 'login')    => 'login',
                            str_contains($log->action, 'logout')   => 'logout',
                            default                                 => 'default',
                        };
                        $iconBgMap = [
                            'checkout' => 'bg-amber-500/10',
                            'login'    => 'bg-emerald-500/10',
                            'logout'   => 'bg-red-500/10',
                            'default'  => 'bg-slate-500/10',
                        ];
                        $iconTextMap = [
                            'checkout' => 'text-amber-400',
                            'login'    => 'text-emerald-400',
                            'logout'   => 'text-red-400',
                            'default'  => 'text-slate-400',
                        ];
                        $iconBg   = $iconBgMap[$actionType];
                        $iconText = $iconTextMap[$actionType];
                    @endphp
                    <div class="flex items-start gap-3 mb-3 last:mb-0">
                        <div class="w-8 h-8 {{ $iconBg }} rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            @if($actionType === 'checkout')
                                <svg class="w-4 h-4 {{ $iconText }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                                </svg>
                            @elseif($actionType === 'login')
                                <svg class="w-4 h-4 {{ $iconText }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                </svg>
                            @else
                                <svg class="w-4 h-4 {{ $iconText }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs font-medium truncate">{{ $log->description }}</p>
                            <p class="text-[10px] text-slate-600">{{ $log->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-4">
                        <p class="text-xs text-slate-500">Belum ada aktivitas hari ini</p>
                    </div>
                @endforelse
            </div>

        </div>

    </div>

@endsection
