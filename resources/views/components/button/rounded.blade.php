@props(["icon", "ping" => false, "bg" => "bg-st"])

<button {{ $attributes->class(['relative rounded-full flex justify-center items-center z-0 size-20', $bg])->merge(['type' => 'button']) }}>
    @if($ping)
        <span @class(['animate-ping absolute h-4/5 w-4/5 rounded-full -z-10 pointer-events-none', $bg])></span>
    @endif
    <img
        class="w-2/5"
        src="{{ asset($icon) }}"
        alt=""
    >
</button>
