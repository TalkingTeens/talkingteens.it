<section class="relative">
    <x-ui.subheader>
        <div wire:ignore x-data="{ active : '{{ request('c') }}' }"
             class="h-[var(--subheader-height)] no-scrollbar overflow-x-auto max-w-6xl flex items-center gap-x-5 sm:gap-x-8 lg:gap-x-10">
            <x-button.monuments.category :title="__('monuments.filters.all')"
                                         :icon="asset('svg/grid.svg')"
                                         alt="Icona"/>

            @foreach($categories as $category)
                @continue(!$category->slug || !$category->name)

                <x-button.monuments.category :title="$category->name"
                                             :category="$category->slug"
                                             :icon="$category->getFirstMedia('categories')?->getFullUrl()"
                                             alt="Icona"/>
            @endforeach
        </div>
    </x-ui.subheader>

    @if($view === 'list')
        <div class='max-w-7xl w-11/12 mx-auto mt-6 md:mt-16 pb-32 grid md:grid-cols-2 xl:grid-cols-3 gap-4'>
            @forelse($monuments as $monument)
                <x-card.monument :$monument/>
            @empty
                <p class="col-span-full">
                    {{ __('monuments.empty') }}
                </p>
            @endforelse
        </div>
    @else
        <x-map :$monuments/>
    @endif

    <div
        wire:click="toggleView"
        @click="window.scrollTo({ top: 0 })"
        class="sticky bottom-0"
    >
        {{-- outline button component --}}
        <button type="button"
                class="absolute bottom-10 left-1/2 -translate-x-1/2 rounded-full shadow-lg bg-st cursor-pointer inline-block py-3 px-4">
            <span
                class="flex justify-center items-center gap-x-2"
            >
                @if($view === 'list')
                    <span class="text-sm font-medium">
                        {{ __('monuments.map') }}
                    </span>

                    <x-heroicon-o-globe-europe-africa class="size-6"/>
                @else
                    <span class="text-sm font-medium">
                        {{ __('monuments.list') }}
                    </span>

                    <x-heroicon-o-list-bullet class="size-6"/>
                @endif
            </span>
        </button>
    </div>

    <div wire:loading.delay class="absolute z-10 inset-0 bg-white/50"></div>
</section>
