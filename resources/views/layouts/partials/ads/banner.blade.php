@unless(Request::routeIs('donate'))
    <a wire:navigate
       href="{{ route('donate') }}"
       class="bg-st h-[var(--banner-height)] text-center flex items-center gap-1 justify-center text-sm"
    >
        <p class="max-w-sm">
            Sostieni il progetto con una semplice donazione
        </p>
    </a>
@endunless
