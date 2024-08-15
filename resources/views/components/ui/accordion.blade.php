<dl x-data="{ open : 0 }" class="space-y-5 divide-y">
    @foreach($items as $item)
        <div x-id="['item']" class="pt-5 first:pt-0">
            <dt>
                <button
                    type="button"
                    @click="open = (open !== {{ $loop->iteration }} ? {{ $loop->iteration }} : null)"
                    :aria-expanded="open === {{ $loop->iteration }}"
                    :aria-controls="$id('item')"
                    class="w-full flex justify-between items-center"
                >
                    <span class="font-semibold">{{ $item['title'] }}</span>

                    <x-heroicon-o-chevron-down
                        class="size-5 transition-transform duration-500 ease-in-out"
                        ::class="open === {{ $loop->iteration }} ? 'rotate-180' : ''"/>
                </button>
            </dt>

            <dd x-show="open === {{ $loop->iteration }}" x-cloak x-collapse>
                <p :id="$id('item')" class="overflow-hidden pt-5">{{ $item['description'] }}</p>
            </dd>
        </div>
    @endforeach
</dl>
