@props(["bg" => "bg-st", "icon"])

<button {{ $attributes->class(['relative rounded-full flex justify-center items-center w-20 h-20', $bg])->merge(['type' => 'button']) }}>
    <span @class(['animate-ping absolute h-4/5 w-4/5 rounded-full -z-10', $bg])></span>
    <img
        class="w-2/5"
        src="{{ asset($icon) }}"
        alt=""
    >
</button>
