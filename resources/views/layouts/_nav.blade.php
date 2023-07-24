<nav class="sticky top-0 bg-white z-50 border-b">
    <div class="mx-auto max-w-7xl w-11/12 py-4 flex items-center justify-between">

        <a href="{{ route('home') }}" class="h-12">
            <img src="{{ asset('svg/logo/medium.webp') }}" alt="" class="h-full">
        </a>

        <livewire:search />

        <div>
            <x-button.secondary :href="route('app')">
                Scarica l'app
            </x-button.secondary>
        </div>
    </div>
</nav>
