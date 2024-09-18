@extends('layouts.default', ['title' => __('project.title')])

@push('meta')
@endpush

@section('content')
    <section class="section space-y-16">
        <div class="max-w-screen-md space-y-4">
            <h1 class="badge">
                {{ __('project.title') }}
            </h1>

            <h2 class="title-xl">
                {{ __('project.subtitle') }}
            </h2>

            <p class="pt-4">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae fugit labore magni, qui similique
                temporibus veniam voluptatem. Ad, aliquam aliquid amet beatae culpa earum, harum magni rem sequi ut
                veniam?
            </p>
        </div>

        <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-3">
            <x-card
                icon="heroicon-o-device-phone-mobile"
                :title="__('project.about.innovation.title')"
                :description="__('project.about.innovation.text')"
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
                icon="deaf"
                :title="__('project.about.accessible.title')"
                :description="__('project.about.accessible.text')"
            />

            <x-card
                icon="heroicon-o-building-library"
                :title="__('project.about.culture.title')"
                :description="__('project.about.culture.text')"
            />

            <x-card
                icon="heroicon-o-heart"
                :title="__('project.about.alive.title')"
                :description="__('project.about.alive.text')"
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
                    <div class="space-y-4">
                        <h2 class="badge">
                            {{ __('project.goals.title') }}
                        </h2>

                        <h3 class="title-xl max-w-xl">
                            {{ __('project.goals.subtitle') }}
                        </h3>
                    </div>

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
                    Il cuore pulsante del progetto: gli studenti.
                </h2>

                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque esse in maiores, minus officia
                    quae quod reiciendis saepe sunt veritatis.
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
@endsection
