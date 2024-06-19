<a
    wire:key="{{ $document->id }}"
    wire:click="open"
    target="_blank"
    href="{{ $media->getFullUrl() }}"
    class="p-2 bg-gray-100 sm:hover:bg-st/40 rounded-2xl items-center"
>
    <div class="flex items-center px-2 py-3 gap-3">
        @svg("document/{$type}", 'size-6 shrink-0')

        <div class="grow sm:overflow-hidden">
            <h4 class="text-sm font-medium sm:text-ellipsis sm:overflow-hidden sm:whitespace-nowrap">
                {{ $document->title ?: $media->name }}
            </h4>

            <p class="text-xs">
                {{ Number::fileSize($media->size ?? 0) }}
            </p>
        </div>

        <div
            role="button"
            wire:click.stop.prevent="download"
            class="hover:bg-st p-2 rounded-full"
        >
            <x-heroicon-o-arrow-down-tray class="size-5"/>
        </div>
    </div>

    <div class="overflow-hidden rounded-xl md:h-48 relative bg-white">
        @if($media->hasGeneratedConversion('preview'))
            <img
                class="hidden md:block aspect-square object-top object-cover w-full h-full"
                src="{{ $media->getUrl('preview') }}"
                alt=""
            >
        @else
            @svg("document/{$type}", 'hidden md:block size-16 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2')
        @endif
    </div>
</a>
