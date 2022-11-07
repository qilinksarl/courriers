@extends('layout.base')

@section('main')
    <div class="w-full max-w-7xl mx-auto py-12 md:py-16 px-6 md:px-9">
        <article class="grid grid-cols-1 md:grid-cols-[1fr,33%] gap-4 md:gap-12">
            <h1 class="col-span-1 md:col-span-2 mb-0">Contactez-nous</h1>
            <livewire:contact-form/>
            <div class="bg-white p-8 rounded-md shadow-xl shadow-gray-300/40 self-start flex flex-col gap-3">
                <h5>Besoin de plus d'informations concernant les services</h5>
                <p class="text-left">Vous souhaitez obtenir des informations concernant les lettres fournies par {{ config('app.name') }} ?</p>
                <p class="text-left">Aucun problème, les conseillers de {{ config('app.name') }} sont là pour vous ! Les conseillers de {{ config('app.name') }} sont tous des professionnels du service client qui sont prêt à vous aider !</p>
                <p class="text-left">Vous pouvez joindre les conseillers de {{ config('app.name') }} par téléphone ou bien par mail de 8H à 20H du lundi au samedi.</p>
            </div>
        </article>
    </div>
@endsection

@push('styles')
    @livewireStyles
@endpush

@push('scripts')
    @livewireScripts
@endpush
