<footer class="bg-nd text-white py-12 sm:py-16">
    <div class="max-w-7xl w-11/12 mx-auto text-sm space-y-16">
        <div class="flex items-center gap-5 pb-12 sm:pb-16 border-b border-white/10">
            <a href="{{ route('home') }}" class="shrink-0 max-sm:hidden">
                @svg('logo/small', 'size-16')
            </a>

            <a href="{{ route('about') }}" class="group max-w-sm space-y-1.5">
                <span class="font-medium">
                    {{ __('common.footer.echo') }}
                </span>

                <img src="{{ asset('images/echo.png') }}" alt="ECHO - Education Culture Human Oxygen Logo"
                     class="group-hover:opacity-75 transition-opacity">
            </a>
        </div>

        <div class="flex gap-x-10 gap-y-16 justify-between max-xl:flex-col">
            <livewire:newsletter/>

            <div class="gap-10 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 grow lg:max-w-2xl">
                <div>
                    <h4 class="text-base pb-1">
                        {{ config('app.name') }}
                    </h4>

                    <a href="{{ route('monuments.index') }}" class="link-footer">
                        {{ __('monuments.title') }}
                    </a>

                    <a href="{{ route('project') }}" class="link-footer">
                        {{ __('project.title') }}
                    </a>

                    <a href="{{ route('about') }}" class="link-footer">
                        {{ __('about.title') }}
                    </a>
                </div>

                <div>
                    <h4 class="text-base pb-1">
                        {{ __('common.footer.education.title') }}
                    </h4>

                    <a href="{{ route('docs') }}" class="link-footer">
                        {{ __('documents.title') }}
                    </a>
                </div>

                <div>
                    <h4 class="text-base pb-1">
                        {{ __('common.footer.contributes.title') }}
                    </h4>

                    <a href="{{ route('donate') }}" class="link-footer">
                        {{ __('donate.title') }}
                    </a>
                </div>

                <div>
                    <h4 class="text-base pb-1">
                        {{ __('common.footer.legal.title') }}
                    </h4>

                    <a href="{{ route('privacy') }}" class="link-footer">
                        {{ __('legal.privacy') }}
                    </a>

                    <a href="{{ route('cookie') }}" class="link-footer">
                        {{ __('legal.cookie') }}
                    </a>

                    <a href="{{ route('terms') }}" class="link-footer">
                        {{ __('legal.terms') }}
                    </a>

                    <a href="#" class="link-footer iubenda-cs-preferences-link">
                        {{ __('common.footer.legal.manage') }}
                    </a>
                </div>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-10">
            <div class="flex items-center gap-10">
                <a href="https://www.facebook.com/talkingteensparma/" target="_blank">
                    @svg('facebook', 'size-5 hover:text-[#0866ff] transition-colors')
                </a>

                <a href="https://www.instagram.com/talkingteens_parma/" target="_blank">
                    @svg('instagram', 'size-5 hover:text-[#ff0069] transition-colors')
                </a>

                <a href="https://youtube.com/@talkingteens" target="_blank">
                    @svg('youtube', 'size-5 hover:text-[red] transition-colors')
                </a>

                <a href="mailto:team@talkingteens.it" class="transition-colors group">
                    <x-heroicon-o-envelope class="size-5 group-hover:hidden"/>

                    <x-heroicon-o-envelope-open class="size-5 hidden group-hover:block"/>
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
                &copy; 2018 - {{ Arr::join([date('Y'), config('app.name') . '.', __('common.footer.copyright')], ' ') }}
                .
            </p>

            <div class="flex items-center gap-5">
                <a href="{{ config('constants.credits.url') }}?utm_source=talkingteens.it&utm_medium=footer&utm_campaign=credits"
                   target="_blank"
                   class="hover:text-white transition-colors">
                    {{ __('common.footer.credits', ['name' => config('constants.credits.name')]) }}
                </a>
            </div>
        </div>
    </div>
</footer>
