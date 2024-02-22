@if(isset($href))
    <a wire:navigate {{ $attributes->merge(['class' => "btn group/button"]) }}>
        <p class="text-center group-hover/button:opacity-0 transition-opacity">
            {{ $slot }}
        </p>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
             class="w-6 h-6 absolute top-1/2 left-1/2 group-hover/button:-translate-x-1/2 -translate-x-full -translate-y-1/2 opacity-0 group-hover/button:opacity-100 transition-all">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/>
        </svg>
    </a>
@else
    <button type="button" {{ $attributes->merge(['class' => "btn group/button"]) }}>
        <p class="group-hover/button:opacity-0 transition-opacity">
            {{ $slot }}
        </p>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
             class="w-6 h-6 absolute top-1/2 left-1/2 group-hover/button:-translate-x-1/2 -translate-x-full -translate-y-1/2 opacity-0 group-hover/button:opacity-100 transition-all">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/>
        </svg>
    </button>
@endif
