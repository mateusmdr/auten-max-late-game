@extends('layouts.form')

@section('form')
    @component('components.public_form',['method' => 'GET', 'action' => route('login'), 'title' => 'Cadastre-se', 'submitMessage' => 'Entrar na plataforma','formClasses' => 'px-5 px-5 col-sm-5 col-11 top-spacing'])
        <div class="form-stepper mb-5">
            <div class="d-flex flex-row">
                <div class="step completed-step me-1">
                    <i class="bi bi-circle-fill"></i>
                    <span class="ms-2">Dados pessoais</span>
                </div>
                <div class="step completed-step">
                    <i class="bi bi-dash-lg m-0"></i>
                    <i class="bi bi-circle-fill m-0"></i>
                    <span class="ms-2">Confirmação</span>
                </div>
            </div>
        </div>

        <h4 class="form-grey fw-light">Um e-mail foi enviado com o link de confirmação, verifique o endereço de e-mail para finalizar o seu cadastro.</h4>
    @endcomponent
@endsection