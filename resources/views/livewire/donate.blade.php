@title('Donate')

<div class="min-h-screen flex items-start flex-col lg:flex-row">
    <div class="relative w-11/12 max-w-lg m-16 grid gap-10">
        <h1 class="font-bold text-6xl mt-10">
            Il tuo aiuto è importante!
        </h1>
        <p>
            Sostieni il progetto e allunga la vita delle nostre statue! Altrimenti puoi seguirci sui social, diffondere il progetto e parlarne con gli amici o con coloro che potrebbero essere interessati.
        </p>
        <p>
            Seleziona il metodo di pagamento:
        </p>
        <div class="flex gap-10">
            <x-button.rounded
                icon="{{ asset('svg/credit-card.svg') }}"
                action="setMethod('card')"
            />
            <x-button.rounded
                icon="{{ asset('svg/bank.svg') }}"
                action="setMethod('iban')"
            />
        </div>
        @if($method === 'card')
            <div>
                carta
            </div>
        @elseif($method === 'iban')
            <div>
                iban
            </div>
        @endif
    </div>
    <div class="sticky top-0">
        <img
            class="object-cover object-center w-full h-screen"
            src="{{ asset('images/sileno.webp') }}"
            alt=""
        >
    </div>
</div>
