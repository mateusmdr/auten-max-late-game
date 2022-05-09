@extends('layouts.form')

@section('form')
    @component('components.public_form',['action' => route('register',['step' => 2]), 'title' => 'Cadastre-se', 'submitMessage' => 'Cadastrar', 'formClasses' => 'px-5 px-5 col-sm-5 col-11 top-spacing'])
        <div class="form-stepper mb-5">
            <div class="d-flex flex-row">
                <div class="step completed-step me-1">
                    <i class="bi bi-circle-fill"></i>
                    <span class="ms-2">Dados pessoais</span>
                </div>
                <div class="step current-step">
                    <i class="bi bi-dash-lg m-0"></i>
                    <i class="bi bi-circle m-0"></i>
                    <span class="ms-2">Confirmação</span>
                </div>
            </div>
        </div>
        
        <hgroup class="">
            <h3 class="fw-bold form-grey" style="font-weight: 18px">Você terá 14 dias gratuitos para conhecer as funcionalidades</h3>
            <h4 class="fw-light form-grey mt-3 mb-5">Após os 14 dias, para ter o acesso ilimitado novamente, você poderá contratar um dos planos disponíveis.</h4>
        </hgroup>

        <div class="input-container">            
            <div class="form-check">
                <input class="form-check-input me-2" type="checkbox" name="eula" id="eula">

                <label class="form-check-label form-grey" for="eula">
                    Li e aceito os <a href="{{asset('storage/eula.pdf')}}" class="fw-bold text-decoration-underline" target="_blank">Termos de Uso</a>
                </label>
            </div>
            @error('eula')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            
        </div>
    @endcomponent
@endsection