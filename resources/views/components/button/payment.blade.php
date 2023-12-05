@props(['method', 'label'])

<button
    type="button"
    @click="active = 2; method = '{{ $method }}'"
    class="cursor-pointer aspect-square rounded-3xl flex-1 grid gap-1 border hover:ring-2 hover:ring-st"
>
    <img src="{{ asset("svg/{$method}.svg") }}" alt="" class="h-1/2 mx-auto">
    <span>
        {{ $label }}
    </span>
</button>
