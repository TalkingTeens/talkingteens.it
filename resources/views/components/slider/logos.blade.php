@unless($collection->isEmpty())
    <div
        class="w-full inline-flex flex-nowrap overflow-hidden group [mask-image:_linear-gradient(to_right,transparent_0,_black_128px,_black_calc(100%-128px),transparent_100%)]">
        @for ($i = 0; $i < 2; $i++)
            <ul
                class="flex items-center justify-center md:justify-start animate-marquee group-hover:[animation-play-state:paused]"
                aria-hidden="{{ $i ? 'true' : 'false' }}"
            >
                @foreach($collection as $element)
                    <li class="w-20 md:w-28 mx-4 md:mx-8">
                        @if(isset($element->resource))
                            <a href="{{ $element->resource }}" target="_blank"
                               class="block hover:scale-98 transition-transform">
                                <img src="{{ asset(Storage::url($element->logo)) }}" alt="{{ $element->name }} logo"
                                     class="w-full"/>
                            </a>
                        @else
                            <img src="{{ asset(Storage::url($element->logo)) }}" alt="{{ $element->name }} logo"
                                 class="w-full"/>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endfor
    </div>
@endunless
