<div class="w-full max-w-7xl mx-auto px-6 md:px-9 grid grid-cols-2 md:grid-cols-4 py-12 gap-y-6 md:gap-y-12 gap-x-12 md:gap-x-6 text-white text-base">
    <div class="flex flex-col items-end md:items-start"><a href="{{ route('frontend.homepage') }}">LOGO</a></div>
    <div class="flex flex-col">
        <div class="text-lg font-semibold pb-3">Accès Rapide</div>
        <a href="">Espace client</a>
        <a href="{{ route('frontend.staticpage', ['slug' => 'faq']) }}">FAQ</a>
        <a href="{{ route('frontend.contact') }}">Contact</a>
        <a href="{{ route('frontend.staticpage', ['slug' => 'desabonnement']) }}">Désabonnement</a>
    </div>
    <div class="flex flex-col col-start-2 md:col-auto">
        <div class="text-lg font-semibold pb-3">Informations</div>
        <a href="{{ route('frontend.staticpage', ['slug' => 'politique-cookies']) }}">Politique de confidentialité</a>
        <a href="{{ route('frontend.staticpage', ['slug' => 'mentions-legales']) }}">Mentions légales</a>
        <a href="{{ route('frontend.staticpage', ['slug' => 'conditions-generales']) }}">Conditions générales</a>
        <a href="{{ route('frontend.staticpage', ['slug' => 'politique-cookies']) }}">Politque de cookies</a>
        <a href="{{ route('frontend.staticpage', ['slug' => 'abonnement']) }}">Modalté de l'abonnement</a>
    </div>
    <div class="flex flex-col col-start-2 md:col-auto">
        <div class="text-lg font-semibold pb-3">Coordonnées</div>
        <a href="{{ 'mailto:contact@' . config('app.name') }}">{{ 'contact@' . config('app.name') }}</a>
    </div>
    <div class="col-span-2 md:col-span-4 pt-6 md:pt-0 flex items-center justify-center">
        <div class="text-sm">©{{ now()->format('Y') . ' ' . config('app.name') }} — Tous droits réservés</div>
        {{-- Adresse entreprise en image --}}
    </div>
</div>
