@extends('layouts.legal', ['title' => __('cookie.title')])

@push('meta')
@endpush

@section('page')
    <div class="space-y-16 my-16 lg:w-2/3">
        <x-button class="primary" x-data @click="$dispatch('open-manager')">
            {{ __('cookie.settings.title') }}
        </x-button>

        {{--        <section>--}}
        {{--            <h2 class="title-lg">--}}
        {{--            </h2>--}}

        {{--            <p>--}}
        {{--            </p>--}}
        {{--        </section>--}}
    </div>
@endsection
