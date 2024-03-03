@props(['icon', 'title', 'description'])

<li class="flex flex-col gap-y-1 items-center text-center">
    @svg($icon, 'w-12 h-12')
    <h3 class="font-bold mt-1 uppercase">
        {{ $title }}
    </h3>
    <p class="text-xs">
        {{ $description }}
    </p>
</li>
