@props(['href', 'back' => true, 'transform' => true])

<a href="{{ $href }}" {{ $attributes->class(['group relative flex items-center gap-x-1', 'md:inline-block' => $transform]) }}>
    <x-heroicon-o-arrow-small-right
        @class([
            "md:transition-transform md:absolute md:top-1/2 md:-translate-y-1/2" => $transform,
            "md:-translate-x-6 md:group-hover:-translate-x-7 lg:-translate-x-8 lg:group-hover:-translate-x-10" => $transform && $back,
            "md:translate-x-6 md:group-hover:translate-x-7 lg:translate-x-8 lg:group-hover:translate-x-10" => $transform && !$back,
            "rotate-180" => $back,
            "md:right-0 order-1" => !$back,
            "w-5 h-5"
        ])
    />
    <span>
        {{ $slot }}
    </span>
</a>
