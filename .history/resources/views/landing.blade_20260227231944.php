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
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes pulse-glow {
        0%, 100% { box-shadow: 0 0 20px rgba(59,130,246,0.3); }
        50% { box-shadow: 0 0 40px rgba(59,130,246,0.6); }
    }
    .animate-float { animation: float 6s ease-in-out infinite; }
    .animate-float-delay { animation: float-delay 7s ease-in-out infinite; }
    .animate-gradient { animation: gradient-shift 8s ease infinite; background-size: 200% 200%; }
    .fade-up-1 { animation: fade-in-up 0.8s ease-out both; }
    .fade-up-2 { animation: fade-in-up 0.8s ease-out 0.15s both; }
    .fade-up-3 { animation: fade-in-up 0.8s ease-out 0.3s both; }
    .fade-up-4 { animation: fade-in-up 0.8s ease-out 0.45s both; }
    .fade-up-5 { animation: fade-in-up 0.8s ease-out 0.6s both; }
    .card-glow:hover { box-shadow: 0 0 40px rgba(59,130,246,0.15); }
    .card-glow-purple:hover { box-shadow: 0 0 40px rgba(139,92,246,0.15); }
</style>

<div class="min-h-screen bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950 text-white flex flex-col relative overflow-hidden">

    {{-- BACKGROUND DECORATIONS --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl animate-float"></div>
        <div class="absolute top-1/3 -left-32 w-80 h-80 bg-indigo-500/10 rounded-full blur-3xl animate-float-delay"></div>
        <div class="absolute -bottom-32 right-1/4 w-72 h-72 bg-violet-500/8 rounded-full blur-3xl animate-float"></div>

        {{-- GRID PATTERN --}}
        <div class="absolute inset-0 opacity-[0.03]"
             style="background-image: linear-gradient(rgba(255,255,255,.1) 1px, transparent 1px),
                                      linear-gradient(90deg, rgba(255,255,255,.1) 1px, transparent 1px);
                    background-size: 60px 60px;">
        </div>
    </div>

    {{-- TOP NAV BAR --}}
    <nav class="relative z-10 flex items-center justify-between px-6 md:px-12 py-5 fade-up-1">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/25">
                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21" />
                </svg>
            </div>
            <span class="text-lg font-bold tracking-tight bg-gradient-to-r from-white to-slate-300 bg-clip-text text-transparent">
                SVMS
            </span>
        </div>

        {{-- STATUS BADGE --}}
        <div class="inline-flex items-center gap-2 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 px-4 py-2 rounded-full text-xs font-semibold tracking-wide uppercase">
            <span class="relative flex h-2 w-2">
                <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex h-2 w-2 rounded-full bg-emerald-400"></span>
            </span>
            Sistem Aktif
        </div>
    </nav>

    {{-- HERO --}}
    <section class="relative z-10 flex-1 flex items-center justify-center px-6 md:px-12 py-8">

        <div class="max-w-6xl w-full grid lg:grid-cols-2 gap-16 items-center">

            {{-- LEFT HERO --}}
            <div class="space-y-8">

                <div class="fade-up-1">
                    <p class="text-sm font-semibold tracking-widest uppercase text-blue-400 mb-4">
                        Digital Guest Book
                    </p>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold leading-[1.1] tracking-tight">
                        School Visitor
                        <span class="block bg-gradient-to-r from-blue-400 via-indigo-400 to-violet-400 bg-clip-text text-transparent animate-gradient">
                            Management System
                        </span>
                    </h1>
                </div>

                <p class="fade-up-2 text-slate-400 text-lg md:text-xl leading-relaxed max-w-lg">
                    Sistem digital buku tamu sekolah yang <span class="text-slate-200 font-medium">cepat</span>,
                    <span class="text-slate-200 font-medium">aman</span>, dan
                    <span class="text-slate-200 font-medium">modern</span>.
                    Pilih akses sesuai kebutuhan Anda.
                </p>

                {{-- STATS --}}
                <div class="fade-up-3 flex items-center gap-8 pt-2">
                    <div>
                        <div class="text-2xl font-bold text-white">24/7</div>
                        <div class="text-xs text-slate-500 uppercase tracking-wide mt-1">Operasional</div>
                    </div>
                    <div class="w-px h-10 bg-slate-700"></div>
                    <div>
                        <div class="text-2xl font-bold text-white">Real-time</div>
                        <div class="text-xs text-slate-500 uppercase tracking-wide mt-1">Monitoring</div>
                    </div>
                    <div class="w-px h-10 bg-slate-700"></div>
                    <div>
                        <div class="text-2xl font-bold text-white">100%</div>
                        <div class="text-xs text-slate-500 uppercase tracking-wide mt-1">Digital</div>
                    </div>
                </div>

            </div>

            {{-- RIGHT ILLUSTRATION --}}
            <div class="hidden lg:flex justify-center fade-up-4">
                <div class="relative">
                    {{-- MAIN CARD --}}
                    <div class="relative bg-white/[0.07] backdrop-blur-xl rounded-3xl p-10 border border-white/10 shadow-2xl w-80">
                        <div class="flex items-center gap-3 mb-8">
                            <div class="w-3 h-3 rounded-full bg-red-400/80"></div>
                            <div class="w-3 h-3 rounded-full bg-yellow-400/80"></div>
                            <div class="w-3 h-3 rounded-full bg-green-400/80"></div>
                        </div>

                        <div class="space-y-5">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-2xl bg-blue-500/20 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-semibold text-white">Check-in Tamu</div>
                                    <div class="text-xs text-slate-400">Self-service kiosk</div>
                                </div>
                            </div>

                            <div class="h-px bg-gradient-to-r from-transparent via-slate-600 to-transparent"></div>

                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-2xl bg-violet-500/20 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-violet-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-semibold text-white">Keamanan</div>
                                    <div class="text-xs text-slate-400">Data terenkripsi</div>
                                </div>
                            </div>

                            <div class="h-px bg-gradient-to-r from-transparent via-slate-600 to-transparent"></div>

                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-2xl bg-emerald-500/20 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-semibold text-white">Laporan</div>
                                    <div class="text-xs text-slate-400">Analitik real-time</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- FLOATING ACCENT --}}
                    <div class="absolute -top-4 -right-4 w-20 h-20 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl opacity-20 blur-xl animate-float"></div>
                    <div class="absolute -bottom-4 -left-4 w-16 h-16 bg-gradient-to-br from-violet-500 to-purple-600 rounded-2xl opacity-20 blur-xl animate-float-delay"></div>
                </div>
            </div>

        </div>

    </section>

    {{-- ACTION CARDS --}}
    <section class="relative z-10 pb-12 px-6 md:px-12">

        <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-6">

            {{-- VISITOR CARD --}}
            <a href="/kiosk"
               class="fade-up-4 group relative bg-white rounded-2xl p-8 md:p-10 shadow-xl shadow-black/10 hover:shadow-2xl hover:shadow-blue-500/10 hover:scale-[1.02] transition-all duration-500 card-glow overflow-hidden">

                {{-- CORNER DECORATION --}}
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-bl from-blue-50 to-transparent rounded-bl-[80px]"></div>

                <div class="relative">
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-blue-500/30 group-hover:shadow-blue-500/50 transition-shadow duration-500">
                            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </div>
                        <span class="text-xs font-bold tracking-widest uppercase text-blue-500 bg-blue-50 px-3 py-1.5 rounded-full">
                            Visitor
                        </span>
                    </div>

                    <h2 class="text-2xl font-bold text-slate-800 mb-2">
                        Saya Tamu
                    </h2>

                    <p class="text-slate-500 mb-6 leading-relaxed">
                        Check-in dengan cepat menggunakan sistem buku tamu digital. Tidak perlu antri.
                    </p>

                    <div class="flex items-center gap-2 text-blue-600 font-semibold group-hover:gap-4 transition-all duration-300">
                        Mulai Check-in
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </div>
                </div>

            </a>

            {{-- STAFF CARD --}}
            <a href="/login"
               class="fade-up-5 group relative bg-white/[0.06] backdrop-blur-xl border border-white/10 rounded-2xl p-8 md:p-10 shadow-xl hover:shadow-2xl hover:shadow-violet-500/10 hover:scale-[1.02] hover:bg-white/[0.1] transition-all duration-500 card-glow-purple overflow-hidden">

                {{-- CORNER DECORATION --}}
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-bl from-violet-500/10 to-transparent rounded-bl-[80px]"></div>

                <div class="relative">
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-14 h-14 bg-gradient-to-br from-violet-500 to-purple-600 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-violet-500/30 group-hover:shadow-violet-500/50 transition-shadow duration-500">
                            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                            </svg>
                        </div>
                        <span class="text-xs font-bold tracking-widest uppercase text-violet-300 bg-violet-500/10 border border-violet-500/20 px-3 py-1.5 rounded-full">
                            Internal
                        </span>
                    </div>

                    <h2 class="text-2xl font-bold text-white mb-2">
                        Staff / Admin
                    </h2>

                    <p class="text-slate-400 mb-6 leading-relaxed">
                        Login untuk memonitor pengunjung dan mengelola sistem secara real-time.
                    </p>

                    <div class="flex items-center gap-2 text-violet-300 font-semibold group-hover:gap-4 group-hover:text-violet-200 transition-all duration-300">
                        Masuk Dashboard
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </div>
                </div>

            </a>

        </div>

    </section>

    {{-- FOOTER --}}
    <footer class="relative z-10 text-center pb-8 pt-4">
        <div class="flex items-center justify-center gap-2 text-slate-500 text-sm">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21" />
            </svg>
            <span>&copy; {{ date('Y') }} School Visitor Management System</span>
        </div>
    </footer>

</div>