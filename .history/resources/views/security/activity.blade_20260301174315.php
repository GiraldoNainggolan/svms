@extends('layouts.security')

@section('title', 'Activity Log')
@section('page-title', 'Activity Log')
@section('page-description', 'Riwayat semua aktivitas Anda di sistem')

@section('content')

    <div class="glass-card overflow-hidden">
        <div class="px-6 py-4 border-b border-white/[0.06] flex items-center justify-between">
            <h3 class="text-sm font-semibold">Riwayat Aktivitas</h3>
            <span class="text-xs text-slate-500">{{ $logs->total() }} total log</span>
        </div>

        <div class="divide-y divide-white/[0.04]">
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
                    $badgeMap = [
                        'checkout' => 'bg-amber-500/10 text-amber-400 border-amber-500/20',
                        'login'    => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
                        'logout'   => 'bg-red-500/10 text-red-400 border-red-500/20',
                        'default'  => 'bg-slate-500/10 text-slate-400 border-slate-500/20',
                    ];
                    $iconBg    = $iconBgMap[$actionType];
                    $iconText  = $iconTextMap[$actionType];
                    $badgeStyle = $badgeMap[$actionType];
                @endphp
                <div class="px-6 py-4 flex items-center gap-4 hover:bg-white/[0.02] transition">
                    {{-- Icon --}}
                    <div class="w-10 h-10 {{ $iconBg }} rounded-xl flex items-center justify-center flex-shrink-0">
                        @if($actionType === 'checkout')
                            <svg class="w-5 h-5 {{ $iconText }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                            </svg>
                        @elseif($actionType === 'login')
                            <svg class="w-5 h-5 {{ $iconText }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                            </svg>
                        @elseif($actionType === 'logout')
                            <svg class="w-5 h-5 {{ $iconText }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                            </svg>
                        @else
                            <svg class="w-5 h-5 {{ $iconText }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        @endif
                    </div>

                    {{-- Content --}}
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium">{{ $log->description }}</p>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="text-[10px] text-slate-600">{{ $log->created_at->format('d M Y, H:i') }}</span>
                            @if($log->ip_address)
                                <span class="text-[10px] text-slate-600">&middot; IP: {{ $log->ip_address }}</span>
                            @endif
                        </div>
                    </div>

                    {{-- Badge --}}
                    <span class="text-[10px] font-semibold px-2.5 py-1 rounded-full border {{ $badgeStyle }}">
                        {{ strtoupper(str_replace('_', ' ', $log->action)) }}
                    </span>

                    {{-- Timestamp --}}
                    <span class="text-xs text-slate-500 flex-shrink-0 w-24 text-right">{{ $log->created_at->diffForHumans() }}</span>
                </div>
            @empty
                <div class="px-6 py-12 text-center">
                    <svg class="w-10 h-10 text-slate-600 mx-auto mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-sm text-slate-500">Belum ada aktivitas tercatat</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($logs->hasPages())
            <div class="px-6 py-4 border-t border-white/[0.06]">
                {{ $logs->links() }}
            </div>
        @endif
    </div>

@endsection
