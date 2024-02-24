@extends('layouts.default')

@push('meta')
@endpush

@section('content')
    <header class="h-fill relative">
        <video autoplay muted loop poster="{{ asset('images/welcome.jpg') }}" class="h-full w-full object-cover">
            <source src="{{ asset('videos/welcome.mp4') }}" type="video/mp4">
            Your browser does not support this video
        </video>
        <div class="absolute inset-0 flex items-center">
            <div class="mx-auto w-11/12 text-white max-w-7xl space-y-4">
                @if($municipalities->count())
                    <p class="text-st font-semibold">
                        {{ $municipalities->join(', ', ' e ') }}
                    </p>
                @endif
                <h1 class="title-xl font-black">
                    {{ __('home.title') }}
                </h1>
                <p class="text-sm max-w-xl pb-1">
                    {{ __('home.description') }}
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem, quam?
                </p>
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                    <x-button :href="route('monuments.index')" class="primary text-sm text-nd">
                        Scopri le statue
                    </x-button>
                {{--
                    <x-button.arrow :href="route('project')" :back="false" class="font-semibold max-sm:text-sm">
                        {{ __('home.cta') }}
                    </x-button.arrow>
                --}}
                </div>
            </div>
        </div>
    </header>

    <div class="max-w-screen-xl w-11/12 mx-auto my-16 space-y-16">
        @unless($articles->isEmpty())
            <x-slider.logos :collection="$articles"/>
        @endunless

        <section class="space-y-8">
            <div class="flex items-center justify-between">
                <h2 class="title-xl">
                    Le statue
                </h2>
                <x-button.arrow :href="route('monuments.index')" :back="false" :transform="false">
                    Vedi tutte
                </x-button.arrow>
            </div>
            <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-4">
                @foreach($monuments as $monument)
                    <x-card.monument :$monument/>
                @endforeach
            </div>
        </section>
    </div>
@endsection
