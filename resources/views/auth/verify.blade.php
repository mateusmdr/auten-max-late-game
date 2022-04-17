@extends('layouts.form')

@section('form')
    @component('components.public_form',['action' => route('verification.resend'), 'title' => 'Verificar e-mail', 'submitMessage' => 'Reenviar e-mail', 'formClasses' => 'px-5 px-5 col-sm-6 col-11 top-spacing'])
    <h4 class="form-grey fw-light mb-3">
        Confirme o seu endereço de e-mail para finalizar o seu cadastro na plataforma.
    </h4>
    <h5 class="form-grey">
        Antes de proceder, cheque a caixa de spam caso não tenha recebido o email.
    </h5>
    @if (session('resent'))
        <div class="h4 form-green mt-5 @error('msg') d-none @enderror" role="alert">
            Um novo e-mail foi enviado com o link de confirmação.
        </div>
    @endif

    @error('throttle')
        <div class="h4 form-red mt-5" role="alert">
            Limite de e-mails excedido. Aguarde para solicitar um novo e-mail.
        </div>
    @enderror

    @endcomponent
@endsection