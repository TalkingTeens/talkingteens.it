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
    class="relative w-full max-w-lg"
>
    <button
        type="button"
        :aria-expanded="open"
        :aria-controls="$id('dropdown')"
        @click="open = ! open"
        class="flex items-center w-full justify-between gap-x-2 rounded-full border p-2 shadow hover:shadow-md cursor-pointer"
    >
        <p @class([
            'mx-3 text-ellipsis overflow-hidden whitespace-nowrap',
            'opacity-50' => !$label,
        ])>
            {{ $label ?? __('common.nav.search.label') }}
        </p>

        @if($label)
            <div wire:click.stop="$dispatch('change-municipality', { code : '' })" class="bg-st rounded-full p-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="h-5 w-5 transition-transform duration-200">
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="38" d="M368 368L144 144M368 144L144 368"/>
                </svg>
            </div>
        @else
            <div class="bg-st rounded-full p-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="h-5 w-5 transition-transform duration-200" :class="open ? 'rotate-180' : ''">
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="38" d="M112 184l144 144 144-144"/>
                </svg>
            </div>
        @endif

    </button>

    <div
        x-cloak x-transition x-ref="panel" x-show="open"
        :id="$id('dropdown')"
        @click.outside="close()"
        class="absolute left-0 mt-2 bg-white w-full rounded-3xl py-2 border shadow-xl overflow-hidden z-50"
    >
        @if($slot->isNotEmpty())
            {{ $slot }}
        @else
            <a wire:navigate href="{{ route('monuments.index') }}" class="btn-result">
                {{ __('common.nav.search.default') }}
            </a>
            @foreach($municipalities as $municipality)
                <a wire:navigate href="{{ route('monuments.index', ['m' => $municipality->istat_code]) }}" class="btn-result">
                    {{ $municipality->getDisplayName() }}
                </a>
            @endforeach
        @endif
    </div>
</div>
