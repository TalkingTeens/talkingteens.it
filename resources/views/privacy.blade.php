@extends('layouts.legal', ['title' => 'Privacy Policy'])

@push('meta')
@endpush

@section('page')
    <div class="space-y-16 my-16 lg:w-2/3">
        <p>{{ __('privacy.introduction') }}</p>

        <section>
            <h2 class="title-lg">
                {{ __('privacy.purposes.title') }}
            </h2>

            <p>
                {{ __('privacy.purposes.text') }}
            </p>
        </section>

        <section>
            <h2 class="title-lg">
                {{ __('privacy.modalities.title') }}
            </h2>

            <p>
                {{ __('privacy.modalities.text') }}
            </p>
        </section>

        <section>
            <h2 class="title-lg">
                {{ __('privacy.legal.title') }}
            </h2>

            <p>
                {{ __('privacy.legal.text', ['APP_URL' => config('app.url')]) }}
            </p>
        </section>

        <section>
            <h2 class="title-lg">
                {{ __('privacy.transfer.title') }}
            </h2>

            <p>
                {{ __('privacy.transfer.text') }}
            </p>
        </section>

        <section>
            <h2 class="title-lg">
                {{ __('privacy.time.title') }}
            </h2>

            <p>
                {{ __('privacy.time.text') }}
            </p>
        </section>

        <section>
            <h2 class="title-lg">
                {{ __('privacy.intentions.title') }}
            </h2>

            <p>
                {{ __('privacy.intentions.text') }}
            </p>
        </section>

        <section>
            <h2 class="title-lg">
                {{ __('privacy.controller.title') }}
            </h2>

            <p>
                {{ __('privacy.controller.text') }}
            </p>
        </section>
    </div>
@endsection
