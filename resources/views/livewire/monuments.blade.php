<section class="relative">
    <x-ui.subheader>
        <div x-data="{ active : '{{ request('c') }}' }"
             class="h-[var(--subheader-height)] no-scrollbar overflow-x-auto max-w-6xl flex items-center gap-x-5 sm:gap-x-8 lg:gap-x-10">
            <x-button.monuments.category title="Tutto" icon="svg/grid.svg" alt="Icona"/>
            @foreach($categories as $category)
                @continue(!$category->slug || !$category->name)
                <x-button.monuments.category :title="$category->name"
                                             :category="$category->slug"
                                             :icon="isset($category->icon) ? Storage::url($category->icon) : null"
                                             alt="Icona"/>
            @endforeach
        </div>
    </x-ui.subheader>

    <div @class([
        'max-w-7xl w-11/12 mx-auto mt-16 mb-32 grid md:grid-cols-2 xl:grid-cols-3 gap-4',
        'hidden' => $view === 'map'
    ])>
        @forelse($monuments as $monument)
            <x-card.monument :$monument/>
        @empty
            <p class="col-span-full">
                {{ __('monuments.empty') }}
            </p>
        @endforelse
    </div>

    <div @class(['hidden' => $view === 'list'])>
        <x-map :$monuments/>
    </div>

    <x-button.monuments.view :$view/>
</section>

@pushonce('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTr1D4oqR_NQYcN50-xynP9_-rOnWSa9w"></script>
@endpushonce
