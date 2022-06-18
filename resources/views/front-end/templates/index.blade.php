@extends('layout.base')

@section('main')
    <livewire:template-categories-listing/>
@endsection

@push('styles')
    @livewireStyles
@endpush

@push('scripts')
    @livewireScripts
@endpush
