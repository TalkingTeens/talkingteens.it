@extends('layouts.default', ['title' => 'Sponsor'])

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

        <x-slider.logos :collection="$sponsors"/>
    </section>
@endsection
