<header>
    <div class="px-3 py-2 header d-flex align-items-center justify-content-center">
        <div class="container d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
                <img class="header-logo"/>
            </a>
            <nav class="hidden">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/home') }}" class="header-link me-4">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="header-link me-4">Entrar</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ms-4 header-link">Cadastrar-se</a>
                        @endif
                    @endauth
                @endif
            </nav>
        </div>
    </div>
</header>