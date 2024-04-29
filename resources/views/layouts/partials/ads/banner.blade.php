@unless(Request::routeIs('donate'))
    <a href="{{ route('donate') }}"
       class="hidden sm:flex bg-st relative z-20 h-[var(--banner-height)] text-center items-center gap-1 justify-center text-sm"
    >
        {{ __('common.nav.donate') }}
    </a>
@endunless
