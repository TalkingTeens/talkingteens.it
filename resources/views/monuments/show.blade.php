@extends('layouts.default', ['title' => $monument->name])

@push('meta')
@endpush

@section('content')
    <header class="relative bg-nd h-fill text-white overflow-hidden">
        <div class="absolute top-1/4 left-[10%] z-10 max-w-xs text-white/50">
            <x-button.arrow :href="route('monuments.index', ['m' => $monument->municipality->istat_code])">
                {{ __('monument.back', ['municipality' => $monument->municipality->name]) }}
            </x-button.arrow>

            <h1 class="text-4xl font-extrabold text-white my-4">
                {{ $monument->name }}
            </h1>

            <div class="flex gap-2 max-w-xs w-11/12 flex-wrap">
                @foreach($tags as $category)
                    <a href="{{ route('monuments.index', ['c' => $category->slug]) }}"
                       class="text-sm bg-white/20 rounded-lg py-0.5 px-2 hover:text-white hover:bg-white/30 transition-colors">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>

        <img
            class="absolute h-[95%] object-cover overflow-visible bottom-0 left-2/3 md:left-[60%] lg:left-1/2 -translate-x-1/2"
            src="{{ $monument->getFirstMedia('monuments')?->getFullUrl() }}"
            alt="{{ $monument->name }}"
        >
    </header>

    <div
        class="relative w-11/12 max-w-7xl mx-auto mb-16 mt-8 sm:my-16 space-y-10 [&>*:not(:first-child)]:pt-10 divide-y md:space-y-16">
        <div class="flex flex-col sm:flex-row-reverse items-start gap-8 md:gap-16">
            <div class="space-y-10 [&>*:not(:first-child)]:pt-10 divide-y w-full md:space-y-16">
                <div class="flex flex-col lg:flex-row items-start gap-10 lg:gap-16">
                    @unless($monument->authors->isEmpty())
                        <div
                            class="space-y-10 shrink-0 lg:sticky lg:top-[calc(var(--nav-height)+var(--subheader-height))] lg:order-1">
                            <section class="space-y-4">
                                <p class="title-lg">
                                    {{ __('monument.authors') }}
                                </p>

                                @foreach($monument->authors as $author)
                                    <a href="{{ route('authors.show', ['author' => $author]) }}"
                                       class="group flex gap-3 rounded-2xl">
                                        <x-card.person :person="$author">
                                            <h3 class="group-hover:underline">
                                                {{ $author->full_name }}
                                            </h3>
                                        </x-card.person>
                                    </a>
                                @endforeach
                            </section>
                        </div>
                    @endunless

                    <div class="space-y-10 w-full">
                        @unless(empty($monument->description))
                            <section class="text-justify">
                                <p class="title-lg">
                                    {{ __('monument.history') }}
                                </p>

                                {!! $monument->description !!}
                            </section>
                        @endunless

                        <section class="space-y-6">
                            <div class="flex gap-1 flex-col sm:flex-row sm:items-center sm:justify-between">
                                <h3 class="title-lg mb-0">
                                    {{ __('monument.where', ['municipality' => $monument->municipality->getDisplayName()]) }}
                                </h3>
                            </div>

                            <x-map.show :$monument :$pin/>
                        </section>
                    </div>
                </div>
                @unless($characters->isEmpty())
                    <div class="grid lg:grid-cols-2 gap-10 lg:gap-16">
                        @foreach($characters as $character)
                            <section class="last:odd:col-span-full text-justify">
                                <x-card.person :person="$character" size="w-20" class="mb-5">
                                    <h2 class="title-lg mb-0">
                                        {{ $character->name }}
                                    </h2>
                                </x-card.person>

                                {!! $character->description !!}
                            </section>
                        @endforeach
                    </div>
                @endunless

                @unless($monument->classes->isEmpty() && $monument->treaters->isEmpty())
                    <section>
                        <p class="title-lg">
                            {{ __('monument.curators') }}
                        </p>
                        <ul x-data="{ open : 0 }" class="space-y-5">
                            @foreach($monument->classes as $class)
                                <li>
                                    <button type="button" class="w-full flex justify-between items-center"
                                            @click="open = (open !== 1 ? 1 : null)">
                                        <span>
                                            {{ $class->getDisplayName() }}, {{ $class->school->name }}
                                        </span>
                                        <img src="{{ asset('svg/chevron-down.svg') }}" alt=""
                                             class="h-5 w-5 transition-transform duration-500 ease-in-out"
                                             :class="open === 1 ? 'rotate-180' : ''">
                                    </button>
                                    <div x-show="open === 1" x-collapse.duration.500ms>
                                        <div class="overflow-hidden">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab ad aut
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </section>
                @endunless
            </div>
            <div
                class="flex items-center w-full sm:sticky sm:z-10 sm:top-[calc(var(--nav-height)+var(--subheader-height))] sm:w-auto sm:gap-3 sm:flex-col">
                <p class="text-xs pr-3 sm:pr-0">
                    {{ __('monument.share.cta') }}
                </p>

                <template x-if="typeof navigator.share === 'function'">
                    <button type="button"
                            class="p-3 hover:bg-gray-100 rounded-full sm:border"
                            @click="navigator.share({
                                url: '{{ URL::current() }}',
                                title: document.title,
                                text: `{{ __('monument.share.text', ['monument' => $monument->name, 'municipality' => $monument->municipality->name]) }}`
                            })">
                        <x-heroicon-o-share class="size-5 sm:size-6"/>
                    </button>
                </template>

                <a aria-label="Whatsapp"
                   href="https://api.whatsapp.com/send?text={{ $share['text'] }}%20{{ $share['url'] }}"
                   target="_blank" class="p-3 hover:bg-gray-100 rounded-full sm:border">
                    @svg('whatsapp', 'size-5 sm:size-6 text-[#25D366]')
                </a>

                <a aria-label="Facebook" href="https://www.facebook.com/sharer/sharer.php?u={{ $share['url'] }}"
                   target="_blank" class="p-3 hover:bg-gray-100 rounded-full sm:border">
                    @svg('facebook', 'size-5 sm:size-6 fill-[#0866ff]')
                </a>

                <a aria-label="LinkedIn" href="https://www.linkedin.com/sharing/share-offsite/?url={{ $share['url'] }}"
                   target="_blank" class="p-3 hover:bg-gray-100 rounded-full sm:border">
                    @svg('linkedin', 'size-5 sm:size-6 text-[#0a66c2]')
                </a>

                <a aria-label="X"
                   href="https://twitter.com/intent/tweet?url={{ $share['url'] }}&text={{ $share['text'] }}"
                   target="_blank" class="p-3 hover:bg-gray-100 rounded-full sm:border">
                    @svg('x', 'size-5 sm:size-6')
                </a>

                <a aria-label="Telegram" href="https://t.me/share/url?url={{ $share['url'] }}&text={{ $share['text'] }}"
                   target="_blank" class="p-3 hover:bg-gray-100 rounded-full sm:border">
                    @svg('telegram', 'size-5 sm:size-6 text-[#2AABEE]')
                </a>
            </div>
        </div>

        @if(isset($next))
            <div class="flex gap-3 max-sm:flex-col sm:items-center">
                <p class="title-lg mb-0">
                    {{ __('monument.next') }}:
                </p>
                <x-button.arrow :href="route('monuments.show', ['monument' => $next])" :back="false">
                    {{ $next->name }}
                </x-button.arrow>
            </div>
        @endif
    </div>

    {{--    @unless($monument->classes->isEmpty())--}}
    {{--        <section class="mx-auto max-w-5xl w-11/12 grid gap-20 py-20">--}}
    {{--            @foreach($monument->classes as $class)--}}
    {{--                <div class="flex justify-around">--}}
    {{--                    <div class="max-w-xs">--}}
    {{--                        <p class="font-extralight italic text-sm">--}}
    {{--                            Classe--}}
    {{--                        </p>--}}
    {{--                        <p>--}}
    {{--                            {{ $class->grade . "°" . $class->section . (!empty($class->discipline) ? " " . $class->discipline : "") . ", A.S. " . $class->year}}--}}
    {{--                        </p>--}}
    {{--                    </div>--}}
    {{--                    <div class="max-w-xs">--}}
    {{--                        <p class="font-extralight italic text-sm">--}}
    {{--                            Scuola--}}
    {{--                        </p>--}}
    {{--                        <p>--}}
    {{--                            {{ $class->school->name }}--}}
    {{--                        </p>--}}
    {{--                    </div>--}}
    {{--                    @isset($class->teachers)--}}
    {{--                        <div class="max-w-xs">--}}
    {{--                            <p class="font-extralight italic text-sm">--}}
    {{--                                Prof.--}}
    {{--                            </p>--}}
    {{--                            <p>--}}
    {{--                            </p>--}}
    {{--                        </div>--}}
    {{--                    @endisset--}}
    {{--                </div>--}}
    {{--                @isset($class->pivot->photo)--}}
    {{--                    <img src="{{ asset(Storage::url($class->pivot->photo)) }}" alt="Foto di classe">--}}
    {{--                @endisset--}}
    {{--            @endforeach--}}
    {{--        </section>--}}
    {{--    @endunless--}}

    @if($monument->webcall?->resources)
        <div class="sticky bottom-0 z-30">
            <div x-data="{ show : window.pageYOffset < 10 }"
                 class="absolute bottom-10 flex flex-col items-end gap-6 transition-all ease-in-out duration-300"
                 :class="$store.sidebar.open ? 'right-4 sm:right-[29rem] lg:right-14' : 'right-4 sm:right-14'"
            >
                <p class="max-w-[180px] max-md:hidden text-right text-sm text-white/50 italic font-extralight ease-in-out duration-200"
                   @scroll.window="show = window.pageYOffset < 10"
                   x-show="show && !$store.sidebar.open"
                   x-transition
                >
                    {{ __('monument.call.traditional') }}
                    <a href="tel:{{ $phone_number }}"
                       class="whitespace-nowrap text-green-500 hover:underline">+39 {{ $monument->phone_number }}</a>,<br>
                    {{ __('monument.call.online') }}
                </p>

                <template x-if="$store.sidebar.open && window.innerWidth >= 640">
                    <x-button.rounded
                        @click="$store.sidebar.toggle()"
                        icon="close"
                    />
                </template>

                <template x-if="!$store.sidebar.open || window.innerWidth < 640">
                    <x-button.rounded
                        @click="window.innerWidth >= 640 ? $store.sidebar.toggle() : window.location.href='tel:{{ $phone_number }}'"
                        icon="call"
                        bg="bg-green-500"
                        :ping="true"
                    />
                </template>
            </div>
        </div>
    @endif
@endsection

@if($monument->webcall?->resources)
    @section('sidebar')
        <object class="w-full h-full" type="text/html" data="{{ route('call', $monument) }}"></object>
    @endsection
@endif
