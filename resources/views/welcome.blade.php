@extends('layouts.public')

@section('content')
    <section class="section container text-md-start text-center px-sm-0 px-5">
        <div class="row">
            <hgroup class="col-md-6 col-12">
                <img class="img-logo"/>
                <h1 class="mt-5">Otimize sua agenda</h1>
                <h1 class="mb-5">de torneios</h1>
                @include('components.submit_button',['text' => "Quero me cadastrar", 'href' => "./register"])
            </hgroup>
            <aside class="position-relative col-6 d-none d-lg-block">
                @component('components.floating_background',['left' => false, 'offset' => 0])
                    @include('components.blurry_circle',['index' => 1])
                    <img class="img-poker-chips-1 position-absolute"/>
                @endcomponent
            </aside>
        </div>
    </section>
    <section class="section container text-md-start text-center px-sm-0 px-5">
        <div class="row">
            <hgroup class="col-md-6 col-12 mb-5">
                <h2 class="mb-5">Organize seu grind</h2>
                <p class="mb-4">Sabe aquele momento em que faltam 15 minutos para o registro do <br/>
                torneio, e você simplesmente esqueceu?</p>
                <p class="fw-bold">Estamos aqui para evitar esse problema!</p>
            </hgroup>
            <div class="col-md-6 col-12 d-flex align-items-center justify-content-end flex-column">
                <div class="custom-card">
                    <i class="bi bi-arrow-up arrow-up"></i>
                    <span class="fw-bold">Potencialize o seu tempo</span>
                </div>
                <div class="custom-card">
                    <i class="bi bi-arrow-up arrow-up"></i>
                    <span class="fw-bold">Aumente seu EV</span>
                </div>
            </div>
        </div>
    </section>
    <section class="section container position-relative text-md-start text-center px-sm-0 px-5">
        <div class="row justify">
            <aside class="col-6 d-none d-lg-block bottom-offset">
                @component('components.floating_background',['left' => true, 'offset' => 0])
                    @include('components.blurry_circle',['index' => 2])
                    <img class="img-poker-chips-2 position-absolute"/>
                @endcomponent
            </aside>
            <hgroup class="col-md-6 col-12 top-spacing">
                <h2 class="fw-normal pe-md-5 separated-lines">Seja notificado sempre que desejar entrar em um torneio, sem correr o risco de perder o tempo de inscrição</h2>
                <h4 class="fw-light mt-5 mb-4">Possuímos compatibilidade com</h4>
                <ul>
                    <div class="row mt-4">
                        <li class="col-6">
                            <img class="platform img-platform-pokerstars col-6"/>
                        </li>
                        <li class="col-6">
                            <img class="platform img-platform-partypoker col-6"/>
                        </li>
                    </div>
                    <div class="row mt-4">
                        <li class="col-6">
                            <img class="platform img-platform-ggpoker col-6"/>
                        </li>
                        <li class="col-6">
                            <img class="platform img-platform-wpn col-6"/>
                        </li>
                    </div>
                </ul>
            </hgroup>
        </div>
    </section>
    <section class="section container text-center px-sm-0 px-5">
        <h2 class="mb-4">Ganhe 14 dias gratuitos</h2>
        <h4 class="mb-5">ao fazer o cadastro para conhecer a plataforma</h4>
        <img class="img-cards mb-5 mt-4"/>
        <h4 class="mt-5">Após os 14 dias, para ter o acesso ilimitado novamente, você poderá contratar um dos planos disponíveis.</h4>
        <aside class="position-relative col-6 d-none d-lg-block" style="bottom: 200px">
            @component('components.floating_background',['left' => false, 'offset' => -700])
                @include('components.blurry_circle',['index' => 1])
            @endcomponent
        </aside>
    </section>
    <section class="section container text-center px-sm-0 px-5">
        <h2 class="mb-5">Conheça nossos planos</h2>
        <div class="row px-6">
            @include('components.plan_card',[
                'color' => '#EB4263',
                'title' => 'Anual',
                'description' => 'acesso completo à plataforma',
                'price' => '199,99'
            ])
            @include('components.plan_card',[
                'color' => '#B376F8',
                'title' => 'Semestral',
                'description' => 'acesso completo à plataforma',
                'price' => '119,99'
            ])
            @include('components.plan_card',[
                'color' => '#05F28E',
                'title' => 'Mensal',
                'description' => 'acesso completo à plataforma',
                'price' => '29,99'
            ])
    </div>
    </section>
@endsection

@section('footer')
    <div class="d-flex flex-column">
        <div class="mx-auto my-4">
            @include('components.submit_button',['text' => "Quero me cadastrar", 'href' => "./register"])
        </div>
        
        <div class="mx-auto my-5">
            <img class="img-header-logo"/>
        </div>
    </div>
@endsection