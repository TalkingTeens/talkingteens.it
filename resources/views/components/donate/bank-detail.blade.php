@props(['title', 'value', 'note' => ''])

<div x-data=""
     @click="navigator.clipboard.writeText('{{ $value }}')"
     class="grid py-4 grid-cols-[200px_1fr_auto] cursor-pointer hover:bg-gray-50">
    <p>
        {{ $title }}
    </p>
    <div>
        <p>{{ $value }}</p>
        @if($note)
            <p class="text-sm">
                {{$note}}
            </p>
        @endif
    </div>
    <button type="button">
        ic
    </button>
</div>
