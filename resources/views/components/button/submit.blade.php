<button
    type="submit"
    wire:loading.attr="disabled"
    {{ $attributes->merge(['class' => "btn primary flex justify-center"]) }}
>
    <span wire:loading.delay>
        <span role="status" class="flex items-center gap-x-2">
            <span aria-hidden="true">
                @svg('spinner', 'size-5 animate-spin')
            </span>
            <span>
                {{ __('common.loading') }}
            </span>
        </span>
    </span>
    <span wire:loading.delay.remove>
        {{ $slot }}
    </span>
</button>
