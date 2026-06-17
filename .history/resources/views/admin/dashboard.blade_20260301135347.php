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

    {{-- FLASH MESSAGES --}}
    @if(session('success'))
        <div class="mt-4 bg-green-500/20 border border-green-500/30 text-green-400 px-5 py-3 rounded-xl text-sm font-semibold">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mt-4 bg-red-500/20 border border-red-500/30 text-red-400 px-5 py-3 rounded-xl text-sm font-semibold">
            {{ session('error') }}
        </div>
    @endif

    {{-- USER MANAGEMENT TABLE --}}
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 mt-6">

        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-bold">Manajemen User</h2>
            <a href="{{ route('admin.users.create') }}"
               class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-xl text-sm font-semibold transition">
                + Tambah User
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="text-slate-400 border-b border-white/10">
                    <tr>
                        <th class="text-left py-2 pr-4">Nama</th>
                        <th class="text-left py-2 pr-4">Email</th>
                        <th class="text-left py-2 pr-4">Role</th>
                        <th class="text-right py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="border-b border-white/5 hover:bg-white/[0.02]">
                        <td class="py-3 pr-4">{{ $user->name }}</td>
                        <td class="py-3 pr-4 text-slate-400">{{ $user->email }}</td>
                        <td class="py-3 pr-4">
                            <span class="px-2.5 py-1 rounded-lg text-xs font-semibold
                                @if($user->role === 'super_admin') bg-amber-500/20 text-amber-400
                                @elseif($user->role === 'security') bg-blue-500/20 text-blue-400
                                @elseif($user->role === 'staff') bg-violet-500/20 text-violet-400
                                @else bg-slate-600/30 text-slate-400
                                @endif">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td class="py-3 text-right">
                            @if($user->id !== auth()->id())
                            <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}"
                                  onsubmit="return confirm('Hapus user {{ $user->name }}?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-400 hover:text-red-300 text-xs font-semibold transition">
                                    Hapus
                                </button>
                            </form>
                            @else
                            <span class="text-slate-600 text-xs">Anda</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

</div>

</body>
</html>
