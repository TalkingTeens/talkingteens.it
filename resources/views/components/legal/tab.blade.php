@php($is_current = $route === Route::currentRouteName())

<a wire:navigate href="{{ route($route) }}" @class([
    "py-3 border-b shrink-0",
    "border-black font-semibold" => $is_current,
    "border-transparent" => !$is_current,
])>
    {{ $slot }}
</a>
