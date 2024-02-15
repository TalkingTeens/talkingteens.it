@title('Donate')

@extends('layouts.default')

@push('meta')
@endpush

@section('content')
    <div x-data="{ active : 2, method: 'bank', max : 2 }" x-init="$watch('active', value => max = active > max ? active : max)" class="md:flex lg:grid lg:grid-cols-4">
        <div class="hidden pb-3 pt-8 border-b md:sticky md:top-[--nav-height] md:h-[calc(100vh-var(--nav-height))] md:p-16 md:border-b-0 md:border-l md:flex md:flex-col md:justify-between md:gap-y-20 md:overflow-y-auto md:no-scrollbar">
            <ol class="relative w-11/12 max-w-sm mx-auto flex justify-between border-t md:max-w-none md:w-auto md:mx-0 md:h-1/2 md:flex-col md:border-l md:border-t-0">
                <x-donate.step :index="0" :title="__('donate.steps.intro.title')" :description="__('donate.steps.intro.description')" />
                <x-donate.step :index="1" :title="__('donate.steps.method.title')" :description="__('donate.steps.method.description')" />
                <x-donate.step :index="2" :title="__('donate.steps.checkout.title')" :description="__('donate.steps.checkout.description')" />
            </ol>
            <div class="hidden lg:block">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="h-6 w-6">
                    <circle cx="256" cy="256" r="208" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/>
                    <circle cx="256" cy="256" r="80" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/>
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M208 54l8 132M296 186l8-132M208 458l8-132M296 326l8 132M458 208l-132 8M326 296l132 8M54 208l132 8M186 296l-132 8"/>
                </svg>
                <p class="font-medium text-sm mt-2 mb-1">
                    Hai bisogno di aiuto?
                </p>
                <p class="text-xs">
                    Sentiti libero di contattarci in qualsiasi momento
                </p>
            </div>
        </div>
        <div class="bg-gray-50 flex flex-col md:grow md:-order-1 lg:col-span-3">
            <div x-cloak x-show="max > 1"
                 class="bg-white border-b flex items-center justify-between py-4 px-[calc(100vw/24)] xl:pl-[calc((100vw-80rem)/2)]">
                <button
                    type="button"
                    x-show="active !== 0"
                    @click="active -= 1"
                >
                    {{ __('donate.previous') }}
                </button>
                <button
                    type="button"
                    x-show="active !== 2 && max > active"
                    @click="active += 1" class="ml-auto"
                >
                    {{ __('donate.next') }}
                </button>
            </div>
            <div x-show="active === 0"
                 class="p-4 overflow-hidden h-full"
                 x-transition>
                <div class="columns-4 gap-4 space-y-4">
{{--                    @foreach()--}}
{{--                        <img src="{{ asset('images/') }}" alt="">--}}
{{--                    @endforeach--}}
                    <img class="w-full aspect-video" src="https://picsum.photos/500/300?random=1" />
                    <img class="w-full aspect-square" src="https://picsum.photos/500/300?random=2" />
                    <img class="w-full aspect-square" src="https://picsum.photos/500/300?random=3" />
                    <img class="w-full aspect-square" src="https://picsum.photos/500/300?random=4" />
                    <img class="w-full aspect-video" src="https://picsum.photos/500/300?random=5" />
                </div>
            </div>
            <div x-cloak x-show="active === 1"
                 class="donate-window"
                 x-transition
            >
                <div class="space-y-4">
                    <p class="title-xl">
                        Come preferisci procedere?
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur, velit.
                    </p>
                    <div class="max-w-lg space-y-2 py-4">
                        <x-button.payment method="card" label="Credit Card" />
                        <x-button.payment method="bank" label="Bank transfer" />
                    </div>
                </div>
            </div>
            <div x-cloak x-show="active === 2 && method === 'bank'"
                 class="donate-window bg-white space-y-4"
                 x-transition>
                <p class="title-xl">
                    Bank transfer
                </p>
                <p>
                    Di seguito trovi tutte le informazioni necessarie per effettuare un bonifico bancario:
                </p>
                <div class="max-w-3xl divide-y pt-4">
                    <x-donate.bank-detail title="IBAN" value="IT36P0306909606100000150735" />
                    <x-donate.bank-detail title="Causale" value="erogazione liberale" note="specificando il nome e cognome del donatore se diverso da chi effettua il versamento" />
                    <x-donate.bank-detail :title="__('donate.next')" :value="__('donate.next')" />
                </div>
            </div>
            <div x-cloak x-show="active === 2 && method === 'card'"
                 class="donate-window"
                 x-transition>
                card
            </div>
        </div>
    </div>
@endsection
