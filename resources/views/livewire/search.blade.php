<x-ui.dropdown.search :$label>
    @foreach($municipalities as $municipality)
        <button
            type="button"
            wire:key="{{ $municipality->istat_code }}"
            @click="$dispatch('change-municipality', { code: '{{ $municipality->istat_code }}' }); close()"
            class="btn-result cursor-pointer"
        >
            {{ $municipality->getDisplayName() }}
        </button>
    @endforeach
</x-ui.dropdown.search>
