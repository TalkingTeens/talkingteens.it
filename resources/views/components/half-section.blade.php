<section class="grid gap-8 lg:grid-cols-2 lg:gap-16 lg:items-start">
    <h3 class="title-xl leading-[1.1] max-w-screen-sm lg:sticky lg:top-[calc(var(--nav-height)+4rem)]">
        {{ $title }}
    </h3>
    <div>
        {{ $slot }}
    </div>
</section>
