@title('Didattica')

@extends('layouts.default')

@push('meta')
@endpush

@section('content')
    <section class="max-w-7xl w-11/12 mx-auto my-16 grid gap-y-4">
        <h1 class="title-2xl">
            {{ __('documents.title') }}
        </h1>

{{--        <h2 class="font-semibold">
            Cartelle
        </h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
--}}{{--            <x-document.folder />--}}{{--
        </div>--}}
        @foreach ($categories as $key => $documents)
            <h2 class="font-semibold">
                {{ __("documents.categories.{$key}") }}
            </h2>
            <div class="grid gap-2 sm:gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
                @foreach ($documents as $document)
                    <livewire:document.file :document="$document" />
                @endforeach
            </div>
        @endforeach
        <p class="text-sm text-center mt-12">
            {{ __('documents.credits', ['name' => 'Maria Chiara Cavazzoni']) }}
        </p>
    </section>

@endsection
