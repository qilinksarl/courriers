@extends('layout.base', ['bg' => 'bg-white'])

@section('main')
    <article class="w-full max-w-7xl mx-auto py-12 md:py-16 px-6 md:px-9">
        <h1>FAQ</h1>
        <p>{{ config('app.name') }} a mis en place cette FAQ pour vous permettre d’obtenir toutes les réponses à vos questions en seulement quelques lignes de lecture. Si vous avez encore des questions suite à la lecture de cette FAQ, les conseillers de {{ config('app.name') }} seront là pour y répondre ! Il vous suffit de les contacter via notre page contact !</p>
        <dl x-data="{open: false}" x-on:click.prevent="open = !open" class="cursor-pointer">
            <dt>Comment obtenir ma lettre de résiliation ?</dt>
            <dd x-show="open" x-cloak>Pour obtenir votre lettre de résiliation il suffit de sélectionner l’entreprise chez laquelle vous souhaitez mettre fin à votre contrat et de remplir le petit formulaire pour que nous puissions vous proposer une lettre de résiliation personnalisée.</dd>
        </dl>
        <dl x-data="{open: false}" x-on:click.prevent="open = !open" class="cursor-pointer">
            <dt>Comment mettre fin à mon abonnement {{ config('app.name') }} ?</dt>
            <dd x-show="open" x-cloak>Vous pouvez mettre fin à votre abonnement {{ config('app.name') }} instantanément et gratuitement grâce à notre système de résiliation ! Il vous suffit de vous rendre sur notre page de résiliation et e renseigner l’adresse mail utilisée lors de la souscription de votre abonnement {{ config('app.name') }}.</dd>
        </dl>
        <dl x-data="{open: false}" x-on:click.prevent="open = !open" class="cursor-pointer">
            <dt>Comment puis-je accéder à mon espace personnel ?</dt>
            <dd x-show="open" x-cloak>Suite à votre achat sur {{ config('app.name') }}, vous avez reçu un mail contenant votre mot de passe ainsi que votre identifiant pour accéder à votre espace personnel. Il vous suffit ensuite de vous rendre sur la page Espace Personnel.</dd>
        </dl>
        <dl x-data="{open: false}" x-on:click.prevent="open = !open" class="cursor-pointer">
            <dt>J’ai un problème avec la lettre téléchargée!</dt>
            <dd x-show="open" x-cloak>
                Vous n’arrivez pas à ouvrir la lettre que vous venez de télécharger ? C’est probablement parce que vous ne disposez pas de logiciel permettant d’ouvrir les documents de type PDF. Il vous suffit de vous munir d’un de ces logiciels pour pouvoir l’ouvrir !</dd>
        </dl>
        <dl x-data="{open: false}" x-on:click.prevent="open = !open" class="cursor-pointer">
            <dt>Combien de lettres puis-je télécharger sur {{ config('app.name') }} ?</dt>
            <dd x-show="open" x-cloak>Grâce à l’offre proposée par {{ config('app.name') }} vous avez la possibilité de télécharger toutes les lettres dont vous avez besoin. Pour retrouver tous les avantages liés à votre abonnement {{ config('app.name') }} n’hésitez pas à vous rendre sur notre page d’accueil.</dd>
        </dl>
        <dl x-data="{open: false}" x-on:click.prevent="open = !open" class="cursor-pointer">
            <dt>Pourquoi est-ce qu’un prélèvement {{ config('app.name') }} apparaît sur mon relevé de compte bancaire ?</dt>
            <dd x-show="open" x-cloak>Si vous voyez un prélèvement {{ config('app.name') }} apparaître sur votre relevé de compte bancaire c’est sans aucun doute parce que vous avez souscrit un abonnement à {{ config('app.name') }}. Si vous souhaitez obtenir de plus amples informations concernant votre abonnement {{ config('app.name') }} vous pouvez joindre les conseillers {{ config('app.name') }}.</dd>
        </dl>
    </article>
@endsection
