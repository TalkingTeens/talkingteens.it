<a
    class="bg-nd p-12 text-white rounded-2xl hover:scale-95 transition-transform text-right"
    href="{{ route('statues.show', ['statue' => $statue]) }}"
>
    <img src="{{ asset($statue->statue_image) }}" alt="">

    <h2 class="text-xl font-extrabold">
        {{ $statue->name }}
    </h2>
    <p>
        {{ $statue->role }}
    </p>
</a>
