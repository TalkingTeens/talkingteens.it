@props(['method', 'label'])

<div
    role="button"
    @click="active = 2; method = '{{ $method }}'"
    class="w-full cursor-pointer rounded-3xl flex items-center gap-5 border hover:ring-2 hover:ring-st px-8 py-6"
>
    <img src="{{ asset("svg/{$method}.svg") }}" alt="" class="size-10">
    <div>
        <p>
            {{ $label }}
        </p>
        <p class="text-xs">
            {{ $label }}
        </p>
    </div>
</div>
