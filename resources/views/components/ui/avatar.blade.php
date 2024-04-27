@props(['src', 'alt', 'size' => 'w-16'])

@if($src)
    <img src="{{ $src }}" alt="{{ $alt }}" {{ $attributes->class([
        'shrink-0 aspect-square object-cover rounded-full', $size
    ]) }}>
@endif
