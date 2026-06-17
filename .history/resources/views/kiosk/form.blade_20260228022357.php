<form method="POST" action="/kiosk/camera" class="space-y-6">
@csrf

<input type="text" name="name" placeholder="Nama"
class="w-full border rounded-xl p-3" required>

<input type="text" name="phone" placeholder="No HP"
class="w-full border rounded-xl p-3">

<input type="text" name="institution" placeholder="Instansi"
class="w-full border rounded-xl p-3">

<select name="staff_id"
class="w-full border rounded-xl p-3" required>
<option value="">Pilih Staff Tujuan</option>

@foreach($staffs as $staff)
<option value="{{ $staff->id }}">
{{ $staff->name }}
</option>
@endforeach

</select>

<textarea name="purpose"
class="w-full border rounded-xl p-3"
placeholder="Keperluan"></textarea>

<button class="w-full bg-blue-600 text-white py-3 rounded-xl">
Lanjut Ambil Foto →
</button>

</form>