@extends('layouts.public',['isForm' => true])

@section('content')
    <aside class="form-background col-6 d-none d-lg-block">
        @include('components.blurry_circle',['index' => 1])
        <img class="img-poker-chips-3"/>
    </aside>
    <div class="row justify-content-center">
        @yield('form')
    </div>
    <div class="top-spacing"></div>
@endsection