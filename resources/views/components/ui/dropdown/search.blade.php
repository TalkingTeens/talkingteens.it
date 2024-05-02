@props(['municipalities', 'label' => null])

<div
    x-data="{
        open : false,
        close() {
            this.open = false
        }
    }"
    @keydown.escape.prevent.stop="close()"
    @focusin.window="! $refs.panel.contains($event.target) && close()"
    x-id="['dropdown']"
    class="relative grow min-w-0 max-w-lg"
>
    <button
        type="button"
        :aria-expanded="open"
        :aria-controls="$id('dropdown')"
        @click="open = ! open"
        class="flex items-center w-full justify-between rounded-full border p-2 shadow hover:shadow-md cursor-pointer"
    >
        <p @class([
            'mx-3 truncate',
            'opacity-50' => !$label,
        ])>
            {{ $label ?? __('common.nav.search.label') }}
        </p>

        @if($label)
            <div wire:click.stop="$dispatch('change-municipality', { code : '' })" @click="close()"
                 class="bg-st rounded-full p-1.5 shrink-0">
                <x-heroicon-o-x-mark class="size-5 transition-transform duration-200 ease-in-out"/>
            </div>
        @else
            <div class="bg-st rounded-full p-1.5 shrink-0">
                <x-heroicon-o-chevron-down class="size-5 transition-transform duration-200 ease-in-out"
                                           ::class="open ? 'rotate-180' : ''"/>
            </div>
        @endif
    </button>

    <div
        x-cloak
        x-transition
        x-ref="panel"
        x-show="open"
        :id="$id('dropdown')"
        @click.outside="close()"
        class="absolute left-0 mt-2 bg-white w-full rounded-3xl py-2 border shadow-xl overflow-hidden z-50"
    >
        @if($slot->isNotEmpty())
            {{ $slot }}
        @else
            @if($municipalities->count() <= 1)
                <a href="{{ route('monuments.index') }}" class="btn-result">
                    {{ __('common.nav.search.default') }}
                </a>
            @endif

            @foreach($municipalities as $municipality)
                <a href="{{ route('monuments.index', ['m' => $municipality->istat_code]) }}"
                   class="btn-result">
                    {{ $municipality->getDisplayName() }}
                </a>
            @endforeach
        @endif
    </div>
</div>
