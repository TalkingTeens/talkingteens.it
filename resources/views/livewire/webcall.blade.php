@push('meta')
    <link rel="preload" as="image" href="{{ asset($statue->webcall->photo) }}">
@endpush

<div
    class="bg-cover bg-center bg-no-repeat mx-auto max-w-md h-screen py-11"
    @style([
        "background-image: url('".asset($statue->webcall->photo)."')" => in_array($state, [1, 2])
    ])
>
    @if (in_array($state, [0, 3]))
        <section class="flex-col w-5/6 mx-auto items-center h-full gap-8 flex">
            <div class="flex-1 flex items-center w-3/5">
                <a href="#" class="w-full">
                    <img src="{{ asset("svg/logo.svg") }}" alt="" class="w-full">
                </a>
            </div>
            <div class="grid gap-2 w-full">
                @if ($state == 0)


                    @foreach ($supportedLangs->keys() as $language)
                        <x-button.menu
                            :icon="$language"
                            action="setLang('{{ $language }}')"
                            :$language
                        >
                            @lang("webcall.translations.". $language)
                        </x-button.menu>
                    @endforeach


                @else
                    <x-button.menu icon="app" action="like">
                        @lang("webcall.app")
                    </x-button.menu>

                    <x-button.menu icon="info" action="like">
                        Nome statua
                    </x-button.menu>

                    <x-button.menu icon="pin" action="like">
                        @lang("webcall.map")
                    </x-button.menu>

                    <x-button.menu icon="replay" action="replay">
                        @lang("webcall.replay")
                    </x-button.menu>
                @endif
            </div>
        </section>
    @endif

    @if (in_array($state, [1, 2]))
        <section class="p-8 h-full w-5/6 mx-auto flex-col justify-between gap-8 flex">
            <div class="text-center text-white">
                <h1 class="font-bold text-4xl">
                    {{ 'Nome statua' }}
                </h1>
                <div class="opacity-70 font-semibold mt-2 text-lg">
                    @if ($state == 1)
                        <p class="animate-pulse">
                            @lang('webcall.incoming')
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
                <x-button.call
                    icon="close"
                    action="hangUp"
                    bg="bg-red-500"
                />

                @if ($state == 1)
                    <x-button.call
                        icon="call"
                        action="answer"
                    />
                @endif
            </div>
        </section>

        @if ($state == 1)
            <audio autoplay loop preload="auto" src="{{ asset('audio/ringtone.mp3') }}">
            </audio>
        @else
            <audio autoplay loop preload="auto" src="{{ asset($supportedLangs[$lang]) }}">
                <!--fallback-->
            </audio>
        @endif

    @endif
</div>
