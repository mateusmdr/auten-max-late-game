@extends('layouts.public')

@section('content')
    <section class="section container text-center">
        <hgroup class="mb-5 text-center">
            <h1 class="mb-5 fw-bold">Atenção!</h1>
            <h3 class="mb-4">Seu acesso à plataforma foi bloqueado pelo seguinte motivo:</h3>
            <h3 class="fw-bold mb-4" style="color: rgb(235, 66, 99);">{{$reason}}</h3>
        </hgroup>
        <div class="pt-5 d-flex flex-column align-items-center justify-content-center">
            <h4>Entre em contato pelo email fornecido abaixo para mais informações:</h4>
            <a class="fs-3" href="mailto:contato@maxlategame.com">contato@maxlategame.com</a>
        </div>
    </section>
@endsection

@section('footer')
    <div class="d-flex flex-column">        
        <div class="mx-auto my-5">
            <img class="img-header-logo"/>
        </div>
    </div>
@endsection