<div class="min-h-screen bg-slate-100 flex items-center justify-center p-6">

    <div class="w-full max-w-2xl bg-white shadow-xl rounded-2xl p-8">

        <!-- TITLE -->
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-slate-800">
                Form Buku Tamu
            </h2>
            <p class="text-slate-500 mt-2">
                Silakan isi data dengan benar sebelum check-in
            </p>
        </div>

        <!-- SUCCESS ALERT -->
        @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-green-100 text-green-700 border border-green-300">
            {{ session('success') }}
        </div>
        @endif

        <!-- FORM -->
        <form method="POST" action="/kiosk/store" class="space-y-6">
            @csrf

            <!-- Nama -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Nama Lengkap
                </label>
                <input
                    type="text"
                    name="name"
                    placeholder="Masukkan nama"
                    required
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                >
            </div>

            <!-- No HP -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Nomor HP
                </label>
                <input
                    type="text"
                    name="phone"
                    placeholder="08xxxxxxxxxx"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                >
            </div>

            <!-- Instansi -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Instansi / Asal
                </label>
                <input
                    type="text"
                    name="institution"
                    placeholder="Contoh: Universitas / Perusahaan"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                >
            </div>

            <!-- Keperluan -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Keperluan
                </label>
                <textarea
                    name="purpose"
                    rows="4"
                    placeholder="Tuliskan tujuan kunjungan..."
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                ></textarea>
            </div>

            <!-- BUTTON -->
            <button
                type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl text-lg transition duration-200 shadow-md"
            >
                Check In
            </button>

        </form>
    </div>

</div>