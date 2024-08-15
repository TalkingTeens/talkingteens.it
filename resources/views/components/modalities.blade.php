<div class="bg-gray-50">
    <section class="section space-y-16">
        <div class="space-y-4">
            <h2 class="badge">
                {{ __('project.modalities.title') }}
            </h2>

            <h3 class="title-xl max-w-xl">
                {{ __('project.modalities.subtitle') }}
            </h3>
        </div>

        <div class="items-start gap-12 max-md:gap-x-6 grid grid-cols-[auto_1fr] sm:grid-cols-[auto_1fr_2fr]">
            <div class="p-4 inline-block bg-white rounded-full">
                @svg('heroicon-o-phone-arrow-up-right', 'size-8')
            </div>

            <div class="grid grid-cols-subgrid sm:col-span-2">
                <h4 class="title-lg">
                    {{ __('project.modalities.call.title') }}
                </h4>

                <p>
                    {{ __('project.modalities.call.text') }}
                </p>
            </div>

            <div class="p-4 inline-block bg-white rounded-full">
                @svg('heroicon-o-qr-code', 'size-8')
            </div>

            <div class="grid grid-cols-subgrid sm:col-span-2">
                <h4 class="title-lg">
                    {{ __('project.modalities.qr.title') }}
                </h4>

                <p>
                    {{ __('project.modalities.qr.text') }}
                </p>
            </div>

            <div class="p-4 block bg-white rounded-full">
                @svg('app', 'size-8')
            </div>

            <div class="grid grid-cols-subgrid sm:col-span-2">
                <h4 class="title-lg">
                    {{ __('project.modalities.app.title') }}
                </h4>

                <p>
                    {{ __('project.modalities.app.text') }}
                </p>
            </div>
        </div>

        {{--<hr>--}}

        {{--<p class="text-xs !mt-10"></p>--}}
    </section>
</div>
