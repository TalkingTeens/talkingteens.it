<a
    wire:click="open"
    target="_blank"
    href="{{ asset(Storage::url($document->resource)) }}"
    class="sm:p-2 sm:bg-gray-100 sm:hover:bg-st/40 rounded-2xl items-center"
>
    <div class="flex items-center px-2 py-3 gap-3">
        <img
            class="h-6 w-6"
            src="{{ asset('svg/document/file.svg') }}"
            alt=""
        >
        <div class="grow sm:overflow-hidden">
            <h3 class="text-sm font-medium sm:text-ellipsis sm:overflow-hidden sm:whitespace-nowrap">
                {{ $document->title }}
            </h3>
            <p class="text-xs">
                {{ $size }}
            </p>
        </div>
        <livewire:document.download :document="$document" />
    </div>

    <div class="overflow-hidden rounded-xl md:h-48 relative bg-white">
        @if(isset($document->picture))
            <img
                class="hidden md:block aspect-square object-top object-cover w-full h-full"
                src="{{ asset(Storage::url($document->picture)) }}"
                alt=""
            >
        @else
            <img
                class="hidden md:block h-16 w-16 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"
                src="{{ asset('svg/document/file.svg') }}"
                alt=""
            >
        @endif
    </div>
</a>
