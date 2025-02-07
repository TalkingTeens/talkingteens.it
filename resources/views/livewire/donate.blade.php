<div x-data="{ method : '{{ $method }}' }">
    <x-ui.hero
        :title="__('donate.title')"
        :subtitle="__('donate.subtitle')"
        src="/images/sponsor.jpg"
    >
        <div class="flex items-end justify-center gap-1 sm:gap-2 w-11/12 mx-auto">
            @env('local')
                <x-donate.tab method="card"/>
            @endenv

            <x-donate.tab method="bank"/>
        </div>
    </x-ui.hero>

    <div class="section">
        <div x-show="method === 'card'">
            card
        </div>

        <div
            x-cloak
            x-show="method === 'bank'"
            class="space-y-6"
        >
            <p>
                Di seguito le informazioni necessarie per effettuare un bonifico bancario:
            </p>

            <dl class="divide-y">
                <x-donate.bank-detail title="Intestatario"
                                      value="Associazione Culturale ECHO - Education Culture Human Oxygen"/>

                <x-donate.bank-detail title="Banca" value="Banca Intesa Sanpaolo, Milano, Italia"/>

                <x-donate.bank-detail title="IBAN" value="IT36P0306909606100000150735"/>

                <x-donate.bank-detail title="Causale"
                                      value='"erogazione liberale", specificando nome e cognome del donatore'/>
            </dl>
        </div>
    </div>

    @if(is_array($faqs))
        <div class="bg-gray-50">
            <section class="section gap-16 grid lg:grid-cols-2">
                <div class="space-y-6">
                    <h2 class="title-xl">
                        {{ __('donate.faq.title') }}
                    </h2>

                    <p>
                        {{ __('donate.faq.support') }}
                    </p>
                </div>

                <x-ui.accordion :items="$faqs"/>
            </section>
        </div>
    @endif
</div>
