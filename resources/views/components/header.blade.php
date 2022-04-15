<header>
    <div class="px-3 py-2 header d-flex align-items-center justify-content-center">
        <div class="container d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center me-4 me-sm-0 text-decoration-none me-lg-auto">
                <img class="img-header-logo"/>
            </a>
            <nav class="hidden">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/home') }}" class="header-link">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="header-link me-2 me-sm-4">Entrar</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ms-2 ms-sm-4 header-link">Cadastrar-se</a>
                        @endif
                    @endauth
                @endif
            </nav>
        </div>
    </div>
</header>