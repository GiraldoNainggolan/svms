@extends('layouts.admin')

@section('title', 'Visitor Activity')
@section('page-title', 'Visitor Activity')
@section('page-description', 'Monitor semua aktivitas pengunjung')

@section('content')

    {{-- FILTER BAR --}}
    <div class="glass-card p-4 mb-6">
        <form method="GET" action="{{ route('admin.visitors') }}" class="flex items-center gap-3 flex-wrap">
            {{-- Search --}}
            <div class="flex-1 min-w-[200px]">
                <div class="relative">
                    <svg class="w-4 h-4 text-slate-500 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, institusi, telepon..."
                        class="w-full pl-10 pr-4 py-2.5 bg-white/[0.04] border border-white/[0.06] rounded-xl text-sm text-white placeholder-slate-500 focus:border-blue-500/30 focus:ring-1 focus:ring-blue-500/20 transition" />
                </div>
            </div>

            {{-- Status Filter --}}
            <select name="status"
                class="bg-white/[0.04] border border-white/[0.06] rounded-xl px-4 py-2.5 text-sm text-white appearance-none cursor-pointer focus:border-blue-500/30 focus:ring-1 focus:ring-blue-500/20 transition">
                <option value="" class="bg-slate-900">Semua Status</option>
                <option value="IN" {{ request('status') === 'IN' ? 'selected' : '' }} class="bg-slate-900">Sedang di Lokasi</option>
                <option value="OUT" {{ request('status') === 'OUT' ? 'selected' : '' }} class="bg-slate-900">Sudah Keluar</option>
            </select>

            {{-- Date Filter --}}
            <input type="date" name="date" value="{{ request('date') }}"
                class="bg-white/[0.04] border border-white/[0.06] rounded-xl px-4 py-2.5 text-sm text-white focus:border-blue-500/30 focus:ring-1 focus:ring-blue-500/20 transition" />

            <button type="submit"
                class="bg-blue-600 hover:bg-blue-500 px-5 py-2.5 rounded-xl text-sm font-semibold transition shadow-lg shadow-blue-600/20">
                Filter
            </button>

            @if(request()->hasAny(['search', 'status', 'date']))
                <a href="{{ route('admin.visitors') }}" class="text-xs text-slate-500 hover:text-slate-300 transition">
                    Reset
                </a>
            @endif
        </form>
    </div>

    {{-- VISITOR TABLE --}}
    <div class="glass-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-white/[0.06]">
                        <th class="text-left py-3.5 px-6 text-[10px] text-slate-500 uppercase tracking-wider font-semibold">Pengunjung</th>
                        <th class="text-left py-3.5 px-6 text-[10px] text-slate-500 uppercase tracking-wider font-semibold">Institusi</th>
                        <th class="text-left py-3.5 px-6 text-[10px] text-slate-500 uppercase tracking-wider font-semibold">Tujuan</th>
                        <th class="text-left py-3.5 px-6 text-[10px] text-slate-500 uppercase tracking-wider font-semibold">Staff</th>
                        <th class="text-left py-3.5 px-6 text-[10px] text-slate-500 uppercase tracking-wider font-semibold">Status</th>
                        <th class="text-left py-3.5 px-6 text-[10px] text-slate-500 uppercase tracking-wider font-semibold">Check-in</th>
                        <th class="text-left py-3.5 px-6 text-[10px] text-slate-500 uppercase tracking-wider font-semibold">Foto</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($visitors as $visitor)
                    <tr class="border-b border-white/[0.03] hover:bg-white/[0.02] transition-colors">
                        <td class="py-3.5 px-6">
                            <div>
                                <p class="font-medium">{{ $visitor->name }}</p>
                                <p class="text-xs text-slate-500">{{ $visitor->phone ?? '-' }}</p>
                            </div>
                        </td>
                        <td class="py-3.5 px-6 text-slate-400">{{ $visitor->institution ?? '-' }}</td>
                        <td class="py-3.5 px-6 text-slate-400 text-xs">{{ $visitor->purpose ?? '-' }}</td>
                        <td class="py-3.5 px-6 text-slate-400 text-xs">{{ $visitor->staff->name ?? '-' }}</td>
                        <td class="py-3.5 px-6">
                            @if($visitor->status === 'IN')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[11px] font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                    <span class="w-1.5 h-1.5 bg-emerald-400 rounded-full animate-pulse"></span>
                                    Di Lokasi
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[11px] font-semibold bg-slate-500/10 text-slate-400 border border-slate-500/20">
                                    <span class="w-1.5 h-1.5 bg-slate-400 rounded-full"></span>
                                    Keluar
                                </span>
                            @endif
                        </td>
                        <td class="py-3.5 px-6 text-slate-500 text-xs">
                            {{ $visitor->created_at->format('d M Y H:i') }}
                        </td>
                        <td class="py-3.5 px-6">
                            @if($visitor->photo)
                                <img src="{{ asset('storage/' . $visitor->photo) }}" alt="foto"
                                     class="w-10 h-10 rounded-lg object-cover border border-white/[0.06]" />
                            @else
                                <div class="w-10 h-10 rounded-lg bg-white/[0.04] flex items-center justify-center">
                                    <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                                    </svg>
                                </div>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-12 text-center">
                            <div class="flex flex-col items-center gap-2">
                                <svg class="w-8 h-8 text-slate-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>
                                <p class="text-sm text-slate-500">Tidak ada data pengunjung</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if($visitors->hasPages())
            <div class="px-6 py-4 border-t border-white/[0.06]">
                <div class="flex items-center justify-between text-xs text-slate-500">
                    <span>Showing {{ $visitors->firstItem() }}-{{ $visitors->lastItem() }} of {{ $visitors->total() }}</span>
                    <div class="flex items-center gap-1">
                        @if($visitors->onFirstPage())
                            <span class="px-3 py-1.5 rounded-lg bg-white/[0.02] text-slate-600 cursor-not-allowed">Prev</span>
                        @else
                            <a href="{{ $visitors->previousPageUrl() }}" class="px-3 py-1.5 rounded-lg bg-white/[0.04] hover:bg-white/[0.08] transition">Prev</a>
                        @endif

                        @if($visitors->hasMorePages())
                            <a href="{{ $visitors->nextPageUrl() }}" class="px-3 py-1.5 rounded-lg bg-white/[0.04] hover:bg-white/[0.08] transition">Next</a>
                        @else
                            <span class="px-3 py-1.5 rounded-lg bg-white/[0.02] text-slate-600 cursor-not-allowed">Next</span>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>

@endsection
