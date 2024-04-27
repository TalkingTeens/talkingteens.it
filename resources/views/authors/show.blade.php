@extends('layouts.default', ['title' => $author->full_name])

@push('meta')
@endpush

@section('content')
    <x-ui.subheader>
        <div
            x-data="{ shown: false }"
            @toggle.window="shown = $event.detail.shown"
            class="mx-auto flex justify-between items-center h-[--subheader-height]"
        >
            <x-button.arrow :href="URL::previous()">
                {{ __('common.back') }}
            </x-button.arrow>

            <a href="#" x-show="shown" x-cloak x-transition>
                <x-card.person
                    :person="$author"
                    :reverse="true"
                    size="w-14"
                    class="max-sm:hidden"
                >
                    <p class="title-lg mb-0">
                        {{ $author->full_name }}
                    </p>
                </x-card.person>

                <x-ui.avatar :src="$author->getFirstMedia('authors')?->getFullUrl()"
                             :alt="$author->full_name"
                             size="w-12 sm:hidden"/>
            </a>
        </div>
    </x-ui.subheader>

    <div x-data class="w-11/12 max-w-screen-xl mx-auto my-16">
        <x-card.person :person="$author" size="w-24 sm:w-36">
            <h1 class="title-xl max-sm:text-3xl"
                x-intersect:enter="$dispatch('toggle', { shown: false })"
                x-intersect:leave="$dispatch('toggle', { shown: true })"
            >
                {{ $author->full_name }}
            </h1>
        </x-card.person>

        <div class="divide-y mt-10 sm:mt-14 space-y-10 [&>*:not(:first-child)]:pt-10 md:space-y-16">
            @unless(empty($author->description))
                <div class="max-w-5xl">
                    {!! $author->description !!}
                </div>
            @endunless

            @unless($author->monuments->isEmpty())
                <section>
                    <h2 class="title-lg">
                        {{ __('author.works') }}
                    </h2>

                    <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-4">
                        @foreach($author->monuments as $monument)
                            <x-card.monument :$monument/>
                        @endforeach
                    </div>
                </section>
            @endunless
        </div>
    </div>
@endsection
