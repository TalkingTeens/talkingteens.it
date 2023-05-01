<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>
            {{ isset($title) ? $title.' | ' : '' }}
            {{-- @hasSection('title')
                @yield('title') |
            @endif --}}
            {{ config('app.name') }}
        </title>

        {{-- <link rel="canonical" href="{{ $canonical ?? Request::url() }}" /> --}}

        @vite(['resources/css/app.css'])

        @stack('meta')

        @include('layouts._favicons')
        @include('layouts._social')

        @livewireStyles
    </head>
    <body>
        @include('layouts._nav')

        @yield('body')

        @include('layouts._footer')

        @livewireScripts
    </body>
</html>