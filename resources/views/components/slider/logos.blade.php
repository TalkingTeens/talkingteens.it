@unless($collection->isEmpty())
    <div
        x-data=""
        x-init="$nextTick(() => {
            let ul = $refs.logos;
            ul.insertAdjacentHTML('afterend', ul.outerHTML);
            ul.nextSibling.setAttribute('aria-hidden', 'true');
        })"
        class="w-full inline-flex flex-nowrap overflow-hidden [mask-image:_linear-gradient(to_right,transparent_0,_black_128px,_black_calc(100%-128px),transparent_100%)]"
    >
        <ul x-ref="logos" class="flex items-center justify-center md:justify-start animate-infinite-scroll">
            @foreach($collection as $element)
                <li class="w-20 md:w-28 mx-4 md:mx-8">
                    <img src="{{ asset(Storage::url($element->logo)) }}" alt="" class="w-full" />
                </li>
            @endforeach
        </ul>
    </div>
@endunless
