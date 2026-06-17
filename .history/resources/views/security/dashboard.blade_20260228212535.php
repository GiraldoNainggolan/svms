<h2>Visitor Aktif</h2>

<table border="1">
<tr>
    <th>Nama</th>
    <th>Tujuan</th>
    <th>Status</th>
</tr>

@foreach($visitors as $v)
<tr>
    <td>{{ $v->name }}</td>
    <td>{{ $v->purpose }}</td>
    <td>{{ $v->status }}</td>
</tr>
@endforeach

<img src="{{ asset('storage/'.$visitor->signature_path) }}"
class="w-40 rounded border">

</table>