@props(['person', 'size' => 'w-16', 'avatar' => true, 'reverse' => false])

@php
    $media_collection = match($person::class) {
        'App\Models\Author' => 'authors',
        'App\Models\Character' => 'characters',
    };
    $src = $person->getFirstMedia($media_collection)?->getFullUrl();
@endphp

<div {{ $attributes->class(['flex items-center gap-4', 'flex-row-reverse text-right' => $reverse]) }}>
    @if($avatar && $src)
        <x-ui.avatar :$src :alt="$person->full_name" :$size/>
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

