@props(['icon', 'title', 'description'])

<li class="flex flex-col gap-y-1 items-center text-center">
    <img src="{{ asset("svg/{$icon}.svg") }}" alt="" class="w-12 h-12 text-st">
    <h3 class="font-bold mt-1 uppercase">
        {{ $title }}
    </h3>
    <p class="text-xs">
        {{ $description }}
    </p>
</li>
