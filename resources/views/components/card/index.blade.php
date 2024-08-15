@props(['icon', 'title', 'description'])

<div class="space-y-2">
    <div class="p-4 inline-block bg-gray-50 rounded-full">
        @svg($icon, 'size-8')
    </div>

    <h3 class="title-lg">
        {{ $title }}
    </h3>

    <p>
        {{ $description }}
    </p>
</div>
