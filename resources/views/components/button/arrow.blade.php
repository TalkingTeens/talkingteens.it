@props(['href', 'back' => true, 'transform' => true])

<a wire:navigate
   href="{{ $href }}" {{ $attributes->class(['group relative flex items-center gap-x-1', 'md:inline-block' => $transform]) }}>
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
        @class([
            "pointer-events-none md:transition-transform md:absolute md:top-1/2 md:-translate-y-1/2" => $transform,
            "md:-translate-x-6 md:group-hover:-translate-x-7 lg:-translate-x-8 lg:group-hover:-translate-x-10" => $transform && $back,
            "md:translate-x-6 md:group-hover:translate-x-7 lg:translate-x-8 lg:group-hover:translate-x-10" => $transform && !$back,
            "rotate-180" => $back,
            "md:right-0 order-1" => !$back,
            "w-5 h-5"
        ])>
        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/>
    </svg>
    <span>
        {{ $slot }}
    </span>
</a>
