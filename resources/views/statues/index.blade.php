@title('Statue')

@extends('layouts.base')

@push('meta')
@endpush

@section('body')
    <section class="max-w-5xl w-11/12 mx-auto my-16 grid gap-4">
        <h1 class="title-lg">
            Statue
        </h1>
        <div class="grid grid-cols-2 gap-4">
            @foreach($statues as $statue)
                <x-card.statue :$statue />
            @endforeach
        </div>
    </section>
@endsection
