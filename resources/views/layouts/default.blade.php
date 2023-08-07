@extends('layouts.base')

@section('body')
    @hasSection('sidebar')
        <div class="print:hidden fixed top-0 right-0 h-screen bg-st shrink-0 -translate-x-full transform-gpu transition-transform duration-200 ease-in">
            @yield('sidebar')
        </div>
    @endif
    <div>
        @include('layouts.partials.ads.banner')
        @include('layouts.partials.nav')

        <main>
            @yield('content', $slot ?? '')
        </main>

        @include('layouts.partials.footer')
    </div>
@endsection
