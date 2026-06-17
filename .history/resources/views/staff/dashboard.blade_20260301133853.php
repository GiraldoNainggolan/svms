<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Staff Dashboard — SVMS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950 text-white min-h-screen">

<div class="min-h-screen p-6 md:p-10">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold">Staff Dashboard</h1>
            <p class="text-slate-400 mt-1">Selamat datang, {{ auth()->user()->name }}</p>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="bg-red-500/20 hover:bg-red-500/30 text-red-400 px-4 py-2 rounded-xl text-sm font-semibold transition">
                Logout
            </button>
        </form>
    </div>

    {{-- VISITOR LIST --}}
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6">
        <h2 class="text-lg font-semibold mb-4">Tamu yang Ingin Bertemu Anda</h2>

        @if($visitors->isEmpty())
            <p class="text-slate-500 text-sm">Belum ada tamu saat ini.</p>
        @else
            <div class="space-y-3">
                @foreach($visitors as $visitor)
                    <div class="bg-white/5 border border-white/10 rounded-xl p-4 flex items-center justify-between">
                        <div>
                            <p class="font-semibold">{{ $visitor->name }}</p>
                            <p class="text-slate-400 text-sm">{{ $visitor->institution ?? '-' }} &middot; {{ $visitor->purpose ?? '-' }}</p>
                            <p class="text-xs text-slate-500 mt-1">{{ $visitor->created_at->diffForHumans() }}</p>
                        </div>
                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            {{ $visitor->status === 'IN' ? 'bg-green-500/20 text-green-400' : 'bg-slate-600/30 text-slate-400' }}">
                            {{ $visitor->status }}
                        </span>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</div>

</body>
</html>
