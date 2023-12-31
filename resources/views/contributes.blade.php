@title('Sostenitori')

@extends('layouts.default')

@push('meta')
@endpush

@section('content')
    <header class="h-fill bg-[url('/public/images/sponsor.jpg')] bg-center bg-no-repeat bg-cover bg-fixed">
        <div class="h-full backdrop-brightness-[.3] py-16">
            <div class="max-w-7xl mx-auto w-11/12 h-full flex flex-col justify-between items-start text-white">
                <h1 class="badge">
                    {{ __('contributes.title') }}
                </h1>
                <div>
                    <p class="title-xl">
                        {{ __('contributes.subtitle') }}
                    </p>
                    <p class="opacity-70 mt-6 max-w-xl">
                        {{ __('contributes.text') }}
                    </p>
                </div>
            </div>
        </div>
    </header>
    <div class="max-w-7xl mx-auto w-11/12 py-16 space-y-16 lg:space-y-24">
        <x-slider.logos :collection="$sponsors" />
        <x-half-section title="Donatori del Crowfunding">
            <a
                href="https://www.ideaginger.it/progetti/prenditi-cura-di-me.html#tab_sostenitori"
                class="underline"
                target="_blank"
            >
                www.ideaginger.it
            </a>
        </x-half-section>
        @foreach($supporters as $type => $group)
            <x-half-section :title='__("contributes.thanks.{$type}")'>
                <p>
                    @foreach($group as $supporter)
                        {{ $supporter->full_name }} <br>
                    @endforeach
                </p>
            </x-half-section>
        @endforeach
    </div>
@endsection
