<form method="{{$method ?? 'POST'}}" action="{{ $action }}" class="{{$formClasses}}">
    @csrf
    <div class="form-title mb-5">
        <h2 class="fw-normal">{{$title}}</h2>
    </div>
    {{$slot}}
    <div class="row mb-0 mt-4">
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn submit-btn">
                {{$submitMessage}}
            </button>
        </div>
    </div>
</form>