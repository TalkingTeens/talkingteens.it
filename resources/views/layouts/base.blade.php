<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) ? Arr::join([$title, config('app.name')], ' - ') : config('app.name') }}</title>

    {{-- <link rel="canonical" href="{{ $canonical ?? Request::url() }}" /> --}}

    @vite(['resources/css/app.css'])

    @stack('meta')

    @foreach (LaravelLocalization::getSupportedLanguagesKeys() as $lang)
        <link rel="alternate" href="{{ LaravelLocalization::getLocalizedURL($lang) }}" hreflang="{{ $lang }}">
    @endforeach

    @include('layouts.partials.favicons')
    @include('layouts.partials.social')

    @livewireStyles
</head>
<body class="dark:bg-neutral-950 select-none !mb-0 font-poppins antialiased">

@yield('body')

@production
    <x-legal.cookie/>

    @pushonce('scripts')
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }

            gtag('js', new Date());
            gtag('config', 'G-3GJ7WZTD6J');
        </script>
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-3GJ7WZTD6J"></script>
    @endpushonce
@endproduction

@vite(['resources/js/app.js'])
@stack('scripts')
@livewireScripts
</body>
</html>
