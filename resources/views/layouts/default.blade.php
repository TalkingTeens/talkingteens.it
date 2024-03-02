@extends('layouts.base')

@section('body')
    @hasSection('sidebar')
        <aside x-data :class="$store.sidebar.open && '!translate-x-0'"
               class="max-lg:hidden print:hidden fixed z-20 top-0 right-0 h-screen shrink-0 w-full md:w-1/4 translate-x-full transform-gpu transition-transform ease-in-out duration-300"
        >
            @yield('sidebar')
        </aside>
        <div x-data :class="$store.sidebar.open ? 'lg:w-3/4' : 'w-full'"
             class="transition-all ease-in-out duration-300">
    @endif
            @include('layouts.partials.ads.banner')
            @include('layouts.partials.nav')

            <main>
                @yield('content', $slot ?? '')
            </main>

            @include('layouts.partials.footer')

            @push('scripts')
                <script>
                    window.addEventListener('livewire:navigated', () => {
                        window.scrollTo({top: 0, behavior: 'instant'});
                    });
                </script>
            @endpush
    @hasSection('sidebar')
        </div>
    @endif
@endsection

@pushonce('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('sidebar', {
                open: false,

                toggle() {
                    this.open = !this.open
                }
            })
        })
    </script>
@endpushonce
