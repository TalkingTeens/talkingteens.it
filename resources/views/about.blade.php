@extends('layouts.default', ['title' => __('about.title')])

@push('meta')
@endpush

@section('content')
    <div class="grid items-start lg:grid-cols-2">
        <div class="max-lg:hidden sticky top-[--nav-height]">
            <img src="{{ asset('/images/sponsor.jpg') }}"
                 class="w-full h-[calc(100svh-var(--nav-height))] object-cover"
                 alt="{{ __('about.alt') }}">
        </div>

        <div class="section space-y-16 lg:mx-0 lg:w-full lg:px-[calc(100vw/24)] xl:pr-[calc((100vw-80rem)/2)]">
            <section class="space-y-6">
                <h1 class="title-xl">
                    {{ __('about.title') }}
                </h1>

                <p>
                    {{ __('about.description') }}
                </p>

                <img src="{{ asset('images/echo-full.png') }}" alt="ECHO - Education Culture Human Oxygen Logo">

                <p>
                    {{ __('about.echo') }}
                </p>
            </section>

            <section>
                <h2 class="title-lg">

                    {{ __("about.partners") }}
                </h2>

                <ul>
                    <li>Itis Leonardo Da VINCI</li>

                    <li>Liceo artistico Paola TOSCHI</li>

                    <li>FAI - Fondo per l'Ambiente italiano</li>
                </ul>
            </section>

            @unless($schools->isEmpty())
                <section>
                    <h2 class="title-lg">
                        {{ __('about.schools') }}
                    </h2>

                    <ul>
                        @foreach($schools as $school)
                            <li>
                                {{ $school->full_name }}
                            </li>
                        @endforeach
                    </ul>
                </section>
            @endunless

            <section>
                <h2 class="title-lg">
                    {{ __("about.associations") }}
                </h2>

                <ul>
                    <li>ENS - Ente Nazionale Sordi</li>

                    <li>UICI - Unione Italiana Ciechi e Ipovedenti</li>

                    <li>Anmic Parma</li>

                    <li>Consulta per il dialetto parmigiano</li>

                    <li>Maurizio Trapelli - Al Dsèvod (mashera parmigiana) - Famja Pramzana</li>
                </ul>
            </section>

            @foreach($supporters as $type => $group)
                <section>
                    <h2 class="title-lg">
                        {{ __("about.thanks.{$type}") }}
                    </h2>

                    <ul>
                        @foreach($group as $supporter)
                            <li>
                                {{ $supporter->full_name }}
                            </li>
                        @endforeach
                    </ul>
                </section>
            @endforeach

            <section>
                <h2 class="title-lg">
                    {{ __("about.committee.title") }}
                </h2>

                <ul>
                    <li>
                        {{ __('about.committee.members.federica', ['name' => 'Federica Pascotto']) }}
                    </li>

                    <li>
                        {{ __('about.committee.members.mario', ['name' => 'Mario Petriccione']) }}
                    </li>

                    <li>
                        {{ __('about.committee.members.carlotta', ['name' => 'Carlotta Sorba']) }}
                    </li>

                    <li>
                        {{ __('about.committee.members.vanja', ['name' => 'Vanja Strukelj']) }}
                    </li>
                </ul>
            </section>
        </div>
    </div>
@endsection
