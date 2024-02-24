<div class="max-w-md" @subscribed="console.log('subscribed successfully')">
    <h3 class="font-extrabold text-3xl">
        Tieniti aggiornato!
    </h3>
    <p class="text-white/50 font-light mt-4 mb-8">
        Iscriviti alla newsletter per restare informato sui nostri progetti e prossimi sviluppi!
    </p>
    @if($subscribed)
        <p>
            Grazie {{ $email }}!
            Iscrizione avvenuta con successo.
        </p>
    @else
        <form wire:submit="save">
            <label for="email" class="sr-only">Email address</label>
            <div
                class="flex items-center rounded-l-xl rounded-r-2xl bg-white/5 p-1 border border-white/10 shadow-sm w-full sm:w-3/4">
                <input wire:model="email" id="email" type="email" autocomplete="email" required
                       class="border-0 bg-transparent mx-2 w-full"
                       placeholder="Enter your email">
                <x-button type="submit" class="primary">
                    Subscribe
                </x-button>
            </div>
            <x-form.error name="email"/>
        </form>
    @endif
</div>
