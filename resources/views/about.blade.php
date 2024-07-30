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
            <section class="space-y-4">
                <h1 class="title-xl">
                    {{ __('about.title') }}
                </h1>

                <p>
                    {{ __('about.text') }}
                </p>
            </section>

            @unless($schools->isEmpty())
                <section>
                    <h2 class="title-lg">
                        {{ __('about.schools') }}
                    </h2>

                    <ul>
                        @foreach($schools as $school)
                            <li>
                                {{ $school->full_name }}
                            </li>
                        @endforeach
                    </ul>
                </section>
            @endunless

            @foreach($supporters as $type => $group)
                <section>
                    <h2 class="title-lg">
                        {{ __("about.thanks.{$type}") }}
                    </h2>

                    <ul>
                        @foreach($group as $supporter)
                            <li>
                                {{ $supporter->full_name }}
                            </li>
                        @endforeach
                    </ul>
                </section>
            @endforeach

            <section>
                <h2 class="title-lg">
                    {{ __("about.committee.title") }}
                </h2>

                <ul>
                    <li>

                    </li>
                </ul>
            </section>
        </div>
    </div>
@endsection
