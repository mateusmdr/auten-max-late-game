<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{public('logo.png')}}" class="logo" alt="MaxLateGame Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
