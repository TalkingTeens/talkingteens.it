@props(['person', 'size' => 'w-16', 'avatar' => true])

<div {{ $attributes->class(['flex items-center gap-4']) }}>
    @if(isset($person->picture) && $avatar)
        <x-avatar :src="$person->picture" :alt="$person->full_name" :$size />
    @endif
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

