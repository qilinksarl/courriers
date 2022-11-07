@extends('layout.base', ['bg' => 'bg-white'])

@section('main')
    <article class="w-full max-w-7xl mx-auto py-12 md:py-16 px-6 md:px-9">
        <h1>Résiliez votre abonnement </h1>
        <p>Mettez fin à votre abonnement {{ config('app.name') }} gratuitement et instantanément grâce à notre système de résiliation ! Il vous suffit de renseigner l’adresse mail utilisée lors de la souscription de votre abonnement pour rapidement mettre fin à votre abonnement.</p>
        <livewire:unsubscribe-form/>
    </article>
    @include('front-end._partials.sections.reinsurances')
@endsection
