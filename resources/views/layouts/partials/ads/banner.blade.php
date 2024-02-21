@unless(Request::routeIs('donate'))
    <a wire:navigate
       href="{{ route('donate') }}"
       class="hidden sm:flex bg-st h-[var(--banner-height)] text-center items-center gap-1 justify-center text-sm"
    >
        {{ __('common.nav.donate') }}
    </a>
@endunless
