<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Check-In Berhasil — SVMS</title>
@vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950 text-white min-h-screen">

<div class="min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-md text-center">

        <!-- SUCCESS ICON -->
        <div class="mx-auto w-24 h-24 bg-green-500/20 rounded-full flex items-center justify-center mb-6">
            <svg class="w-12 h-12 text-green-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
        </div>

        <!-- CARD -->
        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-8 shadow-2xl">

            <h2 class="text-3xl font-bold text-green-400">
                Check-In Berhasil!
            </h2>

            <p class="text-slate-400 mt-3">
                Silakan tunggu, staff akan segera menemui Anda.
            </p>

            <!-- COUNTDOWN -->
            <div class="mt-6">
                <p class="text-sm text-slate-500">
                    Kembali ke halaman utama dalam
                </p>
                <span id="countdown" class="text-4xl font-bold text-blue-400">5</span>
                <p class="text-sm text-slate-500">detik</p>
            </div>

            <a href="/kiosk"
               class="inline-block mt-6 w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-semibold transition">
                Tamu Berikutnya
            </a>

        </div>

    </div>

</div>

<script>
let seconds = 5;
const el = document.getElementById('countdown');

const timer = setInterval(() => {
    seconds--;
    el.textContent = seconds;

    if (seconds <= 0) {
        clearInterval(timer);
        window.location.href = '/kiosk';
    }
}, 1000);
</script>

</body>
</html>