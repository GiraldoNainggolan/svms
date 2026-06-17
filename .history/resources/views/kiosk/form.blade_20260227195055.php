<h2>Form Buku Tamu</h2>

@if(session('success'))
<p>{{ session('success') }}</p>
@endif

<form method="POST" action="/kiosk/store">
@csrf

<input type="text" name="name" placeholder="Nama" required>
<input type="text" name="phone" placeholder="No HP">
<input type="text" name="institution" placeholder="Instansi">

<textarea name="purpose" placeholder="Keperluan"></textarea>

<button type="submit">Check In</button>

</form>