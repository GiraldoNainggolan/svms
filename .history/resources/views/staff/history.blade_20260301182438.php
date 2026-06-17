@extends('layouts.staff')

@section('title', 'History')
@section('page-title', 'Visitor History')
@section('page-description', 'Riwayat semua tamu yang pernah menemui Anda')

@section('content')

    <div class="glass-card overflow-hidden">
        <div class="px-6 py-4 border-b border-white/[0.06] flex items-center justify-between">
            <h3 class="text-sm font-semibold">Riwayat Tamu</h3>
            <span class="text-xs text-slate-500">{{ $visitors->total() }} total tamu</span>
        </div>

        <div class="divide-y divide-white/[0.04]">
            @forelse($visitors as $visitor)
                @php
                    $statusType = match($visitor->status) {
                        'WAITING'  => 'waiting',
                        'ACCEPTED' => 'accepted',
                        'REJECTED' => 'rejected',
                        'IN'       => 'in',
                        'OUT'      => 'out',
                        default    => 'default',
                    };
                    $badgeMap = [
                        'waiting'  => 'bg-yellow-500/10 text-yellow-400 border-yellow-500/20',
                        'accepted' => 'bg-blue-500/10 text-blue-400 border-blue-500/20',
                        'rejected' => 'bg-red-500/10 text-red-400 border-red-500/20',
                        'in'       => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
                        'out'      => 'bg-slate-500/10 text-slate-400 border-slate-500/20',
                        'default'  => 'bg-slate-500/10 text-slate-400 border-slate-500/20',
                    ];
                    $labelMap = [
                        'waiting'  => 'Menunggu',
                        'accepted' => 'Diterima',
                        'rejected' => 'Ditolak',
                        'in'       => 'Di Lokasi',
                        'out'      => 'Selesai',
                        'default'  => $visitor->status,
                    ];
                    $badgeStyle = $badgeMap[$statusType];
                    $statusLabel = $labelMap[$statusType];
                @endphp
                <div class="px-6 py-4 flex items-center gap-4 hover:bg-white/[0.02] transition">
                    {{-- Photo --}}
                    @if($visitor->photo)
                        <img src="{{ asset('storage/' . $visitor->photo) }}" alt="foto"
                             class="w-11 h-11 rounded-xl object-cover border border-white/[0.06] flex-shrink-0" />
                    @else
                        <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-slate-700 to-slate-800 flex items-center justify-center text-sm font-bold text-slate-400 flex-shrink-0">
                            {{ strtoupper(substr($visitor->name, 0, 1)) }}
                        </div>
                    @endif

                    {{-- Info --}}
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium">{{ $visitor->name }}</p>
                        <p class="text-xs text-slate-500">{{ $visitor->institution ?? '-' }} &middot; {{ $visitor->purpose ?? '-' }}</p>
                    </div>

                    {{-- Status Badge --}}
                    <span class="text-[10px] font-semibold px-2.5 py-1 rounded-full border {{ $badgeStyle }} flex-shrink-0">
                        {{ $statusLabel }}
                    </span>

                    {{-- Date --}}
                    <span class="text-xs text-slate-500 flex-shrink-0 w-28 text-right">{{ $visitor->created_at->format('d M Y H:i') }}</span>
                </div>
            @empty
                <div class="px-6 py-12 text-center">
                    <svg class="w-10 h-10 text-slate-600 mx-auto mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-sm text-slate-500">Belum ada riwayat tamu</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($visitors->hasPages())
            <div class="px-6 py-4 border-t border-white/[0.06]">
                {{ $visitors->links() }}
            </div>
        @endif
    </div>

@endsection
