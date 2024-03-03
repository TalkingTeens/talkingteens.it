<div
    wire:click="toggleView"
    @click="window.scrollTo({ top: 0 })"
    class="sticky bottom-0"
>
    {{-- outline button component --}}
    <button type="button"
            class="absolute bottom-10 left-1/2 -translate-x-1/2 rounded-full shadow-lg bg-st cursor-pointer inline-block py-3 px-4">
        <div
            class="flex justify-center items-center gap-x-2"
        >
            @if($view === 'list')
                <span class="text-sm font-medium">
                    {{ __('monuments.map') }}
                </span>

                <x-heroicon-o-globe-europe-africa  class="size-6"/>
            @else
                <span class="text-sm font-medium">
                    {{ __('monuments.list') }}
                </span>

                <x-heroicon-o-list-bullet class="size-6"/>
            @endif


        </div>
    </button>
</div>
