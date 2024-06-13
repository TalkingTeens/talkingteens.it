<button
    type="button"
    @click="method = '{{ $method }}'"
    class="max-w-80 grow flex py-5 sm:p-6 gap-x-4 rounded-t-2xl items-center justify-center"
    :class="method === '{{ $method }}' ? 'bg-white' : 'bg-neutral-200'"
>
    @svg($method, 'size-8 max-sm:hidden')

    <span class="font-semibold">
        {{ __("donate.methods.{$method}.title") }}
    </span>
</button>
