@props(['target' => 'self', 'href'])

<a href="{{ $href }}" target="_{{ $target }}" class="group bg-st inline-block rounded-xl relative py-2 px-4 font-semibold focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-st">
    <p class="text-center group-hover:opacity-0 transition-opacity">
        {{ $slot }}
    </p>
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 absolute top-1/2 left-1/2 group-hover:-translate-x-1/2 -translate-x-full -translate-y-1/2 opacity-0 group-hover:opacity-100 transition-all">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
    </svg>
</a>