<div class="flex justify-between items-start text-xs uppercase">
    @each('front-end._partials.sale-process.breadcrumb-card', collect([
        (object)['name' => 'Ma lettre', 'active' => false],
        (object)['name' => 'Mode d\'envoi', 'active' => false],
        (object)['name' => 'Destinaire', 'active' => false],
        (object)['name' => 'Expéditeur', 'active' => false],
        (object)['name' => 'Paiement', 'active' => false],
    ]), 'step')
</div>
