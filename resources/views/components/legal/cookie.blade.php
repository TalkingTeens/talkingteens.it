<div
    x-cloak
    x-data="{ state : 0 }"
    x-show="state"
    @open-manager.window="state = 2"
    class="fixed top-0 h-full w-full bg-black/60 backdrop-blur z-50 [&>*]:space-y-5 [&>*]:cursor-auto [&>*]:absolute [&>*]:w-full [&>*]:bottom-0 [&>*]:bg-white [&>*]:p-9 [&>*]:sm:max-w-lg [&>*]:sm:right-5 [&>*]:sm:bottom-5 [&>*]:lg:right-8 [&>*]:lg:bottom-8 [&>*]:sm:rounded-3xl"
>
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
                <x-heroicon-o-x-mark class="size-6"/>
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

{{--<script type="text/javascript">--}}
{{--    var _iub = _iub || [];--}}
{{--    _iub.csConfiguration = {--}}
{{--        "adPersonalization": false,--}}
{{--        "askConsentAtCookiePolicyUpdate": true,--}}
{{--        "lang": "it",--}}
{{--        "perPurposeConsent": true,--}}
{{--        "siteId": 3581830,--}}
{{--        "whitelabel": false,--}}
{{--        "cookiePolicyId": xxx,--}}
{{--        "banner": {--}}
{{--            "acceptButtonColor": "#65A30D",--}}
{{--            "acceptButtonDisplay": true,--}}
{{--            "backgroundColor": "#FFFFFF",--}}
{{--            "backgroundOverlay": true,--}}
{{--            "closeButtonDisplay": false,--}}
{{--            "customizeButtonDisplay": true,--}}
{{--            "explicitWithdrawal": true,--}}
{{--            "listPurposes": true,--}}
{{--            "logo": null,--}}
{{--            "linksColor": "#000000",--}}
{{--            "position": "bottom",--}}
{{--            "rejectButtonCaptionColor": "#000000",--}}
{{--            "rejectButtonColor": "#FFFFFF",--}}
{{--            "rejectButtonDisplay": true,--}}
{{--            "showPurposesToggles": true,--}}
{{--            "showTitle": false,--}}
{{--            "textColor": "#000000",--}}
{{--            "usesThirdParties": false,--}}
{{--            "rejectButtonCaption": "Rifiuta"--}}
{{--        }--}}
{{--    };--}}
{{--</script>--}}
{{--<script type="text/javascript" src="https://cs.iubenda.com/autoblocking/3581830.js"></script>--}}
{{--<script type="text/javascript" src="//cdn.iubenda.com/cs/iubenda_cs.js" charset="UTF-8" async></script>--}}
