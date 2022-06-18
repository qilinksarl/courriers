@extends('layout.base')

@section('main')
    @include('front-end._partials.sale-process.breadcrumb')
    <livewire:letter-edit-form :model="$template->model"/>
@endsection

@push('styles')
    @livewireStyles
@endpush

@push('scripts')
    @livewireScripts
@endpush
