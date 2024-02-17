@props(['action', 'language' => null, 'src' => null, 'alt' => null])

<button
    @click="{{ $action }}"
    @class([
        "btn-webcall",
        "order-first" => $language == app()->getLocale()
    ])
>
    @isset($src)
        <img src="{{ asset($src) }}" alt="{{ $alt }}" class="h-8 w-8">
    @endisset
    <span>
        {{ $slot }}
    </span>
</button>
