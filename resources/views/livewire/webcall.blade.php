@push('meta')
    <link rel="preload" as="image" href="{{ $webcall->getFirstMedia('webcalls')->getFullUrl() }}">
@endpush

<main class="bg-st h-svh">
    <div
        x-data="webcall"
        class="bg-cover bg-center bg-no-repeat mx-auto max-w-md h-full"
        x-bind:style="[1, 2].includes(state) && 'background-image: url(\'{{ $webcall->getFirstMedia('webcalls')->getFullUrl() }}\' '"
    >
        <template x-if="[0, 3].includes(state)">
            <section class="flex-col py-11 w-11/12 mx-auto items-center h-full gap-8 flex">
                <div class="flex-1 flex items-center w-3/5">
                    <a href="{{ route('home') }}" class="w-full"
                       :class="isEmbedded && 'pointer-events-none'">
                        @svg('logo/big', 'w-full')
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
                        <x-button.webcall.link :href="route('app')" icon="app">
                            {{ __('webcall.app') }}
                        </x-button.webcall.link>

                        <x-button.webcall.link :href="route('monuments.show', ['monument' => $monument])"
                                               icon="heroicon-o-identification">
                            {{ $monument->name }}
                        </x-button.webcall.link>

                        <x-button.webcall.link :href="route('monuments.index', ['v' =>'map'])"
                                               icon="heroicon-o-map-pin">
                            {{ __('webcall.map') }}
                        </x-button.webcall.link>

                        <x-button.webcall.action action="replay" icon="heroicon-o-backward">
                            {{ __('webcall.restart') }}
                        </x-button.webcall.action>
                    </div>
                </template>

                <a href="{{ config('constants.credits.url') }}?utm_source=call.talkingteens.it&utm_medium=footer&utm_campaign=credits"
                   target="_blank"
                   class="text-xs"
                   :class="isEmbedded && 'hidden'">
                    {{ __('common.footer.credits', ['name' => config('constants.credits.name')]) }}
                </a>
            </section>
        </template>

        <template x-if="[1, 2].includes(state)">
            <section
                class="py-12 h-full mx-auto flex-col justify-between gap-8 flex bg-gradient-to-b from-nd/60 to-transparent">
                <div class="text-center text-white">
                    <h1 class="font-bold text-4xl">
                        {{ $monument->name }}
                    </h1>

                    <div class="opacity-70 font-semibold mt-2 text-lg">
                        <template x-if="state === 1">
                            <p class="animate-pulse">
                                {{ __('webcall.incoming') }}
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
                        icon="hang-up"
                        bg="bg-red-500"
                    />

                    <template x-if="state === 1">
                        <x-button.rounded
                            @click="answer"
                            icon="phone"
                            bg="bg-green-500"
                            :ping="true"
                        />
                    </template>
                </div>
            </section>
        </template>
    </div>
</main>

@script
<script>
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

        init() {
            const query = new URLSearchParams(location.search).get('l');
            const langs = @js($langs);

            if (query in langs) this.call(langs[query]);
        },

        call(resource) {
            let url;

            try {
                url = new URL(resource);
            } catch (e) {
                url = new URL(`storage/${resource}`, "{{ config('app.url') }}");
            }

            if (url.host !== "{{ config('app.domain') }}") {
                window.open(resource).focus(); // catch if blocked
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
            $wire.started();
        },

        completed() {
            $wire.completed();
            this.end();
        },

        close() {
            $wire.closed();
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
</script>
@endscript
