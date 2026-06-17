<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Check-in Tamu — SVMS</title>
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
        @keyframes fade-in-up {
            from { opacity: 0; transform: translateY(24px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-float { animation: float 6s ease-in-out infinite; }
        .animate-float-delay { animation: float-delay 7s ease-in-out infinite; }
        .fade-up-1 { animation: fade-in-up 0.6s ease-out both; }
        .fade-up-2 { animation: fade-in-up 0.6s ease-out 0.1s both; }
        .fade-up-3 { animation: fade-in-up 0.6s ease-out 0.2s both; }
        .fade-up-4 { animation: fade-in-up 0.6s ease-out 0.3s both; }
        .fade-up-5 { animation: fade-in-up 0.6s ease-out 0.4s both; }
        .fade-up-6 { animation: fade-in-up 0.6s ease-out 0.5s both; }
        .input-glow:focus-within { box-shadow: 0 0 0 3px rgba(59,130,246,0.15); }
    </style>
</head>
<body class="font-sans antialiased">

<div class="min-h-screen bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950 text-white relative overflow-hidden">

    {{-- BACKGROUND DECORATIONS --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-32 -right-32 w-80 h-80 bg-blue-500/10 rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-1/4 -left-24 w-72 h-72 bg-indigo-500/10 rounded-full blur-3xl animate-float-delay"></div>
        <div class="absolute -bottom-24 right-1/3 w-64 h-64 bg-violet-500/8 rounded-full blur-3xl animate-float"></div>
        <div class="absolute inset-0 opacity-[0.03]"
             style="background-image: linear-gradient(rgba(255,255,255,.1) 1px, transparent 1px),
                                      linear-gradient(90deg, rgba(255,255,255,.1) 1px, transparent 1px);
                    background-size: 60px 60px;">
        </div>
    </div>

    {{-- HEADER --}}
    <header class="relative z-10 flex items-center justify-between px-6 md:px-12 py-5 fade-up-1">
        <a href="/" class="flex items-center gap-3 group">
            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/25 group-hover:shadow-blue-500/40 transition-shadow">
                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21" />
                </svg>
            </div>
            <span class="text-lg font-bold tracking-tight bg-gradient-to-r from-white to-slate-300 bg-clip-text text-transparent">
                SVMS
            </span>
        </a>

        {{-- STEP INDICATOR --}}
        <div class="flex items-center gap-3">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-blue-500 text-white text-xs font-bold flex items-center justify-center shadow-lg shadow-blue-500/30">1</div>
                <div class="hidden sm:block text-xs font-medium text-blue-400">Data Tamu</div>
            </div>
            <div class="w-8 h-px bg-slate-700"></div>
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-slate-700 text-slate-400 text-xs font-bold flex items-center justify-center">2</div>
                <div class="hidden sm:block text-xs font-medium text-slate-500">Foto</div>
            </div>
            <div class="w-8 h-px bg-slate-700"></div>
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-slate-700 text-slate-400 text-xs font-bold flex items-center justify-center">3</div>
                <div class="hidden sm:block text-xs font-medium text-slate-500">Tanda Tangan</div>
            </div>
        </div>
    </header>

    {{-- MAIN CONTENT --}}
    <main class="relative z-10 flex items-center justify-center px-6 py-8 md:py-12">
        <div class="w-full max-w-xl">

            {{-- TITLE --}}
            <div class="text-center mb-8 fade-up-1">
                <div class="inline-flex items-center gap-2 bg-blue-500/10 border border-blue-500/20 text-blue-400 px-4 py-1.5 rounded-full text-xs font-semibold tracking-wide uppercase mb-4">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                    Step 1 of 3
                </div>
                <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight">
                    Data <span class="bg-gradient-to-r from-blue-400 to-indigo-400 bg-clip-text text-transparent">Pengunjung</span>
                </h1>
                <p class="text-slate-400 mt-3 text-sm md:text-base">
                    Silakan lengkapi formulir di bawah untuk melanjutkan proses check-in
                </p>
            </div>

            {{-- FORM CARD --}}
            <div class="bg-white/[0.06] backdrop-blur-xl rounded-3xl border border-white/10 shadow-2xl p-8 md:p-10 fade-up-2">

                <form method="POST" action="/kiosk/camera" class="space-y-5">
                    @csrf

                    {{-- NAMA --}}
                    <div class="fade-up-3">
                        <label for="name" class="block text-sm font-semibold text-slate-300 mb-2">
                            Nama Lengkap <span class="text-red-400">*</span>
                        </label>
                        <div class="relative input-glow rounded-xl transition-shadow duration-200">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                            </div>
                            <input type="text" id="name" name="name" required
                                placeholder="Masukkan nama lengkap"
                                class="block w-full pl-12 pr-4 py-3.5 rounded-xl border border-white/10 bg-white/[0.04] text-white placeholder-slate-500 focus:bg-white/[0.08] focus:border-blue-500/50 focus:ring-blue-500/20 focus:ring-4 transition-all duration-200 text-sm" />
                        </div>
                    </div>

                    {{-- NO HP --}}
                    <div class="fade-up-3">
                        <label for="phone" class="block text-sm font-semibold text-slate-300 mb-2">
                            No. Handphone
                        </label>
                        <div class="relative input-glow rounded-xl transition-shadow duration-200">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                                </svg>
                            </div>
                            <input type="text" id="phone" name="phone"
                                placeholder="08xx-xxxx-xxxx"
                                class="block w-full pl-12 pr-4 py-3.5 rounded-xl border border-white/10 bg-white/[0.04] text-white placeholder-slate-500 focus:bg-white/[0.08] focus:border-blue-500/50 focus:ring-blue-500/20 focus:ring-4 transition-all duration-200 text-sm" />
                        </div>
                    </div>

                    {{-- INSTANSI --}}
                    <div class="fade-up-4">
                        <label for="institution" class="block text-sm font-semibold text-slate-300 mb-2">
                            Instansi / Asal
                        </label>
                        <div class="relative input-glow rounded-xl transition-shadow duration-200">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                                </svg>
                            </div>
                            <input type="text" id="institution" name="institution"
                                placeholder="Nama instansi atau asal"
                                class="block w-full pl-12 pr-4 py-3.5 rounded-xl border border-white/10 bg-white/[0.04] text-white placeholder-slate-500 focus:bg-white/[0.08] focus:border-blue-500/50 focus:ring-blue-500/20 focus:ring-4 transition-all duration-200 text-sm" />
                        </div>
                    </div>

                    <div class="fade-up-4">
                        <label class="block text-sm font-semibold text-slate-300 mb-3">
                            Staff Tujuan <span class="text-red-400">*</span>
                        </label>

                        <!-- SEARCH -->
                        <input type="text"
                            id="staffSearch"
                            placeholder="Cari nama staff..."
                            class="w-full mb-4 rounded-xl border border-white/10 bg-white/[0.04] text-white px-4 py-3 focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500/50">

                        <!-- STAFF LIST -->
                        <div id="staffList"
                            class="grid grid-cols-1 sm:grid-cols-2 gap-3 max-h-64 overflow-y-auto pr-1">

                            @foreach($staffs as $staff)
                            <button type="button"
                                onclick="selectStaff('{{ $staff->id }}','{{ $staff->name }}', this)"
                                class="staff-card text-left p-4 rounded-xl border border-white/10 bg-white/[0.04] hover:bg-blue-500/20 hover:border-blue-500/40 transition">

                                <div class="font-semibold text-white">
                                    {{ $staff->name }}
                                </div>
                                <div class="text-xs text-slate-400">
                                    Staff Sekolah
                                </div>
                            </button>
                            @endforeach

                        </div>

                        <!-- HIDDEN INPUT -->
                        <input type="hidden" name="staff_id" id="staff_id" required>

                        <!-- SELECTED INFO -->
                        <p id="selectedStaff"
                        class="mt-3 text-sm text-blue-400 hidden">
                        Staff dipilih: <span class="font-semibold"></span>
                        </p>
                    </div>

                    {{-- KEPERLUAN --}}
                    <div class="fade-up-5">
                        <label for="purpose" class="block text-sm font-semibold text-slate-300 mb-2">
                            Keperluan
                        </label>
                        <div class="relative input-glow rounded-xl transition-shadow duration-200">
                            <div class="absolute top-0 left-0 pl-4 pt-4 pointer-events-none">
                                <svg class="w-5 h-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                            </div>
                            <textarea id="purpose" name="purpose" rows="3"
                                placeholder="Jelaskan secara singkat keperluan Anda"
                                class="block w-full pl-12 pr-4 py-3.5 rounded-xl border border-white/10 bg-white/[0.04] text-white placeholder-slate-500 focus:bg-white/[0.08] focus:border-blue-500/50 focus:ring-blue-500/20 focus:ring-4 transition-all duration-200 text-sm resize-none"></textarea>
                        </div>
                    </div>

                    {{-- BUTTON --}}
                    <div class="pt-3 fade-up-6">
                        <button type="submit"
                            class="group relative w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-4 rounded-xl transition-all duration-300 shadow-lg shadow-blue-500/25 hover:shadow-blue-500/40 hover:scale-[1.01] active:scale-[0.99]">
                            <span class="flex items-center justify-center gap-2.5">
                                Lanjut Ambil Foto
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                                </svg>
                            </span>
                        </button>
                    </div>

                </form>

            </div>

            {{-- BACK LINK --}}
            <div class="text-center mt-6 fade-up-6">
                <a href="/" class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-blue-400 transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                    Kembali ke halaman utama
                </a>
            </div>

        </div>
    </main>

</div>

</body>
</html>