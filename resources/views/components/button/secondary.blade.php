@props(['target' => 'self', 'href'])

<a href="{{ $href }}" class="text-sm font-medium hover:bg-gray-100 rounded-full py-3 px-4">
    {{ $slot }}
</a>
