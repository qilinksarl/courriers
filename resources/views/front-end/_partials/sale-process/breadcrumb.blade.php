<div class="breadcrumb">
    @php
        $breadcrumb = [];

        $breadcrumb[] = (object)[
            'name' => 'Ma lettre',
            'active' => in_array(request()->segment(2), ['rediger', 'models']),
        ];

        if(
            \App\Enums\AppType::REGISTERED_LETTER->value === config('site.type') ||
            \App\Enums\AppType::POST_OFFICE->value === config('site.type')
        ) {
            $breadcrumb[] = (object)[
                'name' => 'Affranchissement',
                'active' => request()->segment(2) === 'affranchissement',
            ];
        }

        $breadcrumb[] = (object)[
            'name' => 'Destinaire',
            'active' => request()->segment(2) === 'destinataire',
        ];

        if(
            \App\Enums\AppType::TERMINATION_LETTER->value === config('site.type') ||
            (App::make(\App\Contracts\Cart::class))->getPostageType() === \App\Enums\PostageType::REGISTERED_LETTER
        ) {
            $breadcrumb[] = (object)[
                'name' => 'Expéditeur',
                'active' => request()->segment(2) === 'expediteur',
            ];
        }

        $breadcrumb[] = (object)[
            'name' => 'Paiement',
            'active' => request()->segment(2) === 'paiement',
        ];
    @endphp
    @each('front-end._partials.sale-process.breadcrumb-card', collect($breadcrumb), 'step')
</div>
