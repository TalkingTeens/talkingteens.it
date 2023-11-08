@title($author->full_name)

@extends('layouts.default')

@push('meta')
@endpush

@section('content')
    <section x-data class="w-11/12 max-w-screen-lg mx-auto grid grid-cols-4 gap-16 my-16">
        <div class="justify-self-end">
            <x-avatar
                :src="$author->picture"
                :alt="$author->full_name"
                size="w-full"
            />
        </div>
        <div class="col-span-3">
            <x-card.person :person="$author" :avatar="false">
                <h1 class="title-xl"
                    x-intersect:enter="$dispatch('toggle', { shown: false })"
                    x-intersect:leave="$dispatch('toggle', { shown: true })"
                >
                    {{ $author->full_name }}
                </h1>
            </x-card.person>
            @unless(empty($author->description))
                <section>
                    <h2 class="title-lg">
                        Vita
                    </h2>
                    {!! $author->description !!}
                </section>
            @endunless
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
    </section>
@endsection

@section('subheader')
    <div
        x-data="{ shown: false }"
        x-show="shown" x-cloak
        @toggle.window="shown = $event.detail.shown"
        x-transition
        class="max-w-screen-lg mx-auto py-1 grid-cols-3"
    >
        <x-card.person :person="$author" :avatar="false">
            <p class="title-lg mb-0">
                {{ $author->full_name }}
            </p>
        </x-card.person>
    </div>
@endsection
