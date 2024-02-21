@extends('layouts.default')

@push('meta')
@endpush

@section('content')
    <p class="max-w-screen-xl w-11/12 mx-auto mt-10 mb-6 title-xl">
        Menzioni Legali
    </p>
    <x-ui.subheader>
        <div class="flex overflow-x-auto gap-8">
            <x-legal.tab route="privacy">
                Informativa sulla privacy
            </x-legal.tab>
            <x-legal.tab route="cookie">
                Cookie Policy
            </x-legal.tab>
        </div>
    </x-ui.subheader>
    <div class="max-w-screen-xl w-11/12 mx-auto">
        @yield('page', $slot ?? '')
    </div>
@endsection
