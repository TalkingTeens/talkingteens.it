@props(['src', 'alt', 'size' => 'w-16'])

<img src="{{ $src }}" alt="{{ $alt }}" @class([
    'shrink-0 aspect-square object-cover rounded-full', $size
])>
