@push('meta')
    <link rel="preload" as="image" href="{{ asset(Storage::url($monument->background_image)) }}">
@endpush

<main class="bg-st h-svh">
    <div
        x-data="webcall"
        class="bg-cover bg-center bg-no-repeat mx-auto max-w-md h-full"
        x-bind:style="[1, 2].includes(state) && 'background-image: url(\'{{ asset(Storage::url($monument->background_image)) }}\' '"
    >
        <template x-if="[0, 3].includes(state)">
            <section class="flex-col py-11 w-11/12 mx-auto items-center h-full gap-8 flex">
                <div class="flex-1 flex items-center w-3/5">
                    <a wire:navigate href="{{ route('home') }}" class="w-full">
                        <img src="{{ asset("svg/logo/big.svg") }}" alt="{{ config('app.name') }} logo" class="w-full">
                    </a>
                </div>
                <template x-if="state === 0">
                    <div class="grid gap-2 w-full">
                        @foreach($langs as $language => $resource)
                            <x-button.webcall.action action="call('{{ $resource }}')" :$language>
                                {{ __("webcall.translations.$language") }}
                            </x-button.webcall.action>
                        @endforeach
                    </div>
                </template>
                <template x-if="state === 3">
                    <div class="grid gap-2 w-full"
                         :class="isEmbedded && '[&>a]:hidden'">
                        <x-button.webcall.link :href="route('app')" src="svg/app.svg" alt="">
                            Scarica l'app
                        </x-button.webcall.link>

                        <x-button.webcall.link :href="route('monuments.show', ['monument' => $monument])"
                                               src="svg/info.svg"
                                               alt="">
                            {{ $monument->name }}
                        </x-button.webcall.link>

                        <x-button.webcall.link :href="route('monuments.index', ['v' =>'map'])" src="svg/pin.svg"
                                               alt="">
                            Mappa delle Statue
                        </x-button.webcall.link>

                        <x-button.webcall.action action="replay" src="svg/replay.svg" alt="">
                            Riascolta
                        </x-button.webcall.action>
                    </div>
                </template>
            </section>
        </template>

        <template x-if="[1, 2].includes(state)">
            <section class="py-12 h-full mx-auto flex-col justify-between gap-8 flex bg-gradient-to-b from-nd/60 to-transparent">
                <div class="text-center text-white">
                    <h1 class="font-bold text-4xl">
                        {{ $monument->name }}
                    </h1>
                    <div class="opacity-70 font-semibold mt-2 text-lg">
                        <template x-if="state === 1">
                            <p class="animate-pulse">
                                Chiamata in arrivo
                            </p>
                        </template>
                        <template x-if="state === 2">
                            <p x-text="currentTime">
                                00:00
                            </p>
                        </template>
                    </div>
                </div>

                <div class="flex items-center w-5/6 mx-auto"
                     :class='{ "justify-between": state === 1, "justify-center": state === 2 }'>
                    <x-button.rounded
                        @click="close"
                        icon="svg/hang-up.svg"
                        bg="bg-red-500"
                    />

                    <template x-if="state === 1">
                        <x-button.rounded
                            @click="answer"
                            icon="svg/call.svg"
                            bg="bg-green-500"
                            :ping="true"
                        />
                    </template>
                </div>
            </section>
        </template>
    </div>
</main>

@pushonce('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('webcall', () => ({
                state: 0,

                ringtone: new Audio("/audio/ringtone.mp3"),

                currentTime: "00:00",

                get isEmbedded() {
                    try {
                        return window.self !== window.top;
                    } catch (e) {
                        return true;
                    }
                },

                call(resource) {
                    let url;

                    try {
                        url = new URL(resource);
                    } catch (e) {
                        url = new URL(`storage/${resource}`, "{{ config('app.url') }}");
                    }

                    if (url.host !== window.location.host) {
                        window.open(resource).focus();
                        this.started();
                        this.end();
                        return;
                    }

                    this.audio = new Audio(url);

                    this.ringtone.play();
                    this.ringtone.loop = true;
                    // this.toggleVibration();

                    this.state = 1;
                },

                // toggleVibration()
                // {
                //     if (Boolean(window.navigator.vibrate))
                //     {
                //         window.navigator.vibrate(1000);
                //         this.vibrationInterval = setInterval(() => window.navigator.vibrate(1000), 2000);
                //     }
                // },

                answer() {
                    this.ringtone.pause();

                    // this.toggleVibration();
                    // if (Boolean(window.navigator.vibrate))
                    //     clearInterval(this.vibrationInterval);

                    this.currentTime = "00:00";
                    this.audio.play();

                    this.audio.addEventListener("ended", () => this.completed());

                    this.audio.addEventListener('timeupdate', () => {
                        const time = this.audio.currentTime;
                        const minutes = Math.floor(time / 60).toString().padStart(2, '0');
                        const seconds = Math.floor(time % 60).toString().padStart(2, '0');
                        this.currentTime = `${minutes}:${seconds}`;
                    });

                    this.state = 2;
                    this.started();
                },

                started() {
                    this.$wire.started();
                },

                completed() {
                    this.$wire.completed();
                    this.end();
                },

                close() {
                    this.$wire.closed();
                    this.end();
                },

                end() {
                    // clearInterval(this.vibrationInterval);

                    this.ringtone.pause();
                    this.ringtone.currentTime = 0;

                    this.audio?.pause();
                    this.state = 3;
                },

                replay() {
                    this.state = 0;
                }
            }))
        })
    </script>
@endpushonce
