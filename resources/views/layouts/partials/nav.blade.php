<nav class="sticky top-0 z-50 border-b bg-white">
    <div class="mx-auto h-[var(--nav-height)] max-w-7xl w-11/12 py-3 flex items-center justify-between gap-4">
        <a wire:navigate  href="{{ route('home') }}" class="h-10 sm:h-12 shrink-0">
            @svg('logo/medium', 'h-full max-sm:hidden')

            @svg('logo/small', 'h-full sm:hidden')
        </a>

        @if(Request::routeIs('monuments.index'))
            <livewire:search />
        @else
            <x-ui.dropdown.search />
        @endif

        <div class="flex items-center max-sm:hidden gap-x-2">
            <x-ui.dropdown.lang />

            <a wire:navigate href="{{ route('app') }}" class="max-lg:hidden btn secondary text-sm rounded-full py-3">
                {{ __('common.nav.app') }}
            </a>
        </div>
    </div>
</nav>
