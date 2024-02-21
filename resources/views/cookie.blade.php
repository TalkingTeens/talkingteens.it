@extends('layouts.legal', ['title' => 'Cookie Policy'])

@push('meta')
@endpush

@php
    $translations = Lang::get('cookie.sections');
    $sections = is_string($translations) ? [] : $translations;
@endphp

@section('page')
    <div class="space-y-16 my-16 lg:w-2/3">
        <button type="button" x-data @click="$dispatch('open-manager')">
            Cookie Settings
        </button>

        @foreach($sections as $section)
            <section>
                <h2 class="title-lg">
                    {{ $section["title"] }}
                </h2>
                <p>
                    {{ $section["text"] }}
                </p>
            </section>
        @endforeach
    </div>
@endsection
