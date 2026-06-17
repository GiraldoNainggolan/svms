getUserMedia()

<video id="video" autoplay class="rounded-xl w-full"></video>

<canvas id="canvas" class="hidden"></canvas>

<form method="POST" action="/kiosk/signature">
@csrf

<input type="hidden" name="photo" id="photo">

<button type="button" onclick="capture()"
class="w-full bg-blue-600 text-white py-3 rounded-xl">
Ambil Foto
</button>

<button type="submit"
class="w-full mt-3 bg-green-600 text-white py-3 rounded-xl">
Lanjut Tanda Tangan →
</button>

</form>