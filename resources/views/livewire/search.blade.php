<x-dropdown.search :$label>
    @foreach($municipalities as $municipality)
        <button
            type="button"
            @click="close()"
            wire:click=syncMunicipality('{{ $municipality->istat_code }}')"
            class="btn-result cursor-pointer"
        >
            {{ $municipality->name . ', ' .  $municipality->province->region->name}}
        </button>
    @endforeach
</x-dropdown.search>
