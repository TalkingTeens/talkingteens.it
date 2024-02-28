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
                {{ __('sponsors.title') }}
            </h2>
            <p class="text-sm">
                {{ __('sponsors.text') }}
            </p>
        </div>

        @unless($sponsors->isEmpty())
            <div
                class="grid place-items-center grid-cols-2 gap-8 sm:gap-12 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5">
                @foreach($sponsors as $sponsor)
                    <div class="w-2/3 md:w-4/5 xl:w-3/5">
                        @if(isset($sponsor->resource))
                            <a href="{{ $sponsor->resource }}" target="_blank"
                               class="block hover:scale-98 transition-transform">
                                <img src="{{ asset(Storage::url($sponsor->logo)) }}" alt="">
                            </a>
                        @else
                            <img src="{{ asset(Storage::url($sponsor->logo)) }}" alt="">
                        @endif
                    </div>
                @endforeach
            </div>
        @endunless
    </section>
@endsection
