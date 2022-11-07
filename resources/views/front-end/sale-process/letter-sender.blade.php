@extends('layout.base')

@section('main')
    <div class="w-full max-w-7xl mx-auto py-12 md:py-16 px-6 md:px-9">
        @include('front-end._partials.sale-process.breadcrumb')
        <h1 class="h1">Vos coordonnées</h1>
        <livewire:letter-sender-form/>
    </div>
@endsection

@push('styles')
    @livewireStyles
@endpush

@push('scripts')
    @livewireScripts
@endpush
