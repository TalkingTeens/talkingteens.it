@title('Statue')

<section>
    @if($view === 'list')
        <div class="max-w-7xl w-11/12 mx-auto my-16 grid gap-4">
            <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-4">
                @forelse($monuments as $monument)
                    <x-card.monument :$monument />
                @empty
                    <p>
                        Nessun risultato trovato.
                    </p>
                @endforelse
            </div>
        </div>
    @else
        <x-map />
    @endif

    <x-button.monuments.view />
</section>

@section('subheader')
    <div x-data="{ active : '{{ request('c') }}' }" class="pb-3 pt-4 no-scrollbar overflow-x-auto max-w-6xl flex gap-x-5 sm:gap-x-8 lg:gap-x-10">
        <x-button.monuments.category title="Tutto" icon="svg/grid.svg" alt="Icona" />
        @foreach($categories as $category)
            <x-button.monuments.category :title="$category->name"
                                         :category="$category->slug"
                                         :icon="isset($category->icon) ? Storage::url($category->icon) : null"
                                         alt="Icona"/>
        @endforeach
    </div>
@endsection

@pushonce('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTr1D4oqR_NQYcN50-xynP9_-rOnWSa9w"></script>
    <script>
        console.log(@js($monuments));
    </script>
@endpushonce