<div class="min-h-screen bg-slate-100 flex items-center justify-center p-6">

    <div class="w-full max-w-4xl bg-white rounded-3xl shadow-xl overflow-hidden">

        <!-- HEADER -->
        <div class="text-center py-10 border-b bg-slate-50">
            <h1 class="text-3xl md:text-4xl font-bold text-slate-800">
                School Visitor Management
            </h1>
            <p class="text-slate-500 mt-2">
                Pilih akses sesuai kebutuhan Anda
            </p>
        </div>

        <!-- SPLIT SECTION -->
        <div class="grid md:grid-cols-2">

            <!-- VISITOR SIDE -->
            <div class="p-10 flex flex-col items-center text-center border-r border-slate-200">
                
                <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-2xl mb-4">
                    👤
                </div>

                <h2 class="text-xl font-semibold text-slate-800 mb-2">
                    Saya Tamu
                </h2>

                <p class="text-slate-500 mb-6">
                    Isi buku tamu dan lakukan check-in dengan cepat.
                </p>

                <a href="/kiosk"
                   class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-semibold text-lg transition shadow">
                    Masuk Kiosk
                </a>

            </div>

            <!-- STAFF SIDE -->
            <div class="p-10 flex flex-col items-center text-center">

                <div class="w-16 h-16 bg-slate-200 text-slate-700 rounded-full flex items-center justify-center text-2xl mb-4">
                    🛡️
                </div>

                <h2 class="text-xl font-semibold text-slate-800 mb-2">
                    Staff / Admin
                </h2>

                <p class="text-slate-500 mb-6">
                    Login untuk mengelola data tamu dan dashboard.
                </p>

                <a href="/login"
                   class="w-full bg-slate-800 hover:bg-slate-900 text-white py-3 rounded-xl font-semibold text-lg transition shadow">
                    Login Dashboard
                </a>

            </div>

        </div>

    </div>

</div>