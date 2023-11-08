@title($monument->name)

@extends('layouts.default')

@push('meta')
@endpush

@section('content')
    <header class="relative bg-nd h-fill text-white overflow-hidden">
        <div class="absolute top-1/4 left-[10%] z-10 max-w-xs text-white/50">
                <a wire:navigate href="{{ URL::previous() }}" class="group relative hidden sm:block">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 absolute top-1/2 -translate-y-1/2 rotate-180 pointer-events-none -translate-x-8 group-hover:-translate-x-10 transition-transform">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                    </svg>
                    <span>
                        Torna indietro
                    </span>
                </a>
            <h1 class="text-4xl font-extrabold text-white my-4">
                {{ $monument->name }}
            </h1>
            <div class="flex gap-2 max-w-xs w-11/12 flex-wrap">
                @foreach($monument->categories as $category)
                    <a wire:navigate href="{{ route('monuments.index', ['c' => $category->slug]) }}"
                       class="text-sm bg-white/20 rounded-lg py-0.5 px-2 hover:text-white hover:bg-white/30 transition-colors">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>
        <img
            class="absolute h-[95%] bottom-0 min-w-fit left-2/3 md:left[60%] lg:left-1/2 -translate-x-1/2"
            src="{{ asset(Storage::url($monument->monument_image)) }}"
            alt=""
        >
    </header>
    <div class="relative w-11/12 max-w-7xl mx-auto my-16 flex flex-col sm:flex-row items-start sm:gap-10 md:gap-16">
        <div class="flex items-center justify-end w-full sm:sticky sm:z-10 sm:top-[calc(var(--nav-height)+var(--subheader-height))] sm:w-auto sm:gap-3 sm:flex-col">
            <span class="text-xs grow">
                Condividi
            </span>
            <button type="button" @click="navigator.share({ title:`{{ '' }}`, url:'{{ LaravelLocalization::getNonLocalizedURL(URL::current()) }}'})" class="p-3 hover:bg-gray-100 rounded-full sm:border">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="h-5 w-5 sm:h-6 sm:w-6">
                    <circle cx="128" cy="256" r="48" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/>
                    <circle cx="384" cy="112" r="48" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/>
                    <circle cx="384" cy="400" r="48" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/>
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M169.83 279.53l172.34 96.94M342.17 135.53l-172.34 96.94"/>
                </svg>
            </button>
            <a href="https://twitter.com/intent/tweet?text={{ '' }}&url={{ '' }}" target="_blank" class="p-3 hover:bg-gray-100 rounded-full sm:border">
                <svg viewBox="0 0 13 27" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 fill-[#4267b2]">
                    <path d="M8.10155 26.1115V13.0542H11.7059L12.1836 8.5546H8.10155L8.10768 6.30251C8.10768 5.12894 8.21918 4.50012 9.90476 4.50012H12.1581V0H8.55319C4.22314 0 2.69907 2.18279 2.69907 5.85357V8.55511H0V13.0547H2.69907V26.1115H8.10155Z" />
                </svg>
            </a>
            <a href="https://twitter.com/intent/tweet?text={{ '' }}&url={{ '' }}" target="_blank" class="p-3 hover:bg-gray-100 rounded-full sm:border">
                <svg viewBox="0 0 1200 1227" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 fill-black">
                    <path d="M714.163 519.284L1160.89 0H1055.03L667.137 450.887L357.328 0H0L468.492 681.821L0 1226.37H105.866L515.491 750.218L842.672 1226.37H1200L714.137 519.284H714.163ZM569.165 687.828L521.697 619.934L144.011 79.6944H306.615L611.412 515.685L658.88 583.579L1055.08 1150.3H892.476L569.165 687.854V687.828Z"/>
                </svg>
            </a>
        </div>
        <div class="space-y-10 [&>*:not(:first-child)]:pt-10 divide-y w-full md:space-y-16">
            <div class="flex flex-col lg:flex-row items-start gap-10 lg:gap-16">
                @unless($monument->authors->isEmpty())
                    <div class="space-y-10 shrink-0 lg:sticky lg:top-[calc(var(--nav-height)+var(--subheader-height))] lg:order-1">
                        <section class="space-y-4">
                            <p class="title-lg">
                                Realizzato da
                            </p>
                            @foreach($monument->authors as $author)
                                <a wire:navigate href="{{ route('authors.show', ['author' => $author]) }}" class="group flex gap-3 rounded-2xl">
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
                                Storia del monumento
                            </p>
                            {!! $monument->description !!}
                        </section>
                    @endunless
                    <section>
                        <h3 class="title-lg">
                            A <a wire:navigate href="{{ route('monuments.index', ['m' => $monument->municipality->istat_code]) }}" class="underline">
                                {{ $monument->municipality->getDisplayName() }}
                            </a>
                        </h3>
                        <x-map.show :$monument />
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
            <div>
                <p class="title-lg">
                    A cura di
                </p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. A accusamus accusantium, adipisci asperiores at consectetur dignissimos doloribus eligendi est excepturi illum ipsa minima minus necessitatibus officia optio provident quae quisquam repellat repellendus saepe similique voluptates? Animi culpa earum non odit!
            </div>
        </div>
    </div>

{{--    @unless($monument->classes->isEmpty())
        <section class="mx-auto max-w-5xl w-11/12 grid gap-20 py-20">
            @foreach($monument->classes as $class)
                <div class="flex justify-around">
                    <div class="max-w-xs">
                        <p class="font-extralight italic text-sm">
                            Classe
                        </p>
                        <p>
                            {{ $class->grade . "°" . $class->section . (!empty($class->discipline) ? " " . $class->discipline : "") . ", A.S. " . $class->year}}
                        </p>
                    </div>
                    <div class="max-w-xs">
                        <p class="font-extralight italic text-sm">
                            Scuola
                        </p>
                        <p>
                            {{ $class->school->name }}
                        </p>
                    </div>
                    @isset($class->teachers)
                        <div class="max-w-xs">
                            <p class="font-extralight italic text-sm">
                                Prof.
                            </p>
                            <p>
                            </p>
                        </div>
                    @endisset
                </div>
                @isset($class->pivot->photo)
                    <img src="{{ asset(Storage::url($class->pivot->photo)) }}" alt="Foto di classe">
                @endisset
            @endforeach
        </section>
    @endunless--}}

    @if($monument->webcall?->resources)
        <div class="sticky bottom-0 z-20">
            <div x-data="{ show : window.pageYOffset < 10, open : false }" class="absolute right-14 bottom-10 flex flex-col items-end gap-6">
                <p class="max-w-[180px] hidden md:block text-right text-sm text-white/50 italic font-extralight ease-in-out duration-200"
                   @scroll.window="show = window.pageYOffset < 10"
                   x-show="show" x-transition
                >
                    Ascolta la statua chiamando il
                    <a href="tel:+39{{ str_replace(' ', '', $monument->phone_number) }}" class="whitespace-nowrap text-green-500">+39 {{ $monument->phone_number }}</a>,<br>
                    oppure clicca il bottone qui sotto
                </p>
                <x-button.rounded
                    @click="$store.sidebar.toggle(); open = !open"
                    icon="svg/call.svg"
                    bg="bg-green-500"
                />
            </div>
        </div>

        @section('sidebar')
            <object class="w-full h-full" type="text/html" data="{{ route('call', $monument) }}"></object>
        @endsection
    @endif
@endsection
