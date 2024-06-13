@props(['title', 'value'])

<div
    @click="navigator.clipboard.writeText('{{ $value }}')"
    class="py-6 flex items-center justify-between cursor-pointer hover:bg-gray-50"
>
    <div class="grow grid sm:grid-cols-5">
        <dt>{{ $title }}</dt>

        <dd class="sm:col-span-4">{{ $value }}</dd>
    </div>

    <button type="button">
        ic
    </button>
</div>
