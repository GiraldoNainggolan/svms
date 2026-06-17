<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Ambil Foto — SVMS</title>

@vite(['resources/css/app.css','resources/js/app.js'])

</head>

<body class="bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950 text-white min-h-screen">

<div class="min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-xl">

        <!-- TITLE -->
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold">
                Ambil Foto Pengunjung
            </h1>
            <p class="text-slate-400 mt-2">
                Posisi wajah di tengah lalu klik Ambil Foto
            </p>
        </div>

        <!-- CARD -->
        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-6 shadow-2xl">

            <!-- VIDEO -->
            <div class="overflow-hidden rounded-xl bg-black">
                <video id="video"
                    autoplay
                    playsinline
                    class="w-full h-72 object-cover">
                </video>
            </div>

            <!-- PREVIEW FOTO -->
            <img id="preview"
                class="hidden mt-4 rounded-xl border border-white/10 w-full"/>

            <!-- CANVAS -->
            <canvas id="canvas" class="hidden"></canvas>

            <!-- FORM -->
            <form method="POST" action="/kiosk/signature" class="mt-6 space-y-3">
                @csrf

                <input type="hidden" name="photo" id="photo">

                <button type="button"
                    onclick="capture()"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-semibold transition">
                    Ambil Foto
                </button>

                <button type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl font-semibold transition">
                    Lanjut Tanda Tangan →
                </button>

            </form>

        </div>

    </div>

</div>

<script>
const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const photoInput = document.getElementById('photo');
const preview = document.getElementById('preview');

let stream = null;

// START CAMERA
async function startCamera(){
    try{
        stream = await navigator.mediaDevices.getUserMedia({
            video: {
                facingMode: "user"
            },
            audio: false
        });

        video.srcObject = stream;

    }catch(err){
        alert("Kamera tidak bisa diakses");
        console.error(err);
    }
}

startCamera();


// CAPTURE FOTO (compressed JPEG)
function capture(){

    canvas.width = 640;
    canvas.height = 480;

    const context = canvas.getContext('2d');
    context.drawImage(video, 0, 0, 640, 480);

    // Compress as JPEG quality 0.7 (60-75% smaller)
    const imageData = canvas.toDataURL('image/jpeg', 0.7);

    photoInput.value = imageData;

    // preview hasil
    preview.src = imageData;
    preview.classList.remove("hidden");

    alert("Foto berhasil diambil");
}
</script>

</body>
</html>