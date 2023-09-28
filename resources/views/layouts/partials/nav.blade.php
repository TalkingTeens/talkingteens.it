<nav class="sticky top-0 z-50 border-b bg-white">
    <div class="mx-auto h-[var(--nav-height)] max-w-7xl w-11/12 py-3 flex items-center justify-between gap-4">
        <a wire:navigate  href="{{ route('home') }}" class="h-10 sm:h-12 shrink-0 hidden sm:block">
            <img src="{{ asset('svg/logo/medium.svg') }}" alt="" class="h-full">
        </a>

        @if(Request::routeIs('monuments.index'))
            <livewire:search />
        @else
            <x-dropdown.search />
        @endif

        <div class="flex items-center gap-x-2">
            <x-dropdown.lang />

            <a wire:navigate href="{{ route('app') }}" class="btn secondary shrink-0 hidden lg:block text-sm rounded-full py-3">
                Scarica l'app
            </a>
        </div>
    </div>

    @hasSection('subheader')
        <div class="border-t bg-white">
            <div class="mx-auto max-w-7xl w-11/12">
                @yield('subheader')
            </div>
        </div>
    @endif
</nav>
