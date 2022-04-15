@extends('layouts.form')

@section('form')
    @component('components.public_form',['action' => route('login'), 'title' => 'Entrar'])
        <div class="mb-1">
            <label for="email" class="h5 fw-bold">Login</label>
        </div>
        <div class="mb-4 input-container">
            <input id="email" placeholder="e-mail" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            <i class="bi bi-person input-icon"></i>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    
        <div class="mb-1">
            <label for="password" class="h5 fw-bold">Senha</label>
        </div>
        <div class="input-container">
            <input id="password" placeholder="senha" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            <i class="bi bi-key input-icon"></i>

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
    
        <div class="row mb-0">
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn submit-btn">
                    Entrar
                </button>
            </div>
        </div>
    @endcomponent
@endsection
