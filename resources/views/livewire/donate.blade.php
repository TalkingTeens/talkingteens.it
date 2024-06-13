<div x-data="{ method : 'bank' }">
    <div class="relative">
        <div class="max-w-3xl mx-auto text-white text-center space-y-4 py-36">
            <h1 class="badge">
                {{ __('donate.title') }}
            </h1>

            <h2 class="title-xl">
                {{ __('donate.subtitle') }}
            </h2>
        </div>

        <div class="flex items-end justify-center gap-1 sm:gap-2 w-11/12 mx-auto">
            <x-donate.tab method="card"/>

            <x-donate.tab method="bank"/>
        </div>

        <img src="{{ asset('/images/sponsor.jpg') }}" class="absolute -z-10 inset-0 h-full w-full object-cover"
             alt="">
    </div>

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
                <x-donate.bank-detail title="IBAN" value="IT36P0306909606100000150735"/>

                <x-donate.bank-detail title="Causale" value="erogazione liberale"/>

                <x-donate.bank-detail :title="__('donate.next')" :value="__('donate.next')"/>
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

                <dl x-data="{ open : 0 }" class="space-y-5 [&>*:not(:first-child)]:pt-5 divide-y">
                    @foreach($faqs as $faq)
                        <div x-id="['faq']">
                            <dt>
                                <button
                                    type="button"
                                    @click="open = (open !== {{ $loop->iteration }} ? {{ $loop->iteration }} : null)"
                                    :aria-expanded="open === {{ $loop->iteration }}"
                                    :aria-controls="$id('faq')"
                                    class="w-full flex justify-between items-center"
                                >
                                    <span>{{ $faq['question'] }}</span>

                                    <x-heroicon-o-chevron-down
                                        class="size-5 transition-transform duration-500 ease-in-out"
                                        ::class="open === {{ $loop->iteration }} ? 'rotate-180' : ''"/>
                                </button>
                            </dt>

                            <dd x-show="open === {{ $loop->iteration }}" x-cloak x-collapse>
                                <p :id="$id('faq')" class="overflow-hidden">{{ $faq['answer'] }}</p>
                            </dd>
                        </div>
                    @endforeach
                </dl>
            </section>
        </div>
    @endif
</div>
