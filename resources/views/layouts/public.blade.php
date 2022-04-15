<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">
        
        <!-- Styles -->
        <link href="{{ asset('css/public.css') }}" rel="stylesheet">
    </head>
    <body>
        @include('components.header')
        <main class="position-relative{{!($isForm ?? false) ?: ' form-page'}}" id="{{ Route::currentRouteName() ?: 'welcome' }}">
            @yield('content')
        </main>
        <footer>
            @yield('footer')
        </footer>
    </body>
</html>
