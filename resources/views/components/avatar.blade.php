@props(['src', 'alt', 'size' => 'w-16'])

<img src="{{ asset(Storage::url($src)) }}" alt="{{ $alt }}" @class([
    'shrink-0 aspect-square object-cover rounded-full', $size
])>
