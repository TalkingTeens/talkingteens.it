<div class="max-w-md" @subscribed="console.log('subscribed successfully')">
    <h3 class="font-extrabold text-3xl">
        {{ __('common.footer.newsletter.title') }}
    </h3>
    <p class="text-white/50 font-light mt-4 mb-8">
        {{ __('common.footer.newsletter.text') }}
    </p>
    @if($subscribed)
        <div class="flex items-center gap-x-4">
            <div class="bg-st text-nd size-12 flex items-center justify-center rounded-full">
                @svg('shield', 'size-7/12')
            </div>
            <p class="text-st">
                {{ __('common.footer.newsletter.confirmation', ['email' => $email]) }}
            </p>
        </div>
    @else
        <form wire:submit="save">
            <label for="email" class="sr-only">Email address</label>
            <div
                class="flex gap-x-1 items-center rounded-l-xl rounded-r-2xl bg-white/5 p-1 border border-white/10 shadow-sm w-full sm:w-3/4">
                <input wire:model="email" id="email" type="email" autocomplete="email" required
                       class="bg-transparent px-2 py-1.5 w-full rounded-lg"
                       placeholder="{{ __('common.footer.newsletter.input') }}">
                <x-button.submit type="submit" class="primary">
                    {{ __('common.footer.newsletter.subscribe') }}
                </x-button.submit>
            </div>
            <x-form.error name="email"/>
        </form>
    @endif
</div>
