@extends('layouts.form')

@section('form')
@component('components.public_form',['action' => route('password.email'), 'title' => 'Alterar senha', 'submitMessage' => 'Redefinir', 'formClasses' => 'px-5 pt-5 col-sm-4 col-11 top-spacing'])

    @if (session('status'))
        <div class="h4 form-green my-5" role="alert">
            Um e-mail foi enviado com o link de redefinição de senha.
        </div>
    @endif

    <div class="mb-1">
        <label for="email" class="h5 fw-bold">E-mail</label>
    </div>
    <div class="mb-4 input-container">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        
        <i class="bi bi-envelope input-icon @error('email') d-none @enderror"></i>
    </div>
@endcomponent
@endsection
