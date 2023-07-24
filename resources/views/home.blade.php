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

    <x-button.primary :href="route('docs')">
        Didattica
    </x-button.primary>

    <x-button.primary :href="route('monuments.index')">
        Monumenti
    </x-button.primary>

    <section>
        @foreach($sponsors as $sponsor)

        @endforeach
    </section>
@endsection
