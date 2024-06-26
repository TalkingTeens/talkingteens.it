@extends('layouts.base')

@section('body')
    @hasSection('sidebar')
        <aside x-data
               :class="$store.sidebar.open && '!translate-x-0'"
               class="max-sm:hidden print:hidden fixed z-50 top-0 right-0 h-screen shrink-0 max-w-md w-[calc(100%-7rem)] lg:w-1/4 translate-x-full transform-gpu transition-transform ease-in-out duration-300"
        >
            @yield('sidebar')
        </aside>
        <div x-data
             :class="$store.sidebar.open ? 'lg:w-3/4' : 'w-full'"
             class="transition-all ease-in-out duration-300 overflow-x-clip">
            @endif
            @include('layouts.partials.ads.banner')
            @include('layouts.partials.nav')

            <main>
                @yield('content', $slot ?? '')
            </main>

            @include('layouts.partials.footer')
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
