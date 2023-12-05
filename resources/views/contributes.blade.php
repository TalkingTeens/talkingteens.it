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
        <x-slider.logos :collection="$sponsors"/>
        @unless($supporters->isEmpty())
            <section class="grid gap-8 lg:grid-cols-2 lg:gap-16 lg:items-start">
                <h3 class="title-xl max-w-screen-sm lg:sticky lg:top-[calc(var(--nav-height)+4rem)]">
                    {{ __('contributes.thanks') }}:
                </h3>
                <p>
                    @foreach($supporters as $supporter)
                        {{ $supporter->full_name }} <br>
                    @endforeach
                </p>
            </section>
        @endunless
    </div>
@endsection
