@extends('layout.base')

@section('main')
    <article class="w-full max-w-7xl mx-auto py-12 md:py-16 px-6 md:px-9">
        @access(\App\Enums\AppType::TERMINATION_LETTER)
            <h1>Marques & modèles</h1>
            <livewire:template-brands-categories-listing/>
        @else
            <h1>Modèles de lettre</h1>
            <livewire:template-categories-listing/>
        @endaccess
    </article>
    @include('front-end._partials.sections.contact-us')
@endsection

@push('styles')
    @livewireStyles
@endpush

@push('scripts')
    @livewireScripts
@endpush
