<div class="min-h-screen bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white flex flex-col">

    <!-- HERO -->
    <section class="flex-1 flex items-center justify-center px-6">

        <div class="max-w-6xl w-full grid lg:grid-cols-2 gap-12 items-center">

            <!-- LEFT HERO -->
            <div class="space-y-6">

                <h1 class="text-4xl md:text-5xl font-extrabold leading-tight">
                    School Visitor <br>
                    Management System
                </h1>

                <p class="text-slate-300 text-lg">
                    Sistem digital buku tamu sekolah yang cepat, aman, dan modern.
                    Pilih akses sesuai kebutuhan Anda.
                </p>

                <!-- STATUS BADGE -->
                <div class="inline-flex items-center gap-2 bg-green-500/20 text-green-300 px-4 py-2 rounded-full text-sm font-medium">
                    <span class="w-2 h-2 bg-green-400 rounded-full animate-ping"></span>
                    System Ready
                </div>

            </div>

            <!-- RIGHT ILLUSTRATION CARD -->
            <div class="hidden lg:block">
                <div class="bg-white/10 backdrop-blur-lg rounded-3xl p-8 border border-white/20 shadow-2xl">
                    <h3 class="text-xl font-semibold mb-3">
                        Selamat Datang
                    </h3>
                    <p class="text-slate-300">
                        Silakan pilih mode akses di bawah untuk melanjutkan.
                    </p>
                </div>
            </div>

        </div>

    </section>

    <!-- ACTION CARDS -->
    <section class="pb-12 px-6">

        <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-6">

            <!-- VISITOR CARD -->
            <a href="/kiosk"
               class="group bg-white text-slate-800 rounded-2xl p-8 shadow-xl hover:scale-[1.02] transition duration-300">

                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-2xl">
                        👤
                    </div>
                    <span class="text-sm text-blue-600 font-semibold">
                        Visitor Mode
                    </span>
                </div>

                <h2 class="text-2xl font-bold mb-2">
                    Saya Tamu
                </h2>

                <p class="text-slate-500 mb-4">
                    Check-in dengan cepat menggunakan sistem buku tamu digital.
                </p>

                <div class="text-blue-600 font-semibold group-hover:translate-x-2 transition">
                    Mulai Check-in →
                </div>

            </a>

            <!-- STAFF CARD -->
            <a href="/login"
               class="group bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl p-8 shadow-xl hover:scale-[1.02] transition duration-300">

                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 bg-white/20 text-white rounded-full flex items-center justify-center text-2xl">
                        🛡️
                    </div>
                    <span class="text-sm text-slate-300 font-semibold">
                        Internal Access
                    </span>
                </div>

                <h2 class="text-2xl font-bold mb-2">
                    Staff / Admin
                </h2>

                <p class="text-slate-300 mb-4">
                    Login untuk memonitor pengunjung dan mengelola sistem.
                </p>

                <div class="text-white font-semibold group-hover:translate-x-2 transition">
                    Masuk Dashboard →
                </div>

            </a>

        </div>

    </section>

    <!-- FOOTER -->
    <footer class="text-center text-slate-400 text-sm pb-6">
        © {{ date('Y') }} School Visitor System
    </footer>

</div>