@unless($collection->isEmpty())
    <div {{ $attributes->class(['grid place-items-center grid-cols-2 gap-8 sm:gap-12 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6']) }}>
        @foreach($collection as $element)
            <div class="w-2/3 md:w-4/5 xl:w-3/4">
                @if(isset($element->resource))
                    <a href="{{ $element->resource }}" target="_blank" class="block hover:scale-98 transition-transform">
                        <img src="{{ asset(Storage::url($element->logo)) }}" alt="">
                    </a>
                @else
                    <img src="{{ asset(Storage::url($element->logo)) }}" alt="">
                @endif
            </div>
        @endforeach
    </div>
@endunless
