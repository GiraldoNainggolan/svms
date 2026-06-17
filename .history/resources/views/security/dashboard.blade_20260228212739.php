<table class="w-full text-sm">

<tr>
    <th>Nama</th>
    <th>Staff</th>
    <th>Signature</th>
</tr>

@foreach($visitors as $visitor)
<tr>

<td>{{ $visitor->name }}</td>

<td>{{ $visitor->staff->name ?? '-' }}</td>

<td>
@if($visitor->signature_path)
<img src="{{ asset('storage/'.$visitor->signature_path) }}"
class="w-32 rounded border">
@endif
</td>

</tr>
@endforeach

</table>