@title('Didattica')

@extends('layouts.default')

@push('meta')
@endpush

@section('content')
    <section class="max-w-7xl w-11/12 mx-auto my-16 space-y-16">
        <div class="w-11/12 max-w-screen-md mx-auto space-y-4 text-center sm:w-full sm:py-4">
            <h1 class="badge">
                {{ __('documents.title') }}
            </h1>
            <h2 class="title-xl">
                Del testo ancora da decidere sulla didattica
            </h2>
            <p class="text-sm">
                {{ __('documents.credits', ['name' => 'Maria Chiara Cavazzoni']) }}
            </p>
        </div>
{{--        <h2 class="font-semibold">
            Cartelle
        </h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
--}}{{--            <x-document.folder />--}}{{--
        </div>--}}
        <div class="grid gap-y-4">
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
        </div>
    </section>
@endsection
