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
    class="relative z-10"
>
    <button
        type="button"
        :aria-expanded="open"
        :aria-controls="$id('dropdown')"
        @click="open = ! open"
        class="p-3 hover:bg-gray-100 rounded-full"
    >
        <x-heroicon-o-globe-alt class="size-5" />
    </button>

    <div
        x-cloak
        x-transition.origin.top.right
        x-ref="panel"
        x-show="open"
        :id="$id('dropdown')"
        @click.outside="close()"
        class="absolute right-0 bg-white rounded-lg border shadow overflow-hidden p-1 space-y-1"
    >
        @foreach (LaravelLocalization::getSupportedLocales() as $locale => $lang)
            <a wire:navigate href="{{ LaravelLocalization::getLocalizedURL($locale, null, [], true) }}" @class([
                "block py-2 px-4 rounded-lg hover:bg-gray-100"
            ])>
                {{ $lang["native"] }}
            </a>
        @endforeach
    </div>
</div>
