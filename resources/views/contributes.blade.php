@title('Sostenitori')

@extends('layouts.default')

@push('meta')
@endpush

@section('content')
    <header class="h-fill bg-[url('/public/images/sponsor.jpg')] bg-center bg-no-repeat bg-cover">
        <div class="h-full backdrop-brightness-50 py-16">
            <div class="max-w-7xl mx-auto w-11/12 h-full flex flex-col justify-between items-start text-white">
                <h1 class="badge">
                    Sponsor e Sostenitori
                </h1>
                <div>
                    <p class="title-xl">
                        Grazie!
                    </p>
                    <p class="opacity-70 font-light mt-6 max-w-xl">
                        Un grande ringraziamento a tutti coloro che hanno creduto in Talking Teens, e lo hanno sostenuto per farlo nascere! E grazie a tutti coloro che continuano a donare perché vogliono farlo vivere nel tempo!
                    </p>
                </div>
            </div>
        </div>
    </header>
    <div class="max-w-7xl mx-auto w-11/12 py-16 space-y-32">
        <x-slider.logos :collection="$sponsors"/>
        @unless($supporters->isEmpty())
            <section class="grid sm:grid-cols-2 gap-16 sm:items-start">
                <h3 class="text-3xl md:text-5xl md:leading-tight sm:sticky sm:top-[calc(var(--nav-height)+4rem)]">
                    Un ringraziamento speciale al gruppo di lavoro volontario degli studenti e stagisti
                </h3>
                <p>
                    @foreach($supporters as $supporter)
                        {{ $supporter->full_name }} <br>
                    @endforeach
                </p>
            </section>
        @endunless
    </div>
@endsection
