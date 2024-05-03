@extends('layouts.default', ['title' => 'Page not found'])

@section('content')
    <section class="section">
        <div class="max-w-2xl mx-auto">
            <h1 class="title-xl text-center">
                {{ __('404.title') }}
            </h1>
        </div>
    </section>
@endsection
