@title('Donate')

@extends('layouts.default')

@push('meta')
@endpush

@section('content')
    <div x-data="{ active : 1, method: '' }" class="md:flex lg:grid lg:grid-cols-4">
        <div class="pb-3 pt-8 border-b md:sticky md:top-[--nav-height] md:h-[calc(100vh-var(--nav-height))] md:p-16 md:border-b-0 md:border-l md:flex md:flex-col md:justify-between md:gap-y-20 md:overflow-y-auto md:no-scrollbar">
            <ol class="relative w-11/12 max-w-sm mx-auto flex justify-between border-t md:max-w-none md:w-auto md:mx-0 md:h-1/2 md:flex-col md:border-l md:border-t-0">
                {{-- to fix if not available in language --}}
                @foreach(Lang::get('donate.steps') as $step)
                    <li
                        @click="active = {{ $loop->index }}"
                        class="group mr-10 last:mb-0 mt-6 md:mr-0 md:mb-10 md:mt-0 md:ml-6"
                        :class="active < {{ $loop->index }} ? 'pointer-events-none [&>span]:text-gray-300' : 'cursor-pointer [&>span]:border-black [&>span]:text-black [&>span]:dark:border-st [&>span]:dark:text-st'"
                    >
                        <span class="absolute flex items-center justify-center w-8 h-8 bg-white border rounded-full -top-4 group-hover:bg-gray-100 ring-4 ring-white dark:border-2 md:top-auto md:-left-4">
                            {{ $loop->iteration }}
                        </span>
                        <div class="hidden lg:block" :class="active < {{ $loop->index }} && 'opacity-50'">
                            <h2 class="font-medium">
                                {{ $step['title'] }}
                            </h2>
                            @if($step['description'])
                                <p class="text-sm opacity-60 mt-1">
                                    {{ $step['description'] }}
                                </p>
                            @endif
                        </div>
                    </li>
                @endforeach
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
        <div class="bg-gray-50 md:grow md:-order-1 lg:col-span-3">
            <div x-cloak x-show="active !== 0" class="hidden md:block bg-white border-b">
                <p @click="active -= 1">
                    {{ __('common.back') }}
                </p>
            </div>
            <div x-show="active === 0" class="p-4 overflow-hidden h-[calc(100vh-var(--nav-height))]" x-transition>
                <div class="columns-4 gap-4 space-y-4">
{{--                    @foreach()--}}
{{--                        <img src="{{ asset('images/') }}" alt="">--}}
{{--                    @endforeach--}}
                    <img class="w-full aspect-video" src="https://picsum.photos/500/300?random=1" />
                    <img class="w-full aspect-square" src="https://picsum.photos/500/300?random=2" />
                    <img class="w-full aspect-square" src="https://picsum.photos/500/300?random=3" />
                    <img class="w-full aspect-square" src="https://picsum.photos/500/300?random=4" />
                    <img class="w-full aspect-video" src="https://picsum.photos/500/300?random=5" />
                    <img class="w-full aspect-video" src="https://picsum.photos/500/300?random=6" />
                    <img class="w-full aspect-square" src="https://picsum.photos/500/300?random=7" />
                    <img class="w-full aspect-video" src="https://picsum.photos/500/300?random=8" />
                    <img class="w-full aspect-square" src="https://picsum.photos/500/300?random=9" />
                </div>
            </div>
            <div x-cloak x-show="active === 1" class="flex flex-col gap-y-4 lg:items-center justify-center h-full py-16 md:px-16" x-transition>
                <p class="title-xl lg:text-center">
                    Come preferisci procedere?
                </p>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur, velit.
                </p>
                <div class="flex gap-8 w-full max-w-md mt-4">
                    <x-button.payment method="card" label="Credit Card" />
                    <x-button.payment method="bank" label="Bank transfer" />
                </div>
            </div>
            <div x-cloak x-show="active === 2 && method === 'bank'" x-transition>
                bank
            </div>
            <div x-cloak x-show="active === 2 && method === 'card'" x-transition>
            </div>
        </div>
    </div>
@endsection
