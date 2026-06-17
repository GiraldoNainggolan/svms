<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Tanda Tangan — SVMS</title>

@vite(['resources/css/app.css','resources/js/app.js'])

</head>

<body class="bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950 text-white min-h-screen">

<div class="min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-2xl">

        <!-- TITLE -->
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold">
                Tanda Tangan Pengunjung
            </h1>
            <p class="text-slate-400 mt-2">
                Silakan tanda tangan pada area di bawah ini
            </p>
        </div>

        <!-- CARD -->
        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-6 shadow-2xl">

            <!-- CANVAS -->
            <div class="bg-white rounded-xl overflow-hidden">
                <canvas id="signature"
                    class="w-full h-60 cursor-crosshair"></canvas>
            </div>

            <p class="text-xs text-slate-400 mt-2">
                Gunakan jari atau mouse untuk tanda tangan
            </p>

            <!-- FORM -->
            <form method="POST" action="/kiosk/store" class="mt-6 space-y-3">
            @csrf

                <input type="hidden" name="signature" id="signature_data">

                <!-- ACTION BUTTONS -->
                <div class="grid grid-cols-2 gap-3">

                    <button type="button"
                        onclick="clearSignature()"
                        class="bg-slate-700 hover:bg-slate-600 text-white py-3 rounded-xl font-semibold transition">
                        Hapus
                    </button>

                    <button type="button"
                        onclick="saveSignature()"
                        class="bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-semibold transition">
                        Simpan
                    </button>

                </div>

                <button type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl font-bold text-lg transition">
                    Finish Check In →
                </button>

            </form>

        </div>

    </div>

</div>

<!-- SCRIPT -->
<script>
const canvas = document.getElementById("signature");
const ctx = canvas.getContext("2d");

let drawing = false;
let hasSignature = false;

// FIX CANVAS SIZE (ANTI BLUR)
function resizeCanvas() {
    const ratio = window.devicePixelRatio || 1;

    canvas.width = canvas.offsetWidth * ratio;
    canvas.height = canvas.offsetHeight * ratio;

    ctx.scale(ratio, ratio);
    ctx.lineWidth = 2;
    ctx.lineCap = "round";
    ctx.strokeStyle = "#000";
}

resizeCanvas();
window.addEventListener("resize", resizeCanvas);

// START DRAW
function startDraw(e){
    drawing = true;
    hasSignature = true;
    ctx.beginPath();
    draw(e);
}

function endDraw(){
    drawing = false;
}

// DRAW FUNCTION (MOUSE + TOUCH)
function draw(e){
    if(!drawing) return;

    const rect = canvas.getBoundingClientRect();

    const x = (e.touches ? e.touches[0].clientX : e.clientX) - rect.left;
    const y = (e.touches ? e.touches[0].clientY : e.clientY) - rect.top;

    ctx.lineTo(x,y);
    ctx.stroke();
}

// EVENTS
canvas.addEventListener("mousedown", startDraw);
canvas.addEventListener("mouseup", endDraw);
canvas.addEventListener("mousemove", draw);

canvas.addEventListener("touchstart", startDraw);
canvas.addEventListener("touchend", endDraw);
canvas.addEventListener("touchmove", draw);

// CLEAR
function clearSignature(){
    ctx.clearRect(0,0,canvas.width,canvas.height);
    hasSignature = false;
    document.getElementById("signature_data").value = "";
}

// SAVE (resized + compressed)
function saveSignature(){

    if(!hasSignature){
        alert("Silakan tanda tangan terlebih dahulu.");
        return;
    }

    // Resize to 500x200 for smaller file size
    const resized = document.createElement('canvas');
    resized.width = 500;
    resized.height = 200;

    const rctx = resized.getContext('2d');
    rctx.drawImage(canvas, 0, 0, 500, 200);

    document.getElementById("signature_data").value =
        resized.toDataURL('image/png', 0.8);

    alert("Tanda tangan tersimpan 👍");
}
</script>

</body>
</html>