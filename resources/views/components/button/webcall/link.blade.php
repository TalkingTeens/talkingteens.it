<a wire:navigate href="{{ $href }}" class="btn-webcall">
    <img src="{{ asset($src) }}" alt="{{ $alt }}" class="h-8 w-8">
    <span>
        {{ $slot }}
    </span>
</a>
