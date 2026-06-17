@extends('layouts.staff')

@section('title', 'Dashboard')
@section('page-title', 'My Visitors Panel')
@section('page-description', 'Kelola tamu yang ingin menemui Anda')

@section('content')

    {{-- ========== GREETING HEADER ========== --}}
    <div class="glass-card p-6 mb-8">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 bg-gradient-to-br from-violet-500 to-purple-600 rounded-2xl flex items-center justify-center text-2xl font-bold">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div>
                <h2 class="text-lg font-bold">Halo, {{ auth()->user()->name }}!</h2>
                <p class="text-sm text-slate-400">
                    @if($waitingCount > 0)
                        Ada <span class="text-yellow-400 font-semibold">{{ $waitingCount }} tamu menunggu</span> konfirmasi Anda hari ini.
                    @else
                        Tidak ada tamu yang menunggu saat ini.
                    @endif
                </p>
            </div>
        </div>
    </div>

    {{-- ========== QUICK STATS ========== --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">

        {{-- Tamu Hari Ini --}}
        <div class="stat-card group">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-violet-500/10 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5 text-violet-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                </div>
                <span class="text-[10px] text-slate-500 uppercase tracking-wider font-semibold">Hari Ini</span>
            </div>
            <p class="text-3xl font-bold tracking-tight">{{ $todayVisitors }}</p>
            <p class="text-xs text-slate-500 mt-1">Tamu Hari Ini</p>
        </div>

        {{-- Sedang Menunggu --}}
        <div class="stat-card group">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-yellow-500/10 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <span class="text-[10px] text-yellow-400/70 uppercase tracking-wider font-semibold">Action Needed</span>
            </div>
            <p class="text-3xl font-bold tracking-tight {{ $waitingCount > 0 ? 'text-yellow-400' : '' }}">{{ $waitingCount }}</p>
            <p class="text-xs text-slate-500 mt-1">Menunggu Konfirmasi</p>
        </div>

        {{-- Sudah Selesai --}}
        <div class="stat-card group">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-emerald-500/10 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <span class="text-[10px] text-slate-500 uppercase tracking-wider font-semibold">Progress</span>
            </div>
            <p class="text-3xl font-bold tracking-tight">{{ $todayDone }}</p>
            <p class="text-xs text-slate-500 mt-1">Sudah Diproses</p>
        </div>

    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        {{-- ========== WAITING VISITOR LIST (CORE) — 2 cols ========== --}}
        <div class="xl:col-span-2">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-2">
                    <h3 class="text-sm font-semibold text-slate-300">Tamu Menunggu Konfirmasi</h3>
                    @if($waitingCount > 0)
                        <span class="bg-yellow-500/10 text-yellow-400 border border-yellow-500/20 text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $waitingCount }}</span>
                    @endif
                </div>
                <a href="{{ route('staff.visitors') }}" class="text-xs text-violet-400 hover:text-violet-300 transition font-medium">
                    Lihat Semua &rarr;
                </a>
            </div>

            <div class="space-y-3">
                @forelse($waitingVisitors as $visitor)
                    <div class="glass-card p-5 hover:bg-white/[0.06] transition-all">
                        <div class="flex items-start justify-between">
                            {{-- Visitor Info --}}
                            <div class="flex items-start gap-4">
                                @if($visitor->photo)
                                    <img src="{{ asset('storage/' . $visitor->photo) }}" alt="foto"
                                         class="w-14 h-14 rounded-xl object-cover border border-white/[0.06]" />
                                @else
                                    <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-slate-700 to-slate-800 flex items-center justify-center text-lg font-bold text-slate-400">
                                        {{ strtoupper(substr($visitor->name, 0, 1)) }}
                                    </div>
                                @endif
                                <div>
                                    <p class="font-semibold text-base">{{ $visitor->name }}</p>
                                    <p class="text-xs text-slate-500 mt-0.5">{{ $visitor->institution ?? '-' }}</p>
                                    <p class="text-xs text-slate-400 mt-1">
                                        <span class="text-slate-600">Keperluan:</span> {{ $visitor->purpose ?? '-' }}
                                    </p>
                                    <div class="flex items-center gap-3 mt-2">
                                        <span class="text-[10px] text-yellow-400 bg-yellow-500/10 border border-yellow-500/20 px-2 py-0.5 rounded-full font-semibold">
                                            MENUNGGU KONFIRMASI
                                        </span>
                                        <span class="text-[10px] text-slate-600">{{ $visitor->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="flex items-center gap-2 flex-shrink-0 ml-4">
                                <form method="POST" action="{{ route('staff.accept', $visitor->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="bg-emerald-500/10 hover:bg-emerald-500/20 border border-emerald-500/20 text-emerald-400 px-4 py-2 rounded-xl text-sm font-semibold transition flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                        </svg>
                                        Terima
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('staff.reject', $visitor->id) }}"
                                      onsubmit="return confirm('Tolak tamu {{ $visitor->name }}?')">
                                    @csrf
                                    @method('PATCH')
                                    <button class="bg-red-500/10 hover:bg-red-500/20 border border-red-500/20 text-red-400 px-4 py-2 rounded-xl text-sm font-semibold transition flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        Tolak
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="glass-card p-12 text-center">
                        <svg class="w-12 h-12 text-slate-600 mx-auto mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-sm text-slate-500">Tidak ada tamu menunggu</p>
                        <p class="text-xs text-slate-600 mt-1">Semua tamu sudah diproses</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- ========== RIGHT SIDEBAR (Profile + Activity) ========== --}}
        <div class="space-y-6">

            {{-- PROFILE QUICK CARD --}}
            <div class="glass-card p-5">
                <h4 class="text-xs text-slate-500 uppercase tracking-wider font-semibold mb-4">Profil Saya</h4>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-violet-500 to-purple-600 rounded-xl flex items-center justify-center text-lg font-bold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="font-semibold">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-slate-500">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-white/[0.04] rounded-xl p-3 text-center">
                        <p class="text-lg font-bold text-violet-400">{{ $todayVisitors }}</p>
                        <p class="text-[10px] text-slate-500">Tamu Hari Ini</p>
                    </div>
                    <div class="bg-white/[0.04] rounded-xl p-3 text-center">
                        <p class="text-lg font-bold text-emerald-400">{{ $todayDone }}</p>
                        <p class="text-[10px] text-slate-500">Sudah Diproses</p>
                    </div>
                </div>
                <a href="{{ route('staff.profile') }}"
                   class="mt-4 block text-center text-xs text-violet-400 hover:text-violet-300 transition font-medium">
                    Lihat Profil Lengkap &rarr;
                </a>
            </div>

            {{-- MY ACTIVITY (TIMELINE) --}}
            <div class="glass-card p-5">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-xs text-slate-500 uppercase tracking-wider font-semibold">Aktivitas Terbaru</h4>
                    <a href="{{ route('staff.history') }}" class="text-[10px] text-violet-400 hover:text-violet-300 transition font-medium">
                        Lihat Semua &rarr;
                    </a>
                </div>

                @forelse($logs as $log)
                    @php
                        $actionType = match(true) {
                            str_contains($log->action, 'accepted') => 'accepted',
                            str_contains($log->action, 'rejected') => 'rejected',
                            str_contains($log->action, 'login')    => 'login',
                            str_contains($log->action, 'logout')   => 'logout',
                            default                                 => 'default',
                        };
                        $iconBgMap = [
                            'accepted' => 'bg-emerald-500/10',
                            'rejected' => 'bg-red-500/10',
                            'login'    => 'bg-blue-500/10',
                            'logout'   => 'bg-slate-500/10',
                            'default'  => 'bg-slate-500/10',
                        ];
                        $iconTextMap = [
                            'accepted' => 'text-emerald-400',
                            'rejected' => 'text-red-400',
                            'login'    => 'text-blue-400',
                            'logout'   => 'text-slate-400',
                            'default'  => 'text-slate-400',
                        ];
                        $iconBg   = $iconBgMap[$actionType];
                        $iconText = $iconTextMap[$actionType];
                    @endphp
                    <div class="flex items-start gap-3 mb-3 last:mb-0">
                        <div class="w-8 h-8 {{ $iconBg }} rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            @if($actionType === 'accepted')
                                <svg class="w-4 h-4 {{ $iconText }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                            @elseif($actionType === 'rejected')
                                <svg class="w-4 h-4 {{ $iconText }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
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
                        <p class="text-xs text-slate-500">Belum ada aktivitas</p>
                    </div>
                @endforelse
            </div>

        </div>

    </div>

@endsection
