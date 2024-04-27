@extends('layouts.default', ['title' => 'Progetto'])

@push('meta')
@endpush

@section('content')
    <section>
        <h2 class="title-lg">
            {{ __("project.schools") }}
        </h2>

        <ul>
            @foreach($schools as $school)
                <li>
                    {{ $school->full_name }}
                </li>
            @endforeach
        </ul>
    </section>
@endsection
