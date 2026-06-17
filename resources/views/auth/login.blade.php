<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login — {{ config('app.name', 'SVMS') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(3deg); }
        }
        @keyframes float-delay {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(-2deg); }
        }
        @keyframes gradient-shift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        @keyframes fade-in-up {
            from { opacity: 0; transform: translateY(24px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fade-in-right {
            from { opacity: 0; transform: translateX(-24px); }
            to { opacity: 1; transform: translateX(0); }
        }
        .animate-float { animation: float 6s ease-in-out infinite; }
        .animate-float-delay { animation: float-delay 7s ease-in-out infinite; }
        .animate-gradient { animation: gradient-shift 8s ease infinite; background-size: 200% 200%; }
        .fade-up-1 { animation: fade-in-up 0.7s ease-out both; }
        .fade-up-2 { animation: fade-in-up 0.7s ease-out 0.1s both; }
        .fade-up-3 { animation: fade-in-up 0.7s ease-out 0.2s both; }
        .fade-up-4 { animation: fade-in-up 0.7s ease-out 0.3s both; }
        .fade-right-1 { animation: fade-in-right 0.8s ease-out 0.15s both; }
        .fade-right-2 { animation: fade-in-right 0.8s ease-out 0.3s both; }
        .fade-right-3 { animation: fade-in-right 0.8s ease-out 0.45s both; }
        .input-glow:focus-within {
            box-shadow: 0 0 0 3px rgba(99,102,241,0.15);
        }
    </style>
</head>
<body class="font-sans antialiased">

<div class="min-h-screen flex relative">

    {{-- LEFT SIDE (VISUAL) --}}
    <div class="hidden lg:flex w-1/2 bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950 text-white items-center justify-center p-12 relative overflow-hidden">

        {{-- BACKGROUND DECORATIONS --}}
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-32 -right-32 w-80 h-80 bg-blue-500/10 rounded-full blur-3xl animate-float"></div>
            <div class="absolute bottom-1/4 -left-24 w-72 h-72 bg-indigo-500/10 rounded-full blur-3xl animate-float-delay"></div>
            <div class="absolute -bottom-24 right-1/3 w-64 h-64 bg-violet-500/8 rounded-full blur-3xl animate-float"></div>

            {{-- GRID PATTERN --}}
            <div class="absolute inset-0 opacity-[0.03]"
                 style="background-image: linear-gradient(rgba(255,255,255,.1) 1px, transparent 1px),
                                          linear-gradient(90deg, rgba(255,255,255,.1) 1px, transparent 1px);
                        background-size: 60px 60px;">
            </div>
        </div>

        <div class="relative z-10 max-w-md space-y-8">

            {{-- LOGO --}}
            <div class="fade-right-1">
                <a href="/" class="inline-flex items-center gap-3 group">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/25 group-hover:shadow-blue-500/40 transition-shadow">
                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold tracking-tight bg-gradient-to-r from-white to-slate-300 bg-clip-text text-transparent">
                        SVMS
                    </span>
                </a>
            </div>

            {{-- HEADING --}}
            <div class="fade-right-2 space-y-4">
                <p class="text-xs font-semibold tracking-widest uppercase text-indigo-400">
                    Internal Access
                </p>
                <h1 class="text-4xl xl:text-5xl font-extrabold leading-[1.1] tracking-tight">
                    Selamat Datang
                    <span class="block bg-gradient-to-r from-blue-400 via-indigo-400 to-violet-400 bg-clip-text text-transparent animate-gradient">
                        Kembali
                    </span>
                </h1>
                <p class="text-slate-400 text-lg leading-relaxed">
                    Sistem digital untuk memantau dan mengelola tamu sekolah secara
                    <span class="text-slate-200 font-medium">modern</span>,
                    <span class="text-slate-200 font-medium">aman</span>, dan
                    <span class="text-slate-200 font-medium">efisien</span>.
                </p>
            </div>

            {{-- FEATURE LIST --}}
            <div class="fade-right-3 space-y-4 pt-2">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl bg-blue-500/15 border border-blue-500/20 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-sm font-semibold text-white">Secure Login</div>
                        <div class="text-xs text-slate-500">Hanya staff & admin yang diizinkan</div>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl bg-violet-500/15 border border-violet-500/20 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-violet-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-sm font-semibold text-white">Real-time Dashboard</div>
                        <div class="text-xs text-slate-500">Monitor pengunjung secara langsung</div>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl bg-emerald-500/15 border border-emerald-500/20 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-sm font-semibold text-white">Laporan & Ekspor</div>
                        <div class="text-xs text-slate-500">Generate laporan kapan saja</div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    {{-- RIGHT SIDE (FORM) --}}
    <div class="w-full lg:w-1/2 bg-slate-50 flex items-center justify-center p-6 sm:p-10 relative">

        {{-- SUBTLE BG DECORATION (mobile-friendly) --}}
        <div class="absolute top-0 right-0 w-72 h-72 bg-indigo-100/50 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-blue-100/40 rounded-full blur-3xl translate-y-1/3 -translate-x-1/4 pointer-events-none"></div>

        <div class="relative z-10 w-full max-w-md">

            {{-- MOBILE LOGO --}}
            <div class="lg:hidden flex justify-center mb-8 fade-up-1">
                <a href="/" class="inline-flex items-center gap-3">
                    <div class="w-11 h-11 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/20">
                        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-slate-800">SVMS</span>
                </a>
            </div>

            {{-- FORM CARD --}}
            <div class="bg-white shadow-xl shadow-slate-200/50 rounded-3xl p-8 sm:p-10 border border-slate-100 fade-up-2">

                {{-- HEADER --}}
                <div class="mb-8">
                    <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">
                        Masuk ke Dashboard
                    </h2>
                    <p class="text-slate-500 text-sm mt-2 leading-relaxed">
                        Silakan masukkan kredensial Anda untuk melanjutkan
                    </p>
                </div>

                {{-- Session Status --}}
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    {{-- Email --}}
                    <div class="fade-up-3">
                        <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">
                            Email
                        </label>
                        <div class="relative input-glow rounded-xl transition-shadow duration-200">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                </svg>
                            </div>
                            <input id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                placeholder="nama@sekolah.sch.id"
                                class="block w-full pl-12 pr-4 py-3.5 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-800 placeholder-slate-400 focus:bg-white focus:border-indigo-400 focus:ring-indigo-500/20 focus:ring-4 transition-all duration-200 text-sm" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    {{-- Password --}}
                    <div class="fade-up-3">
                        <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">
                            Password
                        </label>
                        <div class="relative input-glow rounded-xl transition-shadow duration-200">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                </svg>
                            </div>
                            <input id="password"
                                type="password"
                                name="password"
                                required
                                placeholder="••••••••"
                                class="block w-full pl-12 pr-4 py-3.5 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-800 placeholder-slate-400 focus:bg-white focus:border-indigo-400 focus:ring-indigo-500/20 focus:ring-4 transition-all duration-200 text-sm" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    {{-- Remember & Forgot --}}
                    <div class="flex items-center justify-between text-sm fade-up-4">
                        <label class="inline-flex items-center cursor-pointer group">
                            <input type="checkbox"
                                name="remember"
                                class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500/30 focus:ring-offset-0 transition">
                            <span class="ml-2.5 text-slate-600 group-hover:text-slate-800 transition-colors">Ingat saya</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                               class="text-indigo-600 hover:text-indigo-700 font-medium hover:underline underline-offset-2 transition-colors">
                                Lupa password?
                            </a>
                        @endif
                    </div>

                    {{-- LOGIN BUTTON --}}
                    <div class="pt-1 fade-up-4">
                        <button type="submit"
                            class="group relative w-full bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white font-semibold py-3.5 rounded-xl transition-all duration-300 shadow-lg shadow-indigo-500/25 hover:shadow-indigo-500/40 hover:scale-[1.01] active:scale-[0.99]">
                            <span class="flex items-center justify-center gap-2">
                                Masuk
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                </svg>
                            </span>
                        </button>
                    </div>

                </form>

            </div>

            {{-- BACK LINK --}}
            <div class="text-center mt-6 fade-up-4">
                <a href="/" class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-indigo-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                    Kembali ke halaman utama
                </a>
            </div>

        </div>

    </div>

</div>

</body>
</html>