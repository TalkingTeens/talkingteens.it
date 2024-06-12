@extends('layouts.default', ['title' => __('privacy.title')])

@push('meta')
@endpush

@section('content')
    <p class="max-w-screen-xl w-11/12 mx-auto mt-10 mb-6 title-xl">
        {{ __('common.footer.legal.title') }}
    </p>

    <x-ui.subheader>
        <div class="flex overflow-x-auto gap-8">
            <x-legal.tab :$type route="privacy"/>

            <x-legal.tab :$type route="cookie"/>
        </div>
    </x-ui.subheader>

    <div class="max-w-screen-xl w-11/12 mx-auto">
        @if($policy)
            <div class="space-y-16 my-16 prose prose-h1:hidden max-w-none">
                {!! $policy !!}
            </div>
        @else
            {{-- TODO: finish --}}
            error
        @endif
    </div>
@endsection
