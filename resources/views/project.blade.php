@extends('layouts.default', ['title' => __('project.title')])

@push('meta')
@endpush

@section('content')
    <x-ui.hero
        :title="__('project.title')"
        :subtitle="__('project.subtitle')"
        src="/images/sponsor.jpg"
    />

    <div class="section space-y-16">
        <section class="space-y-16">
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
    </div>

    <x-modalities/>

    @unless($posts->isEmpty())
        <section class="section space-y-16">
            <h2 class="title-xl">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos, voluptatum?
            </h2>

            <div class="columns-2 gap-4 space-y-4 md:columns-3 md:gap-6 md:space-y-6 lg:gap-8 lg:space-y-8">
                @foreach($posts as $post)
                    <img class="w-full rounded-3xl" src="{{ $post->getFirstMedia('feed')->getUrl('image') }}"
                         alt="{{ $post->description }}">
                @endforeach
            </div>
        </section>
    @endunless
@endsection
