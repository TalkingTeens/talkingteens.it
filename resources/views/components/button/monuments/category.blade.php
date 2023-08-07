@props(['category' => null, 'title', 'icon' => 'svg/collection.svg', 'alt'])

<div
    @click="Livewire.emit('changeCategory', '{{ $category }}');
            active = '{{ $category }}'"
    :class="active === '{{ $category }}' ? '' : 'opacity-70 hover:opacity-100'"
    class="cursor-pointer flex flex-col gap-1"
>
    <img class="w-7 h-7 mx-auto" src="{{ asset($icon) }}" alt="{{ $alt }}">
    <p class="text-xs font-medium">
        {{ $title }}
    </p>
</div>
