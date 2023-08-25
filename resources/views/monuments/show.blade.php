@title($monument->name)

@extends('layouts.default')

@push('meta')
@endpush

@section('content')
    <header class="relative bg-nd h-fill text-white overflow-hidden">
        <div class="absolute top-1/4 left-[10%] z-10 max-w-xs text-white/50">
                <a href="{{ URL::previous() }}" class="group relative hidden sm:block">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 absolute top-1/2 -translate-y-1/2 rotate-180 pointer-events-none -translate-x-8 group-hover:-translate-x-10 transition-transform">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                    </svg>
                    <p>
                        Torna indietro
                    </p>
                </a>
            <h1 class="text-4xl font-extrabold text-white my-4">
                {{ $monument->name }}
            </h1>
            <div class="flex gap-2 max-w-xs w-11/12 flex-wrap">
                @foreach($monument->categories as $category)
                    <a href="{{ route('monuments.index', ['c' => $category->slug]) }}"
                       class="text-sm bg-white/20 rounded-lg py-0.5 px-2 hover:text-white hover:bg-white/30 transition-colors">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>
        <img
            class="h-[90%] w-auto absolute bottom-0 left-2/3 lg:left-1/2 -translate-x-1/2"
            src="{{ asset(Storage::url($monument->monument_image)) }}"
            alt=""
        >
    </header>
    <div class="w-11/12 max-w-7xl mx-auto my-16">
        <div class="flex flex-col md:flex-row items-start gap-16">
            @unless($monument->authors->isEmpty())
                <div class="space-y-5 md:sticky md:top-[calc(var(--nav-height)+var(--subheader-height))] md:order-1">
                    <section>
                        <h2 class="title-lg">
                            Realizzato da
                        </h2>
                        @foreach($monument->authors as $author)
                            <a href="{{ route('authors.show', ['author' => $author]) }}" class="group flex gap-3 rounded-2xl">
                                @isset($author->picture)
                                    <img src="{{ asset(Storage::url($author->picture)) }}" alt="" class="shrink-0 object-cover rounded-full h-16 w-16">
                                @endisset
                                <div class="flex flex-col justify-center">
                                    <h3 class="group-hover:underline">
                                        {{ $author->full_name }}
                                    </h3>
                                    <p class="text-sm opacity-60 italic">
                                        @if(isset($author->death_year))
                                            {{ $author->birth_year . ' - ' . $author->death_year }}
                                        @else
                                            Nato nel {{ $author->birth_year }}
                                        @endif
                                    </p>
                                </div>
                            </a>
                        @endforeach
                    </section>
                    <section>
                        <h2 class="title-lg">
                            Materiali
                        </h2>
                        <p>
                            Bronzo e Granito
                        </p>
                    </section>
                </div>
            @endunless
            <div class="space-y-5 text-justify flex-1">
                <section>
                    <h2 class="title-lg">
                        Monumento inaugurato nel 1907
                    </h2>
                    {!! $monument->description !!}
                </section>
                <section>
                    <h2 class="title-lg">
                        Dove mi trovo
                    </h2>
                    <x-map.show :$monument class="h-96" />
                </section>
            </div>
        </div>
        <section>
            <h2 class="title-lg">
                Chi era Arturo Toscanini
            </h2>
        </section>
        <div>

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
        <div class="sticky bottom-0">
            <div x-data="{ show : window.pageYOffset < 10, open : false }" class="absolute right-14 bottom-10 flex flex-col items-end gap-6">
                <p class="max-w-[180px] text-right text-sm text-white/50 italic font-extralight ease-in-out duration-200"
                   @scroll.window="show = window.pageYOffset < 10"
                   x-show="show" x-transition
                >
                    Ascolta la statua chiamando il <a href="tel:+" class="whitespace-nowrap text-green-500">{{ $monument->phone_number }}</a>,<br>
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
