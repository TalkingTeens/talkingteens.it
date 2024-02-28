@extends('layouts.default', ['title' => 'Sostenitori'])

@push('meta')
@endpush

@section('content')
    <div class="grid items-start lg:grid-cols-2">
        <div class="max-lg:hidden sticky top-[--nav-height]">
            <img src="{{ asset('/images/sponsor.jpg') }}" class="w-full h-[calc(100svh-var(--nav-height))] object-cover"
                 alt="">
        </div>
        <div class="section space-y-16 lg:mx-0 lg:w-full lg:px-[calc(100vw/24)] xl:pr-[calc((100vw-80rem)/2)]">
            <div class="space-y-4">
                <h1 class="title-xl">
                    {{ __('contributes.title') }}
                </h1>
                <p>
                    {{ __('contributes.text') }}
                </p>
            </div>

            <div>
                <h3 class="title-lg">
                    {{ __("contributes.thanks.schools") }}
                </h3>
                <ul>
                    @foreach($schools as $school)
                        <li>
                            {{ $school->name }}
                        </li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h3 class="title-lg">
                    Donatori del Crowfunding
                </h3>
                <p>
                    <a
                        href="https://www.ideaginger.it/progetti/prenditi-cura-di-me.html#tab_sostenitori"
                        class="underline"
                        target="_blank"
                    >
                        www.ideaginger.it
                    </a>
                </p>
            </div>

            @foreach($supporters as $type => $group)
                <div>
                    <h3 class="title-lg">
                        {{ __("contributes.thanks.{$type}") }}
                    </h3>
                    <ul>
                        @foreach($group as $supporter)
                            <li>
                                {{ $supporter->full_name }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
@endsection
