<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name') }}</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet"/>
        @stack('styles')
    </head>
    <body class="antialiased bg-amber-500">
        <header class="bg-gray-50 border-b-2 border-gray-100">
            @include('front-end._partials.navigation')
        </header>
        <main class="{{ $bg ?? 'bg-gray-50' }}">
            @yield('main')
        </main>
        <footer>
            @include('front-end._partials.footer')
        </footer>
        @stack('scripts')
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
