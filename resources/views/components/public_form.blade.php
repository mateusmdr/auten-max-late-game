<form method="POST" action="{{ $action }}" class="px-5 pt-5">
    @csrf
    <div class="form-title mb-5">
        <h2 class="fw-normal">{{$title}}</h2>
    </div>
    {{$slot}}
</form>