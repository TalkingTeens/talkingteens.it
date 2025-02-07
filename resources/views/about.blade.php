@extends('layouts.default', ['title' => __('about.title')])

@push('meta')
@endpush

@section('content')
    <section class="section space-y-6">
        <h1 class="title-xl text-center">
            {{ __('about.title') }}
        </h1>

        <img src="{{ asset('/images/sponsor.jpg') }}" alt="{{ __('about.alt') }}" class="w-full">

        <div class="grid sm:grid-cols-2">
            <div>
                <img src="{{ asset('images/echo-full.png') }}" alt="ECHO - Education Culture Human Oxygen Logo">

                <p>
                    C.F. 9290290343 <br>
                    P.IVA 03061460345
                </p>
            </div>

            <div>
                <p>
                    {{ __('about.description') }}
                </p>
            </div>
        </div>
    </section>
@endsection
