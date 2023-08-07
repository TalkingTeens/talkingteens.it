@props(['action', 'language' => null, 'src' => null, 'alt' => null])

<button
    wire:click="{{ $action }}"
    @class([
        "btn-webcall cursor-pointer",
        "order-first" => $language == app()->getLocale()
    ])
>
    @isset($src)
        <img src="{{ asset($src) }}" alt="{{ $alt }}" class="h-8 w-8">
    @endisset
    <p>
        {{ $slot }}
    </p>
</button>
