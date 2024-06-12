@if(isset($href))
    <a {{ $attributes->merge(['class' => "btn group/button"]) }}>
        <p class="text-center group-hover/button:opacity-0 transition-opacity">
            {{ $slot }}
        </p>

        <x-heroicon-o-arrow-small-right
            class="size-6 absolute top-1/2 left-1/2 group-hover/button:-translate-x-1/2 -translate-x-full -translate-y-1/2 opacity-0 group-hover/button:opacity-100 transition-all"/>
    </a>
@else
    <button type="button" {{ $attributes->merge(['class' => "btn group/button"]) }}>
        <p class="group-hover/button:opacity-0 transition-opacity">
            {{ $slot }}
        </p>

        <x-heroicon-o-arrow-small-right
            class="size-6 absolute top-1/2 left-1/2 group-hover/button:-translate-x-1/2 -translate-x-full -translate-y-1/2 opacity-0 group-hover/button:opacity-100 transition-all"/>
    </button>
@endif
