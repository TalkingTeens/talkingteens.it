<nav class="sticky top-0 z-50 border-b bg-white">
    <div class="mx-auto max-w-7xl w-11/12 py-3 flex items-center justify-between gap-x-2">
        <a href="{{ route('home') }}" class="h-12 shrink-0">
            <img src="{{ asset('svg/logo/medium.svg') }}" alt="" class="h-full">
        </a>

        @if(Request::routeIs('monuments.index'))
            <livewire:search />
        @else
            <x-dropdown.search />
        @endif

        <div class="flex items-center gap-x-2">
            <x-dropdown.lang />

            <x-button.secondary :href="route('app')">
                Scarica l'app
            </x-button.secondary>
        </div>
    </div>

    @hasSection('subheader')
        <div class="border-t">
            <div class="mx-auto max-w-7xl w-11/12">
                @yield('subheader')
            </div>
        </div>
    @endif
</nav>
