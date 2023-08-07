@props(['target' => 'self', 'href'])

<a href="{{ $href }}" class="text-sm font-medium hover:bg-gray-100 rounded-full p-3 border">
    {{ $slot }}
</a>
