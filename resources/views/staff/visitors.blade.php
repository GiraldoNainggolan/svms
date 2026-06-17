@extends('layouts.staff')

@section('title', 'My Visitors')
@section('page-title', 'My Visitors')
@section('page-description', 'Daftar tamu hari ini yang ingin menemui Anda')

@section('content')

    <div class="glass-card overflow-hidden">
        <div class="px-6 py-4 border-b border-white/[0.06] flex items-center justify-between">
            <h3 class="text-sm font-semibold">Tamu Hari Ini</h3>
            <span class="text-xs text-slate-500">{{ $visitors->count() }} tamu</span>
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

                    {{-- Actions (only for WAITING) --}}
                    @if($visitor->status === 'WAITING')
                        <div class="flex items-center gap-2 flex-shrink-0">
                            <form method="POST" action="{{ route('staff.accept', $visitor->id) }}">
                                @csrf
                                @method('PATCH')
                                <button class="bg-emerald-500/10 hover:bg-emerald-500/20 border border-emerald-500/20 text-emerald-400 px-3 py-1.5 rounded-lg text-xs font-semibold transition">
                                    Terima
                                </button>
                            </form>
                            <form method="POST" action="{{ route('staff.reject', $visitor->id) }}"
                                  onsubmit="return confirm('Tolak tamu {{ $visitor->name }}?')">
                                @csrf
                                @method('PATCH')
                                <button class="bg-red-500/10 hover:bg-red-500/20 border border-red-500/20 text-red-400 px-3 py-1.5 rounded-lg text-xs font-semibold transition">
                                    Tolak
                                </button>
                            </form>
                        </div>
                    @endif

                    {{-- Time --}}
                    <span class="text-xs text-slate-500 flex-shrink-0 w-20 text-right">{{ $visitor->created_at->format('H:i') }}</span>
                </div>
            @empty
                <div class="px-6 py-12 text-center">
                    <svg class="w-10 h-10 text-slate-600 mx-auto mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                    <p class="text-sm text-slate-500">Belum ada tamu hari ini</p>
                </div>
            @endforelse
        </div>
    </div>

@endsection
