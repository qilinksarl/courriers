@extends('layout.base')

@section('main')
    <article class="w-full max-w-7xl mx-auto py-12 md:py-16 px-6 md:px-9">
        @include('front-end._partials.sale-process.breadcrumb')
        <h1>Rédiger votre courrier</h1>
        <livewire:letter-edit-form
            :template="$template"
            :product="$product"
        />
    </article>
@endsection

@push('styles')
    @livewireStyles
@endpush

@push('scripts')
    @livewireScripts
@endpush
