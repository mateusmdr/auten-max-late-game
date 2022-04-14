@if ($left)
    <aside class="position-absolute top-50 start-0 translate-middle" style="margin-left: {{$offset}}px;z-index:-1">
        {{ $slot }}
    </aside>
@else
    <aside class="position-absolute top-50 end-0" style="margin-right: {{$offset}}px;transform:translate(50%, -50%);z-index:-1">
        {{ $slot }}
    </aside>
@endif