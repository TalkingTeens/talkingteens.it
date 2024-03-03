<footer class="bg-nd text-white py-12 sm:py-16">
    <div class="max-w-7xl w-11/12 mx-auto text-sm space-y-16">
        <div class="flex items-center gap-5 pb-12 sm:pb-16 border-b border-white/10">
            <a wire:navigate href="{{ route('home') }}" class="shrink-0 max-sm:hidden">
                @svg('logo/small', 'size-16')
            </a>
            {{--
                <a wire:navigate href="{{ route('echo') }}" class="group max-w-sm space-y-1.5">
                    <span class="font-medium">
                        {{ __('common.footer.echo') }}
                    </span>
                    <img src="{{ asset('images/echo.png') }}" alt="ECHO - Education Culture Human Oxygen Logo" class="group-hover:opacity-75 transition-opacity">
                </a>
            --}}
            <div class="max-w-sm space-y-1.5">
                <span class="font-medium">
                    {{ __('common.footer.echo') }}
                </span>
                <img src="{{ asset('images/echo.png') }}" alt="ECHO - Education Culture Human Oxygen Logo">
            </div>
        </div>
        <div class="flex flex-col gap-x-10 gap-y-16 justify-between lg:flex-row">
            <livewire:newsletter/>
            <div class="gap-10 grid grid-cols-2 sm:grid-cols-3 grow max-w-xl">
                <div>
                    <h4 class="text-base pb-1">
                        {{ config('app.name') }}
                    </h4>
                    <a wire:navigate href="{{ route('monuments.index') }}" class="link-footer">
                        {{ __('monuments.title') }}
                    </a>
                    {{--
                        <a wire:navigate href="{{ route('project') }}" class="link-footer">
                            Progetto
                        </a>
                    --}}
                    <a wire:navigate href="{{ route('docs') }}" class="link-footer">
                        {{ __('documents.title') }}
                    </a>
                </div>
                {{--
                    <div>
                        <h4 class="text-base pb-1">
                            Dietro il vetro
                        </h4>
                        <a wire:navigate href="#" class="link-footer">
                            Tutto
                        </a>
                    </div>
                 --}}
                <div>
                    <h4 class="text-base pb-1">
                        {{ __('common.footer.contributes.title') }}
                    </h4>
                    <a wire:navigate href="{{ route('donate') }}" class="link-footer">
                        {{ __('common.footer.contributes.donate') }}
                    </a>
                    <a wire:navigate href="{{ route('sponsors') }}" class="link-footer">
                        {{ __('sponsors.title') }}
                    </a>
                    <a wire:navigate href="{{ route('supporters') }}" class="link-footer">
                        {{ __('contributes.title') }}
                    </a>
                </div>
                <div>
                    <h4 class="text-base pb-1">
                        {{ __('common.footer.legal') }}
                    </h4>
                    <a wire:navigate href="{{ route('privacy') }}" class="link-footer">
                        {{ __('privacy.title') }}
                    </a>
                    <a wire:navigate href="{{ route('cookie') }}" class="link-footer">
                        {{ __('cookie.title') }}
                    </a>
                </div>
            </div>
        </div>
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-10">
            <div class="flex items-center gap-10">
                <a href="https://www.facebook.com/talkingteensparma/" target="_blank"
                   class="hover:text-[#4267b2] transition-colors">
                    <svg class="h-5 w-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path
                            d="M480 257.35c0-123.7-100.3-224-224-224s-224 100.3-224 224c0 111.8 81.9 204.47 189 221.29V322.12h-56.89v-64.77H221V208c0-56.13 33.45-87.16 84.61-87.16 24.51 0 50.15 4.38 50.15 4.38v55.13H327.5c-27.81 0-36.51 17.26-36.51 35v42h62.12l-9.92 64.77H291v156.54c107.1-16.81 189-109.48 189-221.31z"
                            fill-rule="evenodd"/>
                    </svg>
                </a>
                <a href="https://www.instagram.com/talkingteens_parma/" target="_blank"
                   class="hover:text-pink-500 transition-colors">
                    <svg class="h-5 w-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path
                            d="M349.33 69.33a93.62 93.62 0 0193.34 93.34v186.66a93.62 93.62 0 01-93.34 93.34H162.67a93.62 93.62 0 01-93.34-93.34V162.67a93.62 93.62 0 0193.34-93.34h186.66m0-37.33H162.67C90.8 32 32 90.8 32 162.67v186.66C32 421.2 90.8 480 162.67 480h186.66C421.2 480 480 421.2 480 349.33V162.67C480 90.8 421.2 32 349.33 32z"/>
                        <path
                            d="M377.33 162.67a28 28 0 1128-28 27.94 27.94 0 01-28 28zM256 181.33A74.67 74.67 0 11181.33 256 74.75 74.75 0 01256 181.33m0-37.33a112 112 0 10112 112 112 112 0 00-112-112z"/>
                    </svg>
                </a>
                <a href="https://youtube.com/@talkingteens" target="_blank"
                   class="hover:text-red-600 transition-colors">
                    <svg class="h-5 w-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path
                            d="M508.64 148.79c0-45-33.1-81.2-74-81.2C379.24 65 322.74 64 265 64h-18c-57.6 0-114.2 1-169.6 3.6C36.6 67.6 3.5 104 3.5 149 1 184.59-.06 220.19 0 255.79q-.15 53.4 3.4 106.9c0 45 33.1 81.5 73.9 81.5 58.2 2.7 117.9 3.9 178.6 3.8q91.2.3 178.6-3.8c40.9 0 74-36.5 74-81.5 2.4-35.7 3.5-71.3 3.4-107q.34-53.4-3.26-106.9zM207 353.89v-196.5l145 98.2z"/>
                    </svg>
                </a>
                <a href="mailto:team@talkingteens.it" class="transition-colors group">
                    <svg class="h-5 w-5 group-hover:hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <rect x="48" y="96" width="416" height="320" rx="40" ry="40" fill="none" stroke="currentColor"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/>
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="32" d="M112 160l144 112 144-112"/>
                    </svg>

                    <svg class="h-5 w-5 hidden group-hover:block" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 512 512">
                        <path
                            d="M441.6 171.61L266.87 85.37a24.57 24.57 0 00-21.74 0L70.4 171.61A40 40 0 0048 207.39V392c0 22.09 18.14 40 40.52 40h335c22.38 0 40.52-17.91 40.52-40V207.39a40 40 0 00-22.44-35.78z"
                            fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="32"/>
                        <path
                            d="M397.33 368L268.07 267.46a24 24 0 00-29.47 0L109.33 368M309.33 295l136-103M61.33 192l139 105"
                            fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="32"/>
                    </svg>
                </a>
            </div>
            <div class="flex items-center gap-4">
                <a href="https://apps.apple.com/it/app/talking-teens/id1459498571">
                    <img src="{{ asset('svg/download/' . LaravelLocalization::getCurrentLocale() . '/app-store.svg') }}"
                         alt="" class="h-9 sm:h-10">
                </a>
                <a href="https://play.google.com/store/apps/details?id=digital.diapason.echo.talkingteens">
                    <img
                        src="{{ asset('images/download/' . LaravelLocalization::getCurrentLocale() . '/google-play.png') }}"
                        alt="Disponibile su Google Play" class="h-9 sm:h-10">
                </a>
            </div>
        </div>
        <div
            class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-x-10 gap-y-5 font-extralight text-xs text-white/50">
            <p>
                &copy; {{ Arr::join([date('Y'), config('app.name') . '.', __('common.footer.copyright')], ' ') }}.
            </p>
            <div class="flex items-center gap-5">
                <a href="https://liutcanov.github.io/" target="_blank" class="hover:text-white transition-colors">
                    {{ __('common.footer.credits') }}
                </a>
            </div>
        </div>
    </div>
</footer>
