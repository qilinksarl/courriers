@extends('layout.base')

@section('main')
    @include('front-end._partials.sale-process.breadcrumb')
    <livewire:letter-payment-process/>
@endsection

@push('styles')
    @livewireStyles
@endpush

@push('scripts')
    @livewireScripts
@endpush
