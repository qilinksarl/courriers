<?php

namespace App\Http\Livewire;

use App\Contracts\Cart;
use App\DataTransferObjects\AddressData;
use App\DataTransferObjects\CustomerData;
use App\Enums\AddressType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Redirector;

class LetterSenderForm extends Component
{
    /**
     * @var array|null
     */
    public ?array $sender = null;

    /**
     * @var bool
     */
    public bool $is_professional = false;

    /**
     * @var array
     */
    protected $rules = [
        'sender.first_name' => 'required|string',
        'sender.last_name' => 'required|string',
        'sender.email' => 'required|email',
        'sender.address_line_2' => 'required|string|max:38',
        'sender.address_line_3' => 'nullable|string|max:38',
        'sender.address_line_4' => 'nullable|string|max:38',
        'sender.address_line_5' => 'nullable|string|max:38',
        'sender.postal_code' => 'required|string|size:5',
        'sender.city' => 'required|string|max:32',
        'sender.country' => 'required|in:FRANCE',
    ];

    /**
     * @return void
     */
    public function mount(): void
    {
        // TODO: gérer les adresses professionnels ou personnels
        $sender = (App::make(Cart::class))->getSender();

        $customer = (App::make(Cart::class))->getCustomer();

        $code_postal = null;
        $ville = null;

        if($sender->address_line_6) {
            // TODO: séparer le cp et la ville via un regex
            $address_line_6 = explode(' ', $sender->address_line_6);

            $code_postal = Arr::first($address_line_6);
            Arr::forget($address_line_6, 0);
            $ville = Arr::join($address_line_6, ' ');
        }

        $this->sender = [
            'first_name' => $customer->first_name,
            'last_name' => $customer->last_name,
            'address_line_2' => $sender->address_line_2,
            'address_line_2' => $sender->address_line_2,
            'address_line_3' => $sender->address_line_3,
            'address_line_4' => $sender->address_line_4,
            'address_line_5' => $sender->address_line_5,
            'postal_code' => $code_postal,
            'city' => $ville,
            'country' => $sender->address_line_7,
            'email' => $customer->email,
        ];
    }

    /**
     * @return RedirectResponse|Redirector
     */
    public function save(): RedirectResponse|Redirector
    {
        $this->validate();

        $cart = App::make(Cart::class);

        $cart->addSender(new AddressData(
            Str::upper(trim($this->sender['first_name']) . ' ' . trim($this->sender['last_name'])),
            Str::upper(trim($this->sender['address_line_2'])),
            Str::upper(trim($this->sender['address_line_3'])),
            Str::upper(trim($this->sender['address_line_4'])),
            Str::upper(trim($this->sender['address_line_5'])),
            Str::upper(trim($this->sender['postal_code']) . ' ' . trim($this->sender['city'])),
            $this->sender['country'],
            AddressType::PROFESSIONAL
        ));

        $cart->addCustomer(new CustomerData(
            Str::lower(trim($this->sender['first_name'])),
            Str::lower(trim($this->sender['last_name'])),
            Str::lower(trim($this->sender['email'])),
        ));

        return redirect()->route('frontend.letter.payment');
    }

    public function render()
    {
        return view('livewire.letter-sender-form', ['countries' => ['France','Afghanistan','Afrique du Sud','Albanie','Algérie','Allemagne','Andorre','Angola','Anguilla','Antigua-et-Barbuda','Antilles Néerlandaises','Arabie Saoudite','Argentine','Arménie','Aruba','Australie','Autriche','Azerbaïdjan','Bahamas','Bahreïn','Bangladesh','Barbade','Belgique','Belize','Bénin','Bermudes','Bhoutan','Biélorussie','Birmanie (Myanmar)','Bolivie','Bosnie-Herzégovine','Botswana','Brésil','Brunei','Bulgarie','Burkina Faso','Burundi','Cambodge','Cameroun','Canada','Cap-vert','Chili','Chine','Chypre','Colombie','Comores','Corée du Nord','Corée du Sud','Costa Rica','Côte d\'Ivoire','Croatie','Cuba','Danemark','Djibouti','Dominique','Égypte','Émirats Arabes Unis','Équateur','Érythrée','Espagne','Estonie','États Fédérés de Micronésie','États-Unis','Éthiopie','Fidji','Finlande','France','Gabon','Gambie','Géorgie','Géorgie du Sud et les Îles Sandwich du Sud','Ghana','Gibraltar','Grèce','Grenade','Groenland','Guadeloupe','Guam','Guatemala','Guinée','Guinée-Bissau','Guinée Équatoriale','Guyana','Guyane Française','Haïti','Honduras','Hong-Kong','Hongrie','Île Christmas','Île de Man','Île Norfolk','Îles Åland','Îles Caïmanes','Îles Cocos (Keeling)','Îles Cook','Îles Féroé','Îles Malouines','Îles Mariannes du Nord','Îles Marshall','Îles Pitcairn','Îles Salomon','Îles Turks et Caïques','Îles Vierges Britanniques','Îles Vierges des États-Unis','Inde','Indonésie','Iran','Iraq','Irlande','Islande','Israël','Italie','Jamaïque','Japon','Jordanie','Kazakhstan','Kenya','Kirghizistan','Kiribati','Koweït','Laos','Le Vatican','Lesotho','Lettonie','Liban','Libéria','Libye','Liechtenstein','Lituanie','Luxembourg','Macao','Madagascar','Malaisie','Malawi','Maldives','Mali','Malte','Maroc','Martinique','Maurice','Mauritanie','Mayotte','Mexique','Moldavie','Monaco','Mongolie','Monténégro','Montserrat','Mozambique','Namibie','Nauru','Népal','Nicaragua','Niger','Nigéria','Niué','Norvège','Nouvelle-Calédonie','Nouvelle-Zélande','Oman','Ouganda','Ouzbékistan','Pakistan','Palaos','Panama','Papouasie-Nouvelle-Guinée','Paraguay','Pays-Bas','Pérou','Philippines','Pologne','Polynésie Française','Porto Rico','Portugal','Qatar','République Centrafricaine','République de Macédoine','République Démocratique du Congo','République Dominicaine','République du Congo','République Tchèque','Réunion','Roumanie','Royaume-Uni','Russie','Rwanda','Saint-Kitts-et-Nevis','Saint-Marin','Saint-Pierre-et-Miquelon','Saint-Vincent-et-les Grenadines','Sainte-Hélène','Sainte-Lucie','Salvador','Samoa','Samoa Américaines','Sao Tomé-et-Principe','Sénégal','Serbie','Seychelles','Sierra Leone','Singapour','Slovaquie','Slovénie','Somalie','Soudan','Sri Lanka','Suède','Suisse','Suriname','Svalbard et Jan Mayen','Swaziland','Syrie','Tadjikistan','Taïwan','Tanzanie','Tchad','Terres Australes Françaises','Thaïlande','Timor Oriental','Togo','Tonga','Trinité-et-Tobago','Tunisie','Turkménistan','Turquie','Tuvalu','Ukraine','Uruguay','Vanuatu','Venezuela','Viet Nam','Wallis et Futuna','Yémen','Zambie','Zimbabwe']]);
    }
}
