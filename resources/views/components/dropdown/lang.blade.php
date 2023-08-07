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
    class="relative"
>
    <button
        type="button"
        :aria-expanded="open"
        :aria-controls="$id('dropdown')"
        @click="open = ! open"
        class="p-3 hover:bg-gray-100 rounded-full"
    >
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="h-5 w-5">
            <path d="M256 48C141.13 48 48 141.13 48 256s93.13 208 208 208 208-93.13 208-208S370.87 48 256 48z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/>
            <path d="M256 48c-58.07 0-112.67 93.13-112.67 208S197.93 464 256 464s112.67-93.13 112.67-208S314.07 48 256 48z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/>
            <path d="M117.33 117.33c38.24 27.15 86.38 43.34 138.67 43.34s100.43-16.19 138.67-43.34M394.67 394.67c-38.24-27.15-86.38-43.34-138.67-43.34s-100.43 16.19-138.67 43.34" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/>
            <path fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32" d="M256 48v416M464 256H48"/>
        </svg>
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
            <a href="{{ LaravelLocalization::getLocalizedURL($locale) }}" @class([
                "block py-2 px-4 rounded-lg hover:bg-gray-100"
            ])>
                {{ $lang["native"] }}
            </a>
        @endforeach
    </div>
</div>
