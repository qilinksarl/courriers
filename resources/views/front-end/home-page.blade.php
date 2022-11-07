@extends('layout.base')

@section('main')
    @access(\App\Enums\AppType::TERMINATION_LETTER)
    @else
        @include('front-end._partials.sections.selector-process')
    @endaccess
    @include('front-end._partials.sections.reinsurances')
    @include('front-end._partials.sections.contact-us')
@endsection
