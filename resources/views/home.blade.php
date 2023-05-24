@extends('layouts.base')

@push('meta')
@endpush

@section('body')
    <section class="h-screen">
        <video autoplay muted loop poster="{{ asset('images/welcome.jpg') }}" class="h-full w-full object-cover">
            <source src="{{ asset('videos/welcome.mp4') }}" type="video/mp4">
            Your browser does not support this video <!---->
        </video>
    </section>

    <h1 class="font-extrabold text-5xl">
        Le statue
    </h1>

    <x-button.cta :href="route('docs')">
        Didattica
    </x-button.cta>

    <x-button.cta :href="route('statues.index')">
        Statue
    </x-button.cta>
@endsection