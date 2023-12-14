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
            <div class="mx-auto w-11/12 max-w-7xl space-y-4">
                @if($municipalities->count())
                    <p class="text-st font-semibold">
                        {{ __('monument.place') . ' ' . $municipalities->join(', ', ' e ') }}
                    </p>
                @endif
                <h1 class="title-xl font-black text-white">
                    {{ __('home.title') }}
                </h1>
                <p class="text-sm text-white max-w-xl pb-1">
                    {{ __('home.description') }}
                </p>
                <x-button href="#" class="primary text-sm">
                    {{ __('home.cta') }}
                </x-button>
            </div>
        </div>
    </header>

    <h2 class="font-extrabold text-5xl">
        Le statue
    </h2>

    @unless($articles->isEmpty())
        <section class="max-w-screen-xl mx-auto w-11/12 grid place-items-center grid-cols-2 gap-8 sm:gap-12 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6">
            @foreach($articles as $article)
                <div class="w-2/3 md:w-4/5 xl:w-3/4">
                    @if(isset($article->resource))
                        <a href="{{ $article->resource }}" target="_blank" class="block hover:scale-98 transition-transform">
                            <img src="{{ asset(Storage::url($article->logo)) }}" alt="">
                        </a>
                    @else
                        <img src="{{ asset(Storage::url($article->logo)) }}" alt="">
                    @endif
                </div>
            @endforeach
        </section>
    @endunless
@endsection
