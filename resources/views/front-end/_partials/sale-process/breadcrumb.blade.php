<div class="flex justify-between items-start text-xs uppercase mb-16">
    @each('front-end._partials.sale-process.breadcrumb-card', collect([
        (object)['name' => 'Ma lettre', 'active' => false],
        (object)['name' => 'Destinaire', 'active' => false],
        (object)['name' => 'Expéditeur', 'active' => false],
        (object)['name' => 'Paiement', 'active' => false],
    ]), 'step')
</div>
