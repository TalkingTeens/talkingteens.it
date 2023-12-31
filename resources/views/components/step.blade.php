@props(['index', 'title', 'description' => null])

<li
    @click="active = {{ $index }}"
    class="group mr-10 last:mb-0 mt-6 md:mr-0 md:mb-10 md:mt-0 md:ml-6"
    :class="max < {{ $index }} ? 'pointer-events-none [&>span]:text-gray-300' : 'cursor-pointer [&>span]:border-black [&>span]:text-black [&>span]:dark:border-st [&>span]:dark:text-st'"
>
    <span class="absolute flex items-center justify-center w-8 h-8 bg-white border rounded-full -top-4 group-hover:bg-gray-100 ring-4 ring-white dark:border-2 md:top-auto md:-left-4">
        {{ $index + 1 }}
    </span>
    <div class="hidden lg:block" :class="max < {{ $index }} && 'opacity-50'">
        <h2 class="font-medium">
            {{ $title }}
        </h2>
        @if($description)
            <p class="text-sm opacity-60 mt-1">
                {{ $description }}
            </p>
        @endif
    </div>
</li>
