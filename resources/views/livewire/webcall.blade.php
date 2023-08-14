@push('meta')
    <link rel="preload" as="image" href="{{ asset(Storage::url($monument->background_image)) }}">
@endpush

<main class="bg-st h-screen">
    <div
        class="bg-cover bg-center bg-no-repeat mx-auto max-w-md h-full py-11"
        @style([
            "background-image: url('".asset(Storage::url($monument->background_image))."')" => in_array($state, [1, 2])
        ])
    >
        @if (in_array($state, [0, 3]))
            <section class="flex-col w-5/6 mx-auto items-center h-full gap-8 flex">
                <div class="flex-1 flex items-center w-3/5">
                    <a href="{{ route('home') }}" class="w-full">
                        <img src="{{ asset("svg/logo/big.svg") }}" alt="{{ config('app.name') }} logo" class="w-full">
                    </a>
                </div>
                <div class="grid gap-2 w-full [&>a]:hidden">
                    @if ($state == 0)
                        @foreach ($langs->keys() as $language)
                            <x-button.webcall.action action="setLang('{{ $language }}')" :$language>
                                @lang("webcall.translations.". $language)
                            </x-button.webcall.action>
                        @endforeach
                    @else
                        <x-button.webcall.link :href="route('app')" src="svg/app.svg" alt="">
                            Scarica l'app
                        </x-button.webcall.link>

                        <x-button.webcall.link :href="route('monuments.show', ['monument' => $monument])" src="svg/info.svg" alt="">
                            {{ $monument->name }}
                        </x-button.webcall.link>

                        <x-button.webcall.link :href="route('monuments.index', ['v' =>'map'])" src="svg/pin.svg" alt="">
                            Mappa delle Statue
                        </x-button.webcall.link>

                        <x-button.webcall.action action="replay" src="svg/replay.svg" alt="">
                            Riascolta
                        </x-button.webcall.action>
                    @endif
                </div>
            </section>
        @endif

        @if (in_array($state, [1, 2]))
            <section class="p-8 h-full w-5/6 mx-auto flex-col justify-between gap-8 flex">
                <div class="text-center text-white">
                    <h1 class="font-bold text-4xl">
                        {{ $monument->name }}
                    </h1>
                    <div class="opacity-70 font-semibold mt-2 text-lg">
                        @if ($state == 1)
                            <p class="animate-pulse">
                                Chiamata in arrivo
                            </p>
                        @else
                            <p>00:00</p>
                        @endif
                    </div>
                </div>

                <div @class([
                    "flex items-center",
                    "justify-between" => $state == 1,
                    "justify-center" => $state == 2
                ])>
                    <x-button.rounded
                        icon="svg/hang-up.svg"
                        action="hangUp"
                        bg="bg-red-500"
                    />

                    @if ($state == 1)
                        <x-button.rounded
                            icon="svg/call.svg"
                            action="answer"
                            bg="bg-green-500"
                        />
                    @endif
                </div>
            </section>

            @if ($state == 1)
                <audio autoplay loop preload="auto" src="{{ asset('audio/ringtone.mp3') }}">
                </audio>
            @else
                <audio autoplay loop preload="auto" src="{{ asset(Storage::url($langs[$activeLang])) }}">
                    <!--fallback-->
                </audio>
            @endif

        @endif
    </div>
</main>
