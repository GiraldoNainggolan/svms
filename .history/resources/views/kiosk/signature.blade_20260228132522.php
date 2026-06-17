<canvas id="signature"
class="border rounded-xl w-full h-60"></canvas>

<form method="POST" action="/kiosk/store">
@csrf

<input type="hidden" name="signature" id="signature_data">

<button type="button" onclick="saveSignature()"
class="w-full bg-blue-600 text-white py-3 rounded-xl">
Simpan Tanda Tangan
</button>

<button type="submit"
class="w-full mt-3 bg-green-600 text-white py-3 rounded-xl">
Finish Check In →
</button>

</form>