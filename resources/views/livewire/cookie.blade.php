<div
    x-cloak
    x-data="{ state : @entangle('state').live }"
    x-show="state"
    @open-manager.window="state = 2"
    class="fixed top-0 h-full w-full bg-black/60 backdrop-blur z-50 [&>*]:space-y-5 [&>*]:cursor-auto [&>*]:absolute [&>*]:w-full [&>*]:bottom-0 [&>*]:bg-white [&>*]:p-9 [&>*]:sm:max-w-lg [&>*]:sm:right-5 [&>*]:sm:bottom-5 [&>*]:lg:right-8 [&>*]:lg:bottom-8 [&>*]:sm:rounded-3xl"
>
    @if($state == 1)
        <div x-show="state == 1">
            <h3 class="text-lg font-semibold">
                {{ __('cookie.banner.title') }}
            </h3>

            <p class="text-sm">
                {{ __('cookie.banner.description') }}
                <a wire:navigate href="{{ route('cookie') }}" class="underline">
                    {{ __('cookie.title') }}
                </a>
            </p>

            <div class="grid grid-cols-2 gap-2">
                <x-button wire:click="accept" class="primary w-full">
                    {{ __('cookie.banner.accept') }}
                </x-button>

                <x-button wire:click="reject" class="secondary w-full">
                    {{ __('cookie.banner.reject') }}
                </x-button>

                <button type="button" @click="state = 2" class="col-span-2 pt-1">
                    {{ __('cookie.settings.title') }}
                </button>
            </div>
        </div>
    @endif

    <form x-show="state == 2"
          @click.outside="state = 0"
          x-transition.origin.bottom
          wire:submit="save"
    >
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-semibold">
                {{ __('cookie.settings.title') }}
            </h3>

            <div @click="state = 0" class="p-1 rounded-full hover:bg-gray-100 cursor-pointer">
                <x-heroicon-o-x-mark class="size-6" />
            </div>
        </div>

        <div class="space-y-4 max-h-80 overflow-y-auto">
            <div class="grid grid-cols-4 items-start">
                <input type="checkbox" class="checkbox h-10 w-10 mx-auto mt-2" checked disabled>

                <label class="col-span-3">
                    <h4 class="font-medium mb-1">
                        Fondamentali
                    </h4>

                    <p class="text-sm">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi cupiditate deserunt dolore
                        ducimus facere facilis iure nam nisi porro praesentium!
                    </p>
                </label>
            </div>

            <div x-id="['checkbox']" class="grid grid-cols-4 items-start">
                <input type="checkbox" wire:model="analytics" :id="$id('checkbox')"
                       class="checkbox h-10 w-10 mx-auto mt-2">

                <label :for="$id('checkbox')" class="col-span-3">
                    <h4 class="font-medium mb-1">
                        Analitici
                    </h4>

                    <p class="text-sm">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi cupiditate deserunt dolore
                        ducimus facere facilis iure nam nisi porro praesentium!
                    </p>
                </label>
            </div>
        </div>

        <x-button.submit class="w-full">
            Conferma
        </x-button.submit>
    </form>
</div>

@if($analytics)
    @pushonce('scripts')
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }

            gtag('js', new Date());
            gtag('config', 'G-3GJ7WZTD6J');
        </script>
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-3GJ7WZTD6J"></script>
    @endpushonce
@endif
