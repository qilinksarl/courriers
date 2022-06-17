<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name') }}</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet"/>
        @stack('styles')
    </head>
    <body class="antialiased bg-yellow-50">
        <header class="bg-white border-b border-grey-50">
            @include('front-end._partials.navigation')
        </header>
        <main class="max-w-5xl mx-auto py-16">
            @yield('main')
        </main>
        <footer>
            @include('front-end._partials.footer')
        </footer>
        @stack('scripts')
    </body>
</html>
