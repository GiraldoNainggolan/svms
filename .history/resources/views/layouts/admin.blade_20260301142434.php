<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — SVMS</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
        .sidebar-link { @apply flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200; }
        .sidebar-link:hover { @apply bg-white/5 text-white; }
        .sidebar-link.active { @apply bg-blue-600/20 text-blue-400 border border-blue-500/20; }
        .sidebar-link .icon { @apply w-5 h-5 flex-shrink-0; }
        .stat-card { @apply bg-white/[0.04] backdrop-blur-xl border border-white/[0.06] rounded-2xl p-5 hover:bg-white/[0.06] transition-all duration-300; }
        .glass-card { @apply bg-white/[0.04] backdrop-blur-xl border border-white/[0.06] rounded-2xl; }
    </style>
    @stack('styles')
</head>

<body class="bg-[#0a0e1a] text-white antialiased">

<div class="flex min-h-screen">

    {{-- ========== SIDEBAR ========== --}}
    <aside class="w-[260px] bg-[#0d1220] border-r border-white/[0.06] flex flex-col fixed inset-y-0 left-0 z-30">

        {{-- BRAND --}}
        <div class="px-6 py-6 border-b border-white/[0.06]">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-base font-bold tracking-tight">SVMS</h1>
                    <p class="text-[10px] text-slate-500 uppercase tracking-widest">Control Center</p>
                </div>
            </div>
        </div>

        {{-- NAVIGATION --}}
        <nav class="flex-1 px-4 py-5 space-y-1 overflow-y-auto">

            <p class="text-[10px] text-slate-500 uppercase tracking-widest font-semibold px-4 mb-3">Menu Utama</p>

            <a href="{{ route('admin.dashboard') }}"
               class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : 'text-slate-400' }}">
                <svg class="icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                </svg>
                Dashboard
            </a>

            <a href="{{ route('admin.users.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : 'text-slate-400' }}">
                <svg class="icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>
                User Management
            </a>

            <a href="{{ route('admin.visitors') }}"
               class="sidebar-link {{ request()->routeIs('admin.visitors') ? 'active' : 'text-slate-400' }}">
                <svg class="icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
                Visitor Activity
            </a>

            <a href="{{ route('admin.activity') }}"
               class="sidebar-link {{ request()->routeIs('admin.activity') ? 'active' : 'text-slate-400' }}">
                <svg class="icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Activity Log
            </a>

            <div class="pt-4 pb-2">
                <p class="text-[10px] text-slate-500 uppercase tracking-widest font-semibold px-4 mb-3">Account</p>
            </div>

            <a href="{{ route('profile.edit') }}"
               class="sidebar-link {{ request()->routeIs('profile.*') ? 'active' : 'text-slate-400' }}">
                <svg class="icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Profile
            </a>

        </nav>

        {{-- USER INFO --}}
        <div class="px-4 py-4 border-t border-white/[0.06]">
            <div class="flex items-center gap-3 px-2">
                <div class="w-8 h-8 bg-gradient-to-br from-violet-500 to-purple-600 rounded-lg flex items-center justify-center text-xs font-bold">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium truncate">{{ auth()->user()->name }}</p>
                    <p class="text-[10px] text-slate-500 truncate">{{ auth()->user()->email }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-slate-500 hover:text-red-400 transition" title="Logout">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>

    </aside>

    {{-- ========== MAIN CONTENT ========== --}}
    <main class="flex-1 ml-[260px]">

        {{-- TOP BAR --}}
        <header class="sticky top-0 z-20 bg-[#0a0e1a]/80 backdrop-blur-xl border-b border-white/[0.06] px-8 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold">@yield('page-title', 'Dashboard')</h2>
                    <p class="text-xs text-slate-500 mt-0.5">@yield('page-description', '')</p>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-xs text-slate-500">{{ now()->translatedFormat('l, d F Y') }}</span>
                    <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse" title="System Online"></div>
                </div>
            </div>
        </header>

        {{-- FLASH MESSAGES --}}
        @if(session('success'))
            <div class="mx-8 mt-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 px-5 py-3 rounded-xl text-sm font-medium flex items-center gap-2">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mx-8 mt-4 bg-red-500/10 border border-red-500/20 text-red-400 px-5 py-3 rounded-xl text-sm font-medium flex items-center gap-2">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                </svg>
                {{ session('error') }}
            </div>
        @endif

        {{-- PAGE CONTENT --}}
        <div class="p-8">
            @yield('content')
        </div>

    </main>

</div>

@stack('scripts')
</body>
</html>
