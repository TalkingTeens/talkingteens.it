@props(['person', 'size' => 'h-16 w-16'])

<div {{ $attributes->class(['flex items-center gap-4']) }}>
    @isset($person->picture)
        <img src="{{ asset(Storage::url($person->picture)) }}" alt="" @class([
            'shrink-0 object-cover rounded-full', $size
        ])>
    @endisset
    <div>
        {{ $slot }}
        @unless(!isset($person->death_year) && !isset($person->birth_year))
            <p class="text-sm opacity-60 italic">
                @if(isset($person->death_year) && isset($person->birth_year))
                    {{ $person->birth_year . ' - ' . $person->death_year }}
                @elseif(isset($person->birth_year))
                    Nascita: {{ $person->birth_year }}
                @else
                    Morte: {{ $person->death_year }}
                @endif
            </p>
        @endunless
    </div>
</div>

