<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard — SVMS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950 text-white min-h-screen">

<div class="min-h-screen p-6 md:p-10">

    {{-- HEADER --}} 
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold">Admin Dashboard</h1>
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

    {{-- STAT CARDS --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">

        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-5">
            <p class="text-slate-400 text-xs uppercase tracking-wide">Pengunjung Hari Ini</p>
            <p class="text-3xl font-bold text-blue-400 mt-2">{{ $todayVisitors }}</p>
        </div>

        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-5">
            <p class="text-slate-400 text-xs uppercase tracking-wide">Sedang di Lokasi</p>
            <p class="text-3xl font-bold text-green-400 mt-2">{{ $activeVisitors }}</p>
        </div>

        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-5">
            <p class="text-slate-400 text-xs uppercase tracking-wide">Total Pengunjung</p>
            <p class="text-3xl font-bold text-indigo-400 mt-2">{{ $totalVisitors }}</p>
        </div>

        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-5">
            <p class="text-slate-400 text-xs uppercase tracking-wide">Total Staff</p>
            <p class="text-3xl font-bold text-violet-400 mt-2">{{ $totalStaff }}</p>
        </div>

    </div>

    {{-- INFO --}}
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6">
        <p class="text-slate-400 text-sm">
            Total user terdaftar: <span class="text-white font-semibold">{{ $totalUsers }}</span>
        </p>
    </div>

</div>

</body>
</html>
