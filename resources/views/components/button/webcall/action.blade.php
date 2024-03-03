@props(['action', 'language' => null, 'icon' => null])

<button
    @click="{{ $action }}"
    @class([
        "btn-webcall",
        "order-first" => $language == app()->getLocale()
    ])
>
    @isset($icon)
        @svg($icon, 'size-8')
    @endisset

    <span>
        {{ $slot }}
    </span>
</button>
