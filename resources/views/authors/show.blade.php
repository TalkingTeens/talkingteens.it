@title($author->full_name)

@extends('layouts.default')

@push('meta')
@endpush

@section('content')
    <div class="max-w-7xl w-11/12 mx-auto flex flex-col sm:flex-row my-16 gap-16">
        <div class="mx-auto sm:mx-0 sm:sticky sm:top-[calc(var(--nav-height)+4rem)] h-fit text-center">
            <img src="{{ asset(Storage::url($author->picture)) }}" alt="" class="shrink-0 rounded-full object-cover h-52 w-52">
            <h1 class="">
                {{ $author->full_name }}
            </h1>
        </div>
        <div class="flex-1">
            <section>
                <h2 class="title-lg">
                    Vita
                </h2>
                {!! $author->description !!}
            </section>
            <section>
                <h2 class="title-lg">
                    Alcune opere
                </h2>
                <div class="grid lg:grid-cols-2 gap-4">
                    @foreach($author->monuments as $monument)
                        <x-card.monument :$monument />
                    @endforeach
                </div>
            </section>
        </div>
    </div>

@endsection
