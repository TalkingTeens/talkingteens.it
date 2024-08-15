@props(['title', 'subtitle', 'src'])

<section class="relative">
    <div class="max-w-3xl mx-auto text-white text-center space-y-4 py-36">
        <h1 class="badge">
            {{ $title }}
        </h1>

        <h2 class="title-xl">
            {{ $subtitle }}
        </h2>
    </div>

    <img src="{{ asset($src) }}" class="absolute -z-10 inset-0 h-full w-full object-cover"
         alt="">

    {{ $slot }}
</section>
