<a
    class="group bg-nd h-72 p-14 text-white rounded-3xl hover:scale-98 transition-transform duration-300 text-right relative overflow-hidden flex items-center justify-end"
    href="{{ route('monuments.show', ['monument' => $monument]) }}"
>
    <img
        class="absolute bottom-0 left-1/4 h-full -translate-x-1/3"
        src="{{ Storage::url($monument->monument_image) }}" {{-- asset( --}}
        alt=""
    >

    <div dir="rtl" class="z-10 group-hover:scale-102 transition-transform duration-300 w-full">
        <h2 class="text-2xl font-extrabold leading-tight w-1/2">
            {{ $monument->name }}
        </h2>
        <p class="text-white/50">
            {{ $monument->municipality->name }}
        </p>
    </div>
</a>
