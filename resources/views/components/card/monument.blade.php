<a wire:navigate
   class="group z-0 p-14 bg-nd h-72 text-white rounded-3xl hover:scale-98 transition-transform duration-300 relative overflow-hidden text-right flex items-center justify-end"
   href="{{ route('monuments.show', ['monument' => $monument]) }}"
>
    <img
        class="absolute bottom-0 left-1/4 h-full -translate-x-1/3"
        src="{{ asset(Storage::url($monument->monument_image)) }}"
        alt=""
    >

    <div class="z-10 group-hover:scale-102 transition-transform duration-300 w-1/2">
        <h2 class="text-2xl font-extrabold leading-tight">
            {{ $monument->name }}
        </h2>
        <p class="text-white/50">
            {{ $monument->municipality->name }}
        </p>
    </div>
</a>
