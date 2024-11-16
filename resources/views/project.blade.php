@extends('layouts.default', ['title' => __('project.title')])

@push('meta')
@endpush

@section('content')
    <div class="section">
        <section class="max-w-screen-md mx-auto text-center space-y-4">
            <h1 class="badge">
                {{ __('project.title') }}
            </h1>

            <h2 class="title-xl">
                {{ __('project.subtitle') }}
            </h2>

            <p class="pt-2">
                {{ __('project.text') }}
            </p>
        </section>
    </div>

    <img src="{{ asset('/images/sponsor.jpg') }}" alt="" class="h-screen w-full object-cover">

    <section class="section space-y-16">
        <h2 class="title-xl">
            {{ __('project.about.title') }}
        </h2>

        <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-3">
            <x-card
                icon="heroicon-o-device-phone-mobile"
                :title="__('project.about.innovation.title')"
                :description="__('project.about.innovation.text')"
            />

            <x-card
                icon="heroicon-o-building-library"
                :title="__('project.about.culture.title')"
                :description="__('project.about.culture.text')"
            />

            <x-card
                icon="heroicon-o-clock"
                :title="__('project.about.time.title')"
                :description="__('project.about.time.text')"
            />

            <x-card
                icon="heroicon-o-users"
                :title="__('project.about.teenagers.title')"
                :description="__('project.about.teenagers.text')"
            />

            <x-card
                icon="heroicon-o-heart"
                :title="__('project.about.community.title')"
                :description="__('project.about.community.text')"
            />

            <x-card
                icon="deaf"
                :title="__('project.about.accessible.title')"
                :description="__('project.about.accessible.text')"
            />
        </div>
    </section>

    <div class="bg-gray-50">
        <div class="section space-y-24 sm:space-y-32">
            <section class="space-y-16">
                <div class="space-y-4 max-w-3xl mx-auto md:text-center">
                    <h2 class="badge">
                        {{ __('home.modalities.title') }}
                    </h2>

                    <h3 class="title-xl">
                        {{ __('home.modalities.subtitle') }}
                    </h3>
                </div>

                <iframe class="w-full aspect-video"
                        src="https://www.youtube.com/embed/Dw-Wwh8WEwo?si=u5AAtcms3jIdxmcu"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin"
                        allowfullscreen
                ></iframe>
            </section>

            @if(is_array($goals))
                <section class="space-y-16">
                    <h2 class="title-xl max-w-xl">
                        {{ __('project.goals.title') }}
                    </h2>

                    <ol class="space-y-12">
                        @foreach($goals as $goal)
                            <li class="grid grid-cols-[auto_1fr] items-start gap-x-6 md:gap-x-12">
                                <p class="max-sm:sticky max-sm:top-[calc(var(--nav-height)+1rem)] size-16 text-3xl flex items-center justify-center shrink-0 bg-white rounded-full">
                                    {{ $loop->iteration }}
                                </p>

                                <div>
                                    <h4 class="title-lg mb-2">
                                        {{ $goal['title'] }}
                                    </h4>

                                    <p>
                                        {{ $goal['description'] }}
                                    </p>
                                </div>
                            </li>
                        @endforeach
                    </ol>
                </section>
            @endif
        </div>
    </div>

    @unless($posts->isEmpty())
        <section class="section space-y-16">
            <div class="space-y-4 max-w-3xl mx-auto md:text-center">
                <h2 class="title-xl">
                    {{ __('project.students.title') }}
                </h2>

                <p>
                    {{ __('project.students.text') }}
                </p>
            </div>

            <div class="columns-2 gap-4 space-y-4 md:columns-3 md:gap-6 md:space-y-6 lg:gap-8 lg:space-y-8">
                @foreach($posts as $post)
                    <img class="w-full rounded-3xl" src="{{ $post->getFirstMedia('feed')->getUrl('image') }}"
                         alt="{{ $post->description }}">
                @endforeach
            </div>
        </section>
    @endunless

    <div class="section space-y-16">
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
@endsection
