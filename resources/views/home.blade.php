@extends('layouts.default')

@push('meta')
@endpush

@section('content')
    <header class="h-fill relative">
        <video autoplay muted playsinline loop poster="{{ asset('images/welcome.jpg') }}"
               class="h-full w-full object-cover">
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
                </p>

                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                    <x-button :href="route('monuments.index')" class="primary text-nd">
                        {{ __('home.cta.monuments') }}
                    </x-button>

                    <x-button.arrow :href="route('project')" :back="false" class="font-semibold max-sm:text-sm">
                        {{ __('home.cta.project') }}
                    </x-button.arrow>
                </div>
            </div>
        </div>
    </header>

    <div class="section space-y-16 sm:space-y-24">
        @unless($articles->isEmpty())
            <section>
                <h2 class="text-center title-lg">
                    Dicono di noi
                </h2>

                <div
                    class="w-full inline-flex flex-nowrap overflow-hidden group [mask-image:_linear-gradient(to_right,transparent_0,_black_128px,_black_calc(100%-128px),transparent_100%)]">
                    @for ($i = 0; $i < 2; $i++)
                        <ul
                            class="flex items-center justify-center md:justify-start animate-marquee group-hover:[animation-play-state:paused]"
                            aria-hidden="{{ $i ? 'true' : 'false' }}"
                        >
                            @foreach($articles as $article)
                                <li class="w-20 md:w-28 mx-4 md:mx-8">
                                    @if(isset($article->resource))
                                        <a href="{{ $article->resource }}" target="_blank"
                                           class="block hover:scale-98 transition-transform">
                                            <img src="{{ $article->logo }}"
                                                 alt="{{ $article->name }} logo"
                                                 class="w-full"/>
                                        </a>
                                    @else
                                        <img src="{{ $article->logo }}"
                                             alt="{{ $article->name }} logo"
                                             class="w-full"/>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endfor
                </div>
            </section>
        @endunless

        <div class="bg-gray-50 rounded-3xl h-96">
            Modalità
        </div>

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

    <div class="bg-[url('/public/images/pattern.svg')] bg-fixed bg-no-repeat bg-cover">
        <section class="text-center section space-y-16 mx-auto !max-w-3xl">
            <p>
                {{ __('home.donate.text') }}
            </p>

            <h2>
                <span class="font-bold text-6xl sm:text-7xl lg:text-8xl">
                    {{ Number::format(100000) }}+
                </span><br>
                {{ __('home.donate.calls') }}
            </h2>

            <x-button.arrow :href="route('donate')" :back="false" class="font-semibold w-fit mx-auto">
                {{ __('home.donate.cta') }}
            </x-button.arrow>
        </section>
    </div>

    {{--    <section class="bg-st">--}}
    {{--        <div class="section space-y-16">--}}
    {{--            <h2 class="title-xl text-center max-w-2xl text-nd mx-auto">--}}
    {{--                Sostieni il progetto--}}
    {{--            </h2>--}}

    {{--            <div class="grid gap-8 md:grid-cols-2">--}}

    {{--                <a href="{{ route('sponsors') }}" class="rounded-3xl relative overflow-hidden h-96 text-white">--}}
    {{--                    <img src="{{ asset('/images/sponsor.jpg') }}" class="w-full h-full object-cover"--}}
    {{--                         alt="">--}}

    {{--                    <div class="absolute p-10 inset-0 backdrop-brightness-50">--}}
    {{--                        <h3 class="title-lg">--}}
    {{--                            Diventa uno sponsor--}}
    {{--                        </h3>--}}

    {{--                        <p>--}}
    {{--                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam eos expedita nihil quasi--}}
    {{--                            voluptate? Maxime.--}}
    {{--                        </p>--}}
    {{--                    </div>--}}
    {{--                </a>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </section>--}}

    <section class="section space-y-16">
        <div class="space-y-4 max-w-3xl mx-auto md:text-center">
            <h2 class="badge">
                {{ __('home.sponsors.title') }}
            </h2>

            <h3 class="title-xl">
                {{ __('home.sponsors.subtitle') }}
            </h3>

            <p class="text-sm">
                {{ __('home.sponsors.text') }}
            </p>

            <x-button.arrow href="mailto:team@talkingteens.it" :back="false" class="font-semibold">
                {{ __('home.sponsors.cta') }}
            </x-button.arrow>
        </div>

        @unless($sponsors->isEmpty())
            <div
                class="grid place-items-center grid-cols-2 gap-8 sm:gap-12 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5">
                @foreach($sponsors as $sponsor)
                    <div class="w-2/3 md:w-4/5 xl:w-3/5">
                        @if(isset($sponsor->resource))
                            <a href="{{ $sponsor->resource }}" target="_blank"
                               class="block hover:scale-98 transition-transform">
                                <img src="{{ $sponsor->logo }}" alt="{{ $sponsor->name }}">
                            </a>
                        @else
                            <img src="{{ $sponsor->logo }}" alt="{{ $sponsor->name }}">
                        @endif
                    </div>
                @endforeach
            </div>
        @endunless
    </section>

@endsection
