<a wire:navigate href="{{ route($route) }}" @class([
    "py-3 border-b shrink-0 -mb-px",
    "border-black font-semibold" => $route === Route::currentRouteName(),
])>
    {{ $slot }}
</a>
