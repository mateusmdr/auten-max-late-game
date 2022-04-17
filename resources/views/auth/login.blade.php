@extends('layouts.form')

@section('form')
    @component('components.public_form',['action' => route('login'), 'title' => 'Entrar', 'submitMessage' => 'Entrar', 'formClasses' => 'px-5 pt-5 col-sm-4 col-11 top-spacing'])
        <div class="mb-1">
            <label for="email" class="h5 fw-bold">E-mail</label>
        </div>
        <div class="mb-4 input-container">
            <input id="email" placeholder="exemplo@email.com" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            
            <i class="bi bi-envelope input-icon @error('email') d-none @enderror"></i>
        </div>
        <div class="mb-1">
            <label for="password" class="h5 fw-bold">Senha</label>
        </div>
        <div class="input-container">
            <input id="password" placeholder="senha" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            <i class="bi bi-key input-icon @error('password') d-none @enderror"></i>
        
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="clearfix">
            @if (Route::has('password.request'))
                <a class="btn btn-link align-self-end float-end form-grey" href="{{ route('password.request') }}">
                    Esqueci minha senha
                </a>
            @endif
        </div>
        <div class="mb-4 mb-sm-3 mt-4">
            <div class="form-check">
                <input class="form-check-input me-2" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label form-grey" for="remember">
                    Lembrar de mim
                </label>
            </div>
        </div>
    @endcomponent
@endsection
