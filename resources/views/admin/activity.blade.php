@extends('layouts.admin')

@section('title', 'Activity Log')
@section('page-title', 'Activity Log')
@section('page-description', 'Riwayat semua aktivitas sistem')

@section('content')

    {{-- TIMELINE --}}
    <div class="glass-card overflow-hidden">

        {{-- TABLE HEADER --}}
        <div class="px-6 py-4 border-b border-white/[0.06] flex items-center justify-between">
            <h3 class="text-sm font-semibold">Log Aktivitas</h3>
            <span class="text-xs text-slate-500">{{ $logs->total() }} total entri</span>
        </div>

        <div class="divide-y divide-white/[0.03]">
            @forelse($logs as $log)
                @php
                    $actionType = match(true) {
                        str_contains($log->action, 'create')   => 'create',
                        str_contains($log->action, 'delete')   => 'delete',
                        str_contains($log->action, 'checkin')  => 'checkin',
                        str_contains($log->action, 'checkout') => 'checkout',
                        str_contains($log->action, 'login')    => 'login',
                        default                                 => 'default',
                    };

                    $iconBgMap = [
                        'create'   => 'bg-emerald-500/10',
                        'delete'   => 'bg-red-500/10',
                        'checkin'  => 'bg-blue-500/10',
                        'checkout' => 'bg-amber-500/10',
                        'login'    => 'bg-violet-500/10',
                        'default'  => 'bg-slate-500/10',
                    ];

                    $iconTextMap = [
                        'create'   => 'text-emerald-400',
                        'delete'   => 'text-red-400',
                        'checkin'  => 'text-blue-400',
                        'checkout' => 'text-amber-400',
                        'login'    => 'text-violet-400',
                        'default'  => 'text-slate-400',
                    ];

                    $badgeMap = [
                        'create'   => 'bg-emerald-500/10 text-emerald-400',
                        'delete'   => 'bg-red-500/10 text-red-400',
                        'checkin'  => 'bg-blue-500/10 text-blue-400',
                        'checkout' => 'bg-amber-500/10 text-amber-400',
                        'login'    => 'bg-violet-500/10 text-violet-400',
                        'default'  => 'bg-slate-500/10 text-slate-400',
                    ];

                    $iconBg    = $iconBgMap[$actionType];
                    $iconText  = $iconTextMap[$actionType];
                    $badgeStyle = $badgeMap[$actionType];
                @endphp

                <div class="flex items-start gap-4 px-6 py-4 hover:bg-white/[0.01] transition-colors">

                    {{-- ICON --}}
                    <div class="w-9 h-9 mt-0.5 rounded-xl flex items-center justify-center flex-shrink-0 {{ $iconBg }}">
                        @if($actionType === 'create')
                            <svg class="w-4 h-4 {{ $iconText }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        @elseif($actionType === 'delete')
                            <svg class="w-4 h-4 {{ $iconText }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        @elseif($actionType === 'checkin')
                            <svg class="w-4 h-4 {{ $iconText }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                            </svg>
                        @elseif($actionType === 'checkout')
                            <svg class="w-4 h-4 {{ $iconText }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                            </svg>
                        @else
                            <svg class="w-4 h-4 {{ $iconText }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        @endif
                    </div>

                    {{-- CONTENT --}}
                    <div class="flex-1 min-w-0">
                        <p class="text-sm text-slate-200 leading-relaxed">{{ $log->description }}</p>
                        <div class="flex items-center gap-3 mt-1.5">
                            <span class="text-xs text-slate-500">
                                {{ $log->user?->name ?? 'System' }}
                            </span>
                            <span class="text-[10px] text-slate-600">&middot;</span>
                            <span class="text-xs text-slate-600">
                                {{ $log->created_at->format('d M Y, H:i') }}
                            </span>
                            <span class="text-[10px] text-slate-600">&middot;</span>
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium {{ $badgeStyle }}">
                                {{ str_replace('_', ' ', $log->action) }}
                            </span>
                            @if($log->ip_address)
                                <span class="text-[10px] text-slate-600">IP: {{ $log->ip_address }}</span>
                            @endif
                        </div>
                    </div>

                    {{-- TIMESTAMP --}}
                    <div class="text-right flex-shrink-0">
                        <p class="text-xs text-slate-500">{{ $log->created_at->diffForHumans() }}</p>
                    </div>

                </div>
            @empty
                <div class="py-16 text-center">
                    <svg class="w-10 h-10 text-slate-600 mx-auto mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-sm text-slate-500">Belum ada aktivitas tercatat</p>
                    <p class="text-xs text-slate-600 mt-1">Aktivitas akan muncul ketika ada perubahan di sistem</p>
                </div>
            @endforelse
        </div>

        {{-- PAGINATION --}}
        @if($logs->hasPages())
            <div class="px-6 py-4 border-t border-white/[0.06]">
                <div class="flex items-center justify-between text-xs text-slate-500">
                    <span>Showing {{ $logs->firstItem() }}-{{ $logs->lastItem() }} of {{ $logs->total() }}</span>
                    <div class="flex items-center gap-1">
                        @if($logs->onFirstPage())
                            <span class="px-3 py-1.5 rounded-lg bg-white/[0.02] text-slate-600 cursor-not-allowed">Prev</span>
                        @else
                            <a href="{{ $logs->previousPageUrl() }}" class="px-3 py-1.5 rounded-lg bg-white/[0.04] hover:bg-white/[0.08] transition">Prev</a>
                        @endif

                        @if($logs->hasMorePages())
                            <a href="{{ $logs->nextPageUrl() }}" class="px-3 py-1.5 rounded-lg bg-white/[0.04] hover:bg-white/[0.08] transition">Next</a>
                        @else
                            <span class="px-3 py-1.5 rounded-lg bg-white/[0.02] text-slate-600 cursor-not-allowed">Next</span>
                        @endif
                    </div>
                </div>
            </div>
        @endif

    </div>

@endsection
