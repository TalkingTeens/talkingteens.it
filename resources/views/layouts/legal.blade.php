@extends('layouts.default')

@push('meta')
@endpush

@section('content')
    <p class="max-w-screen-xl w-11/12 mx-auto mt-8 mb-4 title-xl">
        Menzioni Legali
    </p>
    <x-ui.subheader>
        <div class="flex">
            <a href="" class="border-b-2 border-black font-semibold px-4 py-2 -mb-px">
                Privacy
            </a>
        </div>
    </x-ui.subheader>
    <div class="max-w-screen-xl w-11/12 mx-auto">
        @yield('page', $slot ?? '')
    </div>
@endsection
