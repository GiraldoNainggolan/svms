<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Security Dashboard — SVMS</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>

<body class="bg-[#0a0e1a] text-white antialiased">

<div class="min-h-screen p-6 md:p-10 max-w-6xl mx-auto">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                </svg>
            </div>
            <div>
                <h1 class="text-2xl font-bold">Security Dashboard</h1>
                <p class="text-xs text-slate-500">{{ auth()->user()->name }} &middot; {{ now()->translatedFormat('l, d F Y') }}</p>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="bg-white/[0.04] hover:bg-white/[0.08] border border-white/[0.06] text-slate-400 hover:text-white px-4 py-2 rounded-xl text-sm font-medium transition">
                Logout
            </button>
        </form>
    </div>

    {{-- LIVE STATUS --}}
    <div class="flex items-center gap-3 mb-6">
        <div class="flex items-center gap-2 bg-emerald-500/[0.08] border border-emerald-500/20 rounded-xl px-4 py-2.5">
            <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
            <span class="text-sm font-semibold text-emerald-400">{{ $visitors->count() }}</span>
            <span class="text-xs text-emerald-400/70">tamu sedang di lokasi</span>
        </div>
    </div>

    {{-- FLASH --}}
    @if(session('success'))
        <div class="mb-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 px-5 py-3 rounded-xl text-sm font-medium flex items-center gap-2">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- VISITOR CARDS --}}
    @forelse($visitors as $visitor)
        <div class="bg-white/[0.04] border border-white/[0.06] rounded-2xl p-5 mb-3 flex items-center justify-between hover:bg-white/[0.06] transition-all">
            <div class="flex items-center gap-4">
                @if($visitor->photo)
                    <img src="{{ asset('storage/' . $visitor->photo) }}" alt="foto"
                         class="w-12 h-12 rounded-xl object-cover border border-white/[0.06]" />
                @else
                    <div class="w-12 h-12 rounded-xl bg-white/[0.04] flex items-center justify-center text-sm font-bold text-slate-500">
                        {{ strtoupper(substr($visitor->name, 0, 1)) }}
                    </div>
                @endif
                <div>
                    <p class="font-semibold">{{ $visitor->name }}</p>
                    <p class="text-xs text-slate-500">{{ $visitor->institution ?? '-' }} &middot; {{ $visitor->purpose ?? '-' }}</p>
                    <p class="text-[10px] text-slate-600 mt-0.5">
                        Bertemu: {{ $visitor->staff->name ?? '-' }} &middot;
                        Check-in: {{ $visitor->created_at->format('H:i') }}
                        @if($visitor->created_at->lt(now()->subHours(2)))
                            <span class="text-red-400 font-semibold ml-1">OVERDUE</span>
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
        <div class="bg-white/[0.04] border border-white/[0.06] rounded-2xl p-12 text-center">
            <svg class="w-10 h-10 text-slate-600 mx-auto mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
            </svg>
            <p class="text-sm text-slate-500">Tidak ada tamu di lokasi saat ini</p>
        </div>
    @endforelse

</div>

</body>
</html>