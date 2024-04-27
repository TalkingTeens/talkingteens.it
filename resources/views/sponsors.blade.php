@extends('layouts.default', ['title' => __('sponsors.title')])

@push('meta')
@endpush

@section('content')
    <section class="section space-y-16">
        <div class="space-y-4 max-w-3xl mx-auto md:text-center">
            <h1 class="badge">
                {{ __('sponsors.title') }}
            </h1>

            <h2 class="title-xl">
                {{ __('sponsors.subtitle') }}
            </h2>

            <p class="text-sm">
                {{ __('sponsors.text') }}
            </p>

            <x-button.arrow href="mailto:team@talkingteens.it" :back="false" class="font-semibold">
                {{ __('sponsors.cta') }}
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
