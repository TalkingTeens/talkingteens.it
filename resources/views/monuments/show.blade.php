@title($monument->name)

@extends('layouts.base')

@push('meta')
@endpush

@section('body')
    <section class="relative bg-nd h-screen text-white overflow-hidden">
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
    </section>
    @unless($monument->classes->isEmpty())
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
    @endunless
    <div id="map" class="h-[60vh]"></div>

    {!! $monument->character_history !!}
    {!! $monument->monument_history !!}
@endsection

@push('scripts')
    <script>
        function initMap() {
            const mapElem = document.getElementById("map");

            const geo = {
                lat: {{ $monument->latitude }},
                lng: {{ $monument->longitude }}
            };

            const map = new google.maps.Map(mapElem, {
                zoom: 15.7,
                center: geo,
                minZoom: 3,
                restriction: {
                    latLngBounds: { north: 85, south: -85, west: -180, east: 180 }
                },
                mapTypeId: 'roadmap'
            });

            new google.maps.Marker({
                position: geo,
                map,
                icon: {
                    url: '{{ asset(Storage::url($monument->pin_image)) }}',
                    scaledSize: new google.maps.Size(60, 71.8)
                },
                title: '{{ $monument->name }}',
            });
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTr1D4oqR_NQYcN50-xynP9_-rOnWSa9w&callback=initMap"></script>
@endpush
