@props(['category' => '', 'title', 'icon' => 'svg/collection.svg', 'alt'])

<div
    @click="$dispatch('change-category', { category: '{{ $category }}'});
            window.scrollTo({top: 0})
            active = '{{ $category }}'"
    :class="active === '{{ $category }}' ? '' : 'opacity-70 hover:opacity-100'"
    class="cursor-pointer flex flex-col gap-1 text-center"
>
    <img class="w-7 h-7 mx-auto" src="{{ asset($icon) }}" alt="{{ $alt }}">
    <p class="text-xs font-medium">
        {{ $title }}
    </p>
</div>
