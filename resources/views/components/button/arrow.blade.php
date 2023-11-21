@props(['href', 'back' => true])

<a wire:navigate href="{{ $href }}" {{ $attributes->class(['group relative flex md:inline-block items-center gap-x-1']) }}>
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
        @class([
            "rotate-180 md:-translate-x-6 md:group-hover:-translate-x-7 lg:-translate-x-8 lg:group-hover:-translate-x-10" => $back,
            "md:right-0 order-1 md:translate-x-6 md:group-hover:translate-x-7 lg:translate-x-8 lg:group-hover:translate-x-10" => !$back,
            "w-5 h-5 md:absolute md:top-1/2 md:-translate-y-1/2 pointer-events-none md:transition-transform"
        ])>
        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
    </svg>
    <span>
        {{ $slot }}
    </span>
</a>
