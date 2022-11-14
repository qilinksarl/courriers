@extends('layout.base')

@section('main')
    <article class="w-full max-w-7xl mx-auto py-12 md:py-16 px-6 md:px-9">
        @access(\App\Enums\AppType::TERMINATION_LETTER)
            <h1>Marques & modèles</h1>
            <p class="text-lg md:text-xl leading-relaxed text-left">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur at consectetur deleniti illo qui sapiente voluptate. Ab animi dolorem doloribus error eum in ipsa laboriosam, repellat similique totam, vel vitae.</p>
            <livewire:template-brands-categories-listing/>
        @else
            <h1 class="mb-6">Modèles de lettre</h1>
            <p class="mb-12 text-lg md:text-xl leading-relaxed text-left">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur at consectetur deleniti illo qui sapiente voluptate. Ab animi dolorem doloribus error eum in ipsa laboriosam, repellat similique totam, vel vitae.</p>
            <livewire:template-categories-listing/>
        @endaccess
    </article>
    @include('front-end._partials.sections.reinsurances')
    @include('front-end._partials.sections.contact-us')
@endsection

@push('styles')
    @livewireStyles
@endpush

@push('scripts')
    @livewireScripts
@endpush
