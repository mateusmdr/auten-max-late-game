@extends('layouts.form')

@section('form')
@component('components.public_form',['action' => route('password.update'), 'title' => 'Alterar senha', 'submitMessage' => 'Alterar', 'formClasses' => 'px-5 pt-5 col-sm-4 col-11 top-spacing'])

    <input type="hidden" name="token" value="{{ $token }}">

    <div class="mb-1">
        <label for="email" class="h5 fw-bold">E-mail</label>
    </div>
    <div class="mb-4 input-container">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        
        <i class="bi bi-envelope input-icon @error('email') d-none @enderror"></i>
    </div>
    <div class="row">
        <div class="col-6">
            <label for="password" class="h5 fw-bold">Senha *</label>
            <div class="input-container">
                <input id="password" placeholder="senha" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                <i class="bi bi-key input-icon @error('password') d-none @enderror"></i>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <label for="password-confirm" class="h5 fw-bold">Confirmar senha *</label>
            <div class="input-container">
                <input id="password-confirm" placeholder="senha" type="password" class="form-control @error('password-confirm') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">
                <i class="bi bi-key input-icon @error('password-confirm') d-none @enderror"></i>
                @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>
@endcomponent
@endsection
