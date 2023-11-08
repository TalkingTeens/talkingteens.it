@extends('layouts.default')

@push('meta')
@endpush

@section('content')
    <section class="h-fill">
        <video autoplay muted loop poster="{{ asset('images/welcome.jpg') }}" class="h-full w-full object-cover">
            <source src="{{ asset('videos/welcome.mp4') }}" type="video/mp4">
            Your browser does not support this video <!---->
        </video>
    </section>

    <h1 class="font-extrabold text-5xl">
        Le statue
    </h1>

    @unless($articles->isEmpty())
        <section class="max-w-screen-xl mx-auto w-11/12 grid place-items-center grid-cols-2 gap-8 sm:gap-12 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6">
            @foreach($articles as $article)
                <div class="w-2/3 md:w-4/5 xl:w-3/4">
                    @if(isset($article->resource))
                        <a href="{{ $article->resource }}" target="_blank" class="block hover:scale-98 transition-transform">
                            <img src="{{ asset(Storage::url($article->logo)) }}" alt="">
                        </a>
                    @else
                        <img src="{{ asset(Storage::url($article->logo)) }}" alt="">
                    @endif
                </div>
            @endforeach
        </section>
    @endunless
@endsection
