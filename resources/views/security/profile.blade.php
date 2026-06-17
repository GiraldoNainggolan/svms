@extends('layouts.security')

@section('title', 'Profil Saya')
@section('page-title', 'Profil Saya')
@section('page-description', 'Informasi akun dan ringkasan performa')

@section('content')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- ========== PROFILE CARD ========== --}}
        <div class="glass-card p-6">
            <div class="text-center mb-6">
                <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-2xl flex items-center justify-center text-3xl font-bold mx-auto mb-4">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <h3 class="text-lg font-bold">{{ $user->name }}</h3>
                <p class="text-xs text-slate-500 mt-1">{{ $user->email }}</p>
                <span class="inline-block mt-2 text-[10px] font-semibold uppercase tracking-wider bg-blue-500/10 text-blue-400 border border-blue-500/20 px-3 py-1 rounded-full">
                    {{ $user->role }}
                </span>
            </div>

            <div class="space-y-3 border-t border-white/[0.06] pt-4">
                <div class="flex items-center justify-between">
                    <span class="text-xs text-slate-500">Bergabung</span>
                    <span class="text-xs font-medium">{{ $user->created_at->format('d M Y') }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-xs text-slate-500">Email Terverifikasi</span>
                    <span class="text-xs font-medium">
                        @if($user->email_verified_at)
                            <span class="text-emerald-400">{{ $user->email_verified_at->format('d M Y') }}</span>
                        @else
                            <span class="text-red-400">Belum</span>
                        @endif
                    </span>
                </div>
            </div>

            <a href="{{ route('profile.edit') }}"
               class="mt-5 block text-center bg-white/[0.04] hover:bg-white/[0.08] border border-white/[0.06] rounded-xl py-2.5 text-sm font-medium transition">
                Edit Profil
            </a>
        </div>

        {{-- ========== STATS & ACTIVITY ========== --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Performance Stats --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="stat-card text-center">
                    <p class="text-3xl font-bold text-amber-400">{{ $totalCheckouts }}</p>
                    <p class="text-xs text-slate-500 mt-1">Total Checkout</p>
                    <p class="text-[10px] text-slate-600">Sepanjang Waktu</p>
                </div>
                <div class="stat-card text-center">
                    <p class="text-3xl font-bold text-emerald-400">{{ $todayCheckouts }}</p>
                    <p class="text-xs text-slate-500 mt-1">Checkout Hari Ini</p>
                    <p class="text-[10px] text-slate-600">{{ now()->translatedFormat('d M Y') }}</p>
                </div>
                <div class="stat-card text-center">
                    <p class="text-3xl font-bold text-blue-400">{{ $recentLogs->count() }}</p>
                    <p class="text-xs text-slate-500 mt-1">Aktivitas Terakhir</p>
                    <p class="text-[10px] text-slate-600">10 log terbaru</p>
                </div>
            </div>

            {{-- Recent Activity --}}
            <div class="glass-card overflow-hidden">
                <div class="px-6 py-4 border-b border-white/[0.06] flex items-center justify-between">
                    <h3 class="text-sm font-semibold">Aktivitas Terakhir</h3>
                    <a href="{{ route('security.activity') }}" class="text-[10px] text-blue-400 hover:text-blue-300 transition font-medium">
                        Lihat Semua &rarr;
                    </a>
                </div>

                <div class="divide-y divide-white/[0.04]">
                    @forelse($recentLogs as $log)
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
                        <div class="px-6 py-3 flex items-center gap-3 hover:bg-white/[0.02] transition">
                            <div class="w-8 h-8 {{ $iconBg }} rounded-lg flex items-center justify-center flex-shrink-0">
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
                        <div class="px-6 py-8 text-center">
                            <p class="text-xs text-slate-500">Belum ada aktivitas tercatat</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>

    </div>

@endsection
