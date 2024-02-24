@extends('layouts.default', ['title' => 'Sostenitori'])

@push('meta')
@endpush

@section('content')
    <section class="max-w-screen-xl w-11/12 mx-auto my-16 space-y-16">
        <div class="w-11/12 max-w-screen-md mx-auto space-y-4 text-center sm:w-full sm:py-4">
            {{--            <h1 class="badge">--}}
            {{--                {{ __('contributes.title') }}--}}
            {{--            </h1>--}}
            <h2 class="title-xl">
                {{ __('contributes.subtitle') }}
            </h2>
            <p class="text-sm">
                {{ __('contributes.text') }}
            </p>
        </div>

        <img src="{{ asset('/images/sponsor.jpg') }}" class="w-full rounded-3xl" alt="">

        {{--        <x-half-section title="Donatori del Crowfunding">--}}
        {{--            <a--}}
        {{--                href="https://www.ideaginger.it/progetti/prenditi-cura-di-me.html#tab_sostenitori"--}}
        {{--                class="underline"--}}
        {{--                target="_blank"--}}
        {{--            >--}}
        {{--                www.ideaginger.it--}}
        {{--            </a>--}}
        {{--        </x-half-section>--}}

        @foreach($supporters as $type => $group)
            <div>
                <h3 class="title-lg">
                    {{ __("contributes.thanks.{$type}") }}
                </h3>
                <p>
                    {{ $group->pluck('full_name')->join(', ', ' e ') }}.
                </p>
            </div>
        @endforeach
    </section>
@endsection
