@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-description', 'Overview sistem visitor management')

@section('content')

    {{-- ========== LIVE STATUS BOARD ========== --}}
    <div class="grid grid-cols-3 gap-3 mb-6">
        <div class="flex items-center gap-3 bg-emerald-500/[0.08] border border-emerald-500/20 rounded-xl px-4 py-3">
            <span class="w-2.5 h-2.5 bg-emerald-400 rounded-full animate-pulse"></span>
            <div>
                <p class="text-xs text-emerald-400/70">Staff Available</p>
                <p class="text-lg font-bold text-emerald-400">{{ $staffAvailable }}</p>
            </div>
        </div>
        <div class="flex items-center gap-3 bg-amber-500/[0.08] border border-amber-500/20 rounded-xl px-4 py-3">
            <span class="w-2.5 h-2.5 bg-amber-400 rounded-full animate-pulse"></span>
            <div>
                <p class="text-xs text-amber-400/70">Visitor Waiting</p>
                <p class="text-lg font-bold text-amber-400">{{ $visitorWaiting }}</p>
            </div>
        </div>
        <div class="flex items-center gap-3 bg-red-500/[0.08] border border-red-500/20 rounded-xl px-4 py-3">
            <span class="w-2.5 h-2.5 bg-red-400 rounded-full {{ $visitorOverdue > 0 ? 'animate-pulse' : '' }}"></span>
            <div>
                <p class="text-xs text-red-400/70">Visitor Overdue</p>
                <p class="text-lg font-bold text-red-400">{{ $visitorOverdue }}</p>
            </div>
        </div>
    </div>

    {{-- ========== STAT CARDS ========== --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">

        <div class="stat-card group">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-blue-500/10 rounded-xl flex items-center justify-center group-hover:bg-blue-500/20 transition">
                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                </div>
                <span class="text-xs text-slate-500">Hari ini</span>
            </div>
            <p class="text-3xl font-extrabold text-white">{{ $todayVisitors }}</p>
            <p class="text-xs text-slate-500 mt-1">Pengunjung Hari Ini</p>
        </div>

        <div class="stat-card group">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-emerald-500/10 rounded-xl flex items-center justify-center group-hover:bg-emerald-500/20 transition">
                    <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <span class="text-xs text-emerald-400 font-medium">LIVE</span>
            </div>
            <p class="text-3xl font-extrabold text-white">{{ $activeVisitors }}</p>
            <p class="text-xs text-slate-500 mt-1">Sedang di Lokasi</p>
        </div>

        <div class="stat-card group">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-indigo-500/10 rounded-xl flex items-center justify-center group-hover:bg-indigo-500/20 transition">
                    <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                    </svg>
                </div>
                <span class="text-xs text-slate-500">Total</span>
            </div>
            <p class="text-3xl font-extrabold text-white">{{ $totalVisitors }}</p>
            <p class="text-xs text-slate-500 mt-1">Total Pengunjung</p>
        </div>

        <div class="stat-card group">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-violet-500/10 rounded-xl flex items-center justify-center group-hover:bg-violet-500/20 transition">
                    <svg class="w-5 h-5 text-violet-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                </div>
                <span class="text-xs text-slate-500">Team</span>
            </div>
            <p class="text-3xl font-extrabold text-white">{{ $totalStaff }}</p>
            <p class="text-xs text-slate-500 mt-1">Total Staff</p>
        </div>

    </div>

    {{-- ========== CHART + ACTIVITY SIDE BY SIDE ========== --}}
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 mb-8">

        {{-- CHART --}}
        <div class="lg:col-span-3 glass-card p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="font-bold text-sm">Grafik Kunjungan</h3>
                    <p class="text-xs text-slate-500 mt-0.5">7 hari terakhir</p>
                </div>
                <div class="w-2 h-2 bg-blue-400 rounded-full"></div>
            </div>
            <div class="h-[240px]">
                <canvas id="visitorChart"></canvas>
            </div>
        </div>

        {{-- RECENT ACTIVITY --}}
        <div class="lg:col-span-2 glass-card p-6">
            <div class="flex items-center justify-between mb-5">
                <h3 class="font-bold text-sm">Aktivitas Terakhir</h3>
                <a href="{{ route('admin.activity') }}" class="text-xs text-blue-400 hover:text-blue-300 transition">
                    Lihat semua
                </a>
            </div>
            <div class="space-y-0">
                @forelse($recentLogs as $log)
                    <div class="flex items-start gap-3 py-3 border-b border-white/[0.04] last:border-0">
                        <div class="w-7 h-7 mt-0.5 rounded-lg flex items-center justify-center flex-shrink-0
                            @if(str_contains($log->action, 'create')) bg-emerald-500/10
                            @elseif(str_contains($log->action, 'delete')) bg-red-500/10
                            @elseif(str_contains($log->action, 'checkin')) bg-blue-500/10
                            @elseif(str_contains($log->action, 'checkout')) bg-amber-500/10
                            @else bg-slate-500/10
                            @endif">
                            @if(str_contains($log->action, 'create'))
                                <svg class="w-3.5 h-3.5 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                            @elseif(str_contains($log->action, 'delete'))
                                <svg class="w-3.5 h-3.5 text-red-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                            @else
                                <svg class="w-3.5 h-3.5 text-blue-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs text-slate-300 leading-relaxed">{{ $log->description }}</p>
                            <p class="text-[10px] text-slate-600 mt-1">
                                {{ $log->user?->name ?? 'System' }} &middot; {{ $log->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <p class="text-xs text-slate-600">Belum ada aktivitas</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>

    {{-- ========== QUICK STATS BAR ========== --}}
    <div class="glass-card p-5">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-6">
                <div class="text-center">
                    <p class="text-2xl font-bold text-white">{{ $totalUsers }}</p>
                    <p class="text-[10px] text-slate-500 uppercase tracking-wide">Total Users</p>
                </div>
                <div class="w-px h-8 bg-white/[0.06]"></div>
                <div class="text-center">
                    <p class="text-2xl font-bold text-white">{{ $totalStaff }}</p>
                    <p class="text-[10px] text-slate-500 uppercase tracking-wide">Staff</p>
                </div>
                <div class="w-px h-8 bg-white/[0.06]"></div>
                <div class="text-center">
                    <p class="text-2xl font-bold text-white">{{ $totalVisitors }}</p>
                    <p class="text-[10px] text-slate-500 uppercase tracking-wide">Visitors</p>
                </div>
            </div>
            <a href="{{ route('admin.users.index') }}" class="text-xs text-blue-400 hover:text-blue-300 transition font-medium">
                Kelola Users →
            </a>
        </div>
    </div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('visitorChart').getContext('2d');

    const gradient = ctx.createLinearGradient(0, 0, 0, 240);
    gradient.addColorStop(0, 'rgba(59, 130, 246, 0.3)');
    gradient.addColorStop(1, 'rgba(59, 130, 246, 0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($chartLabels),
            datasets: [{
                label: 'Pengunjung',
                data: @json($chartData),
                borderColor: '#3b82f6',
                backgroundColor: gradient,
                borderWidth: 2.5,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#3b82f6',
                pointBorderColor: '#0a0e1a',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1e293b',
                    titleColor: '#94a3b8',
                    bodyColor: '#fff',
                    bodyFont: { weight: '600' },
                    borderColor: 'rgba(255,255,255,0.1)',
                    borderWidth: 1,
                    cornerRadius: 12,
                    padding: 12,
                    displayColors: false,
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { color: '#475569', font: { size: 11 } },
                    border: { display: false },
                },
                y: {
                    grid: { color: 'rgba(255,255,255,0.03)' },
                    ticks: {
                        color: '#475569',
                        font: { size: 11 },
                        stepSize: 1,
                    },
                    border: { display: false },
                    beginAtZero: true,
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            }
        }
    });
});
</script>
@endpush
 