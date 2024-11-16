@extends('layouts.default', ['title' => __('about.title')])

@push('meta')
@endpush

@section('content')
    <div class="grid items-start lg:grid-cols-2">
        <div class="max-lg:hidden sticky top-[--nav-height]">
            <img src="{{ asset('/images/sponsor.jpg') }}"
                 class="w-full h-[calc(100svh-var(--nav-height))] object-cover"
                 alt="{{ __('about.alt') }}">
        </div>

        <div class="section space-y-16 lg:mx-0 lg:w-full lg:px-[calc(100vw/24)] xl:pr-[calc((100vw-80rem)/2)]">
            <section class="space-y-6">
                <h1 class="title-xl">
                    {{ __('about.title') }}
                </h1>

                <p>
                    {{ __('about.description') }}
                </p>

                <img src="{{ asset('images/echo-full.png') }}" alt="ECHO - Education Culture Human Oxygen Logo">

                <p>
                    {{ __('about.echo') }}
                </p>
            </section>
        </div>
    </div>
@endsection
