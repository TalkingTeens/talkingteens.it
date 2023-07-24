@props(["bg" => "bg-st", "action", "icon"])

<button
    type="button"
    wire:click="{{ $action }}"
    @class([$bg, 'rounded-full overflow-hidden flex justify-center items-center w-20 h-20'])
>
    <img
        class="w-2/5"
        src="{{ $icon }}"
        alt=""
    >
</button>
