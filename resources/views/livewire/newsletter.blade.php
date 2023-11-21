<div class="max-w-md" @subscribed="console.log('ca')">
    <h3 class="font-extrabold text-3xl">
        Tieniti aggiornato!
    </h3>
    <p class="text-white/50 font-light mt-4 mb-8">
        Iscriviti alla newsletter per restare informato sui nostri progetti e prossimi sviluppi!
    </p>
    <form wire:submit="save">
        <label for="email" class="sr-only">Email address</label>
        <input wire:model="email" id="email" type="email" autocomplete="email" required class="min-w-0 flex-auto rounded-md border-0 bg-white/5 px-3.5 py-2 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-st sm:text-sm sm:leading-6" placeholder="Enter your email">
        <x-form.error name="email" />
    </form>
</div>
