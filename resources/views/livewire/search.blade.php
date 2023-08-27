<x-dropdown.search :$label>
    @foreach($municipalities as $municipality)
        <button
            type="button"
            wire:key="{{ $municipality->istat_code }}"
            @click="$dispatch('change-municipality', { code: '{{ $municipality->istat_code }}' }); close()"
            class="btn-result cursor-pointer"
        >
            {{ $municipality->name . ', ' .  $municipality->province->region->name}}
        </button>
    @endforeach
</x-dropdown.search>
