<a
    wire:key="{{ $document->id }}"
    wire:click="open"
    target="_blank"
    href="{{ $media->getFullUrl() }}"
    class="max-md:aspect-square p-2 bg-gray-100 items-center rounded-2xl sm:hover:bg-st/40"
>
    <div class="h-[60px] flex items-center px-2 gap-3">
        @svg("document/{$type}", 'size-6 shrink-0')

        <div class="grow overflow-hidden">
            <h4 class="max-sm:line-clamp-2 text-sm font-medium line-clamp-1">
                {{ $document->title ?: $media->name }}
            </h4>

            <p class="max-sm:hidden text-xs">
                {{ Number::fileSize($media->size ?? 0) }}
            </p>
        </div>

        <div
            role="button"
            wire:click.stop.prevent="download"
            class="max-sm:hidden p-2 rounded-full hover:bg-st"
        >
            <x-heroicon-o-arrow-down-tray class="size-5"/>
        </div>
    </div>

    <div class="max-md:h-[calc(100%-60px)] overflow-hidden rounded-xl md:h-48 relative bg-white">
        @if($media->hasGeneratedConversion('preview'))
            <img
                class="md:aspect-square object-top object-cover w-full h-full"
                src="{{ $media->getUrl('preview') }}"
                alt=""
            >
        @else
            @svg("document/{$type}", 'hidden md:block size-16 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2')
        @endif
    </div>
</a>
