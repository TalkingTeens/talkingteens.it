@extends('layouts.base')

@push('meta')
@endpush

@section('body')
    <section class="max-w-7xl w-11/12 mx-auto my-16 grid gap-4">
        <h1 class="font-bold text-5xl mb-12">
            Didattica
        </h1>
        {{-- <h2 class="font-semibold">
            Cartelle
        </h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
            <x-document.folder :$document />
        </div> --}}
        @foreach ($documents as $key => $category)
            <h2 class="font-semibold">
                {{ $key }}
            </h2>
            <div class="grid gap-2 sm:gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
                @foreach ($category as $document)
                    <livewire:document.file :document="$document" />
                @endforeach
            </div>
        @endforeach
    </section>
@endsection