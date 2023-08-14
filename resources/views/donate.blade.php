@title('Donate')

@extends('layouts.default')

@push('meta')
@endpush

@section('content')
    <div x-data="{ active : 0, steps: [
            { title: 1, description: 'Red' },
            { title: 2, description: 'Orange' },
            { title: 3, description: 'Yellow' },
        ]}" class="flex h-[calc(100vh-var(--nav-height))]">
        <div class="p-16 flex-1 bg-gray-50">
            <div x-show="active == 0">
                1
            </div>
            <div x-cloak x-show="active == 1">
                2
            </div>
            <div x-cloak x-show="active == 2">
                3
            </div>
        </div>

        <div class="border-l w-1/4 flex flex-col justify-between gap-y-20 p-16 overflow-y-auto no-scrollbar">
            <ol class="relative border-l">
                <template x-for="(step, index) in steps">
                    <li
                        @click="active = index"
                        :class="active < index ? 'pointer-events-none [&>span]:text-gray-300' : 'cursor-pointer [&>span]:border-black [&>span]:text-black [&>span]:dark:border-st [&>span]:dark:text-st'"
                        class="mb-10 last:mb-0 ml-6"
                    >
                        <span x-text="index+1" class="absolute flex items-center justify-center w-8 h-8 bg-white border rounded-full -left-4 ring-4 ring-white dark:border-2"></span>
                        <div :class="active < index && 'opacity-50'">
                            <h2 x-text="step.title" class="font-medium mb-1"></h2>
                            <p x-text="step.description" class="text-sm opacity-60"></p>
                        </div>
                    </li>
                </template>
            </ol>

            <div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="h-6 w-6">
                    <circle cx="256" cy="256" r="208" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/>
                    <circle cx="256" cy="256" r="80" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/>
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M208 54l8 132M296 186l8-132M208 458l8-132M296 326l8 132M458 208l-132 8M326 296l132 8M54 208l132 8M186 296l-132 8"/>
                </svg>
                <h3 class="font-medium text-sm mt-2 mb-1">
                    Hai bisogno di aiuto?
                </h3>
                <p class="text-xs">
                    Sentiti libero di contattarci in qualsiasi momento
                </p>
            </div>
        </div>
    </div>
@endsection
