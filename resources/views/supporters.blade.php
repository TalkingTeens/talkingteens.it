@extends('layouts.default', ['title' => __('supporters.title')])

@push('meta')
@endpush

@section('content')
    <div class="grid items-start lg:grid-cols-2">
        <div class="max-lg:hidden sticky top-[--nav-height]">
            <img src="{{ asset('/images/sponsor.jpg') }}" class="w-full h-[calc(100svh-var(--nav-height))] object-cover"
                 alt="{{ __('supporters.alt') }}">
        </div>

        <div class="section space-y-16 lg:mx-0 lg:w-full lg:px-[calc(100vw/24)] xl:pr-[calc((100vw-80rem)/2)]">
            <section class="space-y-4">
                <h1 class="title-xl">
                    {{ __('supporters.title') }}
                </h1>

                <p>
                    {{ __('supporters.text') }}
                </p>
            </section>

            <section>
                <h2 class="title-lg">
                    {{ __('supporters.thanks.crowdfunding.title') }}
                </h2>

                <p>
                    {{ __('supporters.thanks.crowdfunding.text') }}

                    <a
                        href="https://www.ideaginger.it/progetti/prenditi-cura-di-me.html"
                        class="underline"
                        target="_blank"
                    >ideaginger.it</a>.

                    <br> <br>

                    {{ __('supporters.thanks.crowdfunding.thanks') }}
                </p>
            </section>

            @foreach($supporters as $type => $group)
                <section>
                    <h2 class="title-lg">
                        {{ __("supporters.thanks.{$type}") }}
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
        </div>
    </div>
@endsection
