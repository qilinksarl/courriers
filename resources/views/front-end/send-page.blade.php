@extends('layout.base')

@section('main')
    <div class="w-full max-w-7xl mx-auto py-12 md:py-16 px-6 md:px-9">
        <section class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-8">
            @each('front-end._partials.send.select-card', collect([
                (object)[
                    'picto' => '',
                    'label' => 'Rédiger',
                    'content' => <<<HTML
                        <h2 class="font-semibold text-lg text-center pb-3">Rédiger une lettre</h2>
                        <p class="text-sm text-center">Rédigez et personnalisez votre lettre grâce à notre l'éditeur de texte : choisissez la police, les couleurs et ajoutez une signature.</p>
                     HTML,
                    'url' => route('frontend.letter.edit'),
                ],
                (object)[
                    'picto' => '',
                    'label' => 'Sélectionner',
                    'content' => <<<HTML
                        <h2 class="font-semibold text-lg text-center pb-3">Sélectionner un modèle</h2>
                        <p class="text-sm text-center">Sélectionnez un modèle de lettre pré-rédigé pour votre démarche que vous pourrez ensuite personnaliser avec vos informations.</p>
                     HTML,
                    'url' => route('frontend.letter.templates'),
                ],
                (object)[
                    'picto' => '',
                    'label' => 'Importer',
                    'content' => <<<HTML
                        <h2 class="font-semibold text-lg text-center pb-3">Importer mon fichier</h2>
                        <p class="text-sm text-center">Importez directement un ou plusieurs fichiers depuis votre appareil (les formats supportés sont .pdf ou .html uiniquement).</p>
                     HTML,
                    'url' => route('frontend.letter.import'),
                ],
            ]), 'card')
        </section>
    </div>
@endsection
