<div class="bg-amber-500 border-b-2 border-amber-400">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-8 w-full max-w-7xl mx-auto py-12 md:py-16 px-6 md:px-9 text-white">
        @each('front-end._partials.sections.reinsurance-card', collect([
                (object)[
                    'picto' => '',
                    'label' => 'Un service simple & efficace',
                ],
                (object)[
                    'picto' => '',
                    'label' => 'Envoyez vos courriers<br/>sans vous déplacer',
                ],
                (object)[
                    'picto' => '',
                    'label' => 'Envoyez vos courriers sans vous déplacer',
                ],
                (object)[
                    'picto' => '',
                    'label' => 'Des modèles de lettres prérédigés',
                ],
            ]), 'card')
    </div>
</div>
