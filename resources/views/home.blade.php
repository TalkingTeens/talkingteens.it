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
                <p class="max-w-2xl text-sm sm:text-base pb-1">
                    {{ __('home.description') }}
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem, quam?
                </p>
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                    <x-button :href="route('monuments.index')" class="primary text-nd">
                        Scopri le statue
                    </x-button>
                    {{--                    <x-button.arrow :href="route('project')" :back="false" class="font-semibold max-sm:text-sm">--}}
                    {{--                        {{ __('home.cta') }}--}}
                    {{--                    </x-button.arrow>--}}
                </div>
            </div>
        </div>
    </header>

    <div class="section space-y-16 sm:space-y-24">
        @unless($articles->isEmpty())
            <section>
                <h2 class="sr-only">Dicono di noi</h2>

                <x-slider.logos :collection="$articles"/>
            </section>
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

    <section class="bg-st text-nd">
        <div class="section space-y-16">
            <h2 class="title-xl text-center max-w-2xl mx-auto">
                Sostieni il progetto
            </h2>
            <div class="grid gap-8 sm:grid-cols-2">
                <div class="bg-gray-100 rounded-3xl p-10">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam eos expedita nihil quasi
                        voluptate? Maxime.
                    </p>
                    <x-button.arrow :href="route('donate')" :back="false" class="font-semibold">
                        Dona ora
                    </x-button.arrow>
                </div>
                <div class="bg-gray-100 rounded-3xl p-10">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam eos expedita nihil quasi
                        voluptate? Maxime.
                    </p>
                    <x-button.arrow :href="route('sponsors')" :back="false" class="font-semibold">
                        Diventa uno sponsor
                    </x-button.arrow>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <h2 class="title-xl max-w-5xl">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea, id?
        </h2>
        <x-button.arrow :href="route('supporters')" :back="false" class="mt-6">
            Scopri i sostenitori
        </x-button.arrow>
        <a href="{{ route('supporters') }}">
            <img src="{{ asset('/images/sponsor.jpg') }}" class="w-full h-fill object-cover rounded-3xl mt-16"
                 alt="">
        </a>
    </section>
@endsection
