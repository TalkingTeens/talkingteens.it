<button
    type="button"
    @click="method = '{{ $method }}'"
    class="bg-white flex px-10 py-5 gap-x-4 rounded-t-xl items-center justify-center">
    @svg($method, 'size-8')

    <span>
        {{ __("donate.methods.{$method}.title") }}
    </span>
</button>
