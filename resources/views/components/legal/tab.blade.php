<a href="{{ route($route) }}" @class([
    "py-3 border-b shrink-0",
    "border-black font-semibold" => $route === $type,
    "border-transparent" => $route !== $type,
])>
    {{ __("{$route}.title") }}
</a>
