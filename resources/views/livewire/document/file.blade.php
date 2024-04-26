<a
    wire:key="{{ $document->id }}"
    wire:click="open"
    target="_blank"
    href="{{ $media?->getFullUrl()  }}"
    class="p-2 bg-gray-100 sm:hover:bg-st/40 rounded-2xl items-center"
>
    <div class="flex items-center px-2 py-3 gap-3">
        <img
            class="h-6 w-6"
            src='{{ asset("svg/document/{$type}.svg") }}'
            alt=""
        >

        <div class="grow sm:overflow-hidden">
            <h3 class="text-sm font-medium sm:text-ellipsis sm:overflow-hidden sm:whitespace-nowrap">
                {{ $document->title ?: $media?->name }}
            </h3>

            <p class="text-xs">
                {{ $size }}
            </p>
        </div>

        <button type="button" wire:click.stop.prevent="download" class="hover:bg-st p-2 rounded-full">
            <x-heroicon-o-arrow-down-tray class="size-5"/>
        </button>
    </div>

    <div class="overflow-hidden rounded-xl md:h-48 relative bg-white">
        @if($media?->getUrl('preview'))
            <img
                class="hidden md:block aspect-square object-top object-cover w-full h-full"
                src="{{ $media->getUrl('preview') }}"
                alt=""
            >
        @else {{-- TODO: check if still needed --}}
            <img
                class="hidden md:block h-16 w-16 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"
                src='{{ asset("svg/document/{$type}.svg") }}'
                alt=""
            >
        @endif
    </div>
</a>
