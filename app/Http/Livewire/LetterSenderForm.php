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
     * @var array
     */
    public array $senders = [];

    /**
     * @var string|null
     */
    public ?string $first_name = null;

    /**
     * @var string|null
     */
    public ?string $last_name = null;

    /**
     * @var string|null
     */
    public ?string $email = null;

    /**
     * @var array
     */
    protected function rules(): array
    {
        $rules = [
            'senders.*.address_line_2' => 'nullable|string|max:38',
            'senders.*.address_line_3' => 'nullable|string|max:38',
            'senders.*.address_line_4' => 'required|string|max:38',
            'senders.*.address_line_5' => 'nullable|string|max:38',
            'senders.*.postal_code' => 'required|string|size:5',
            'senders.*.city' => 'required|string|max:32',
            'senders.*.country' => 'required|in:FRANCE',
            'senders.*.type' => 'required',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
        ];

        foreach ($this->senders as $index => $recipient) {
            if($recipient['type'] === AddressType::PROFESSIONAL->value) {
                $rules['senders.'.$index.'.compagny'] = 'required|string|max:38';
            } else {
                $rules['senders.'.$index.'.first_name'] = 'required|string|max:19';
                $rules['senders.'.$index.'.last_name'] = 'required|string|max:19';
            }
        }

        return $rules;
    }

    /**
     * @return void
     */
    public function mount(): void
    {
        $customer = (App::make(Cart::class))->getCustomer();
        $this->first_name = null; //$customer->first_name;
        $this->last_name = null; //$customer->last_name;
        $this->email = $customer->email;

        $senders = (App::make(Cart::class))->getSenders()->toArray();

        foreach($senders as $index => $sender) {
            $sender['type'] = $sender['type']->value;
            $this->senders[] = $sender;
        }
    }

    /**
     * @return RedirectResponse|Redirector
     */
    public function save(): RedirectResponse|Redirector
    {
        $this->validate();

        $cart = App::make(Cart::class);

        $cart->addSenders($this->senders);

        $cart->addCustomer(new CustomerData(
            Str::lower(trim($this->name ?? $this->senders[0]->adresse_line_1)),
            Str::lower(trim($this->last_name)),
        ));

        return redirect()->route('frontend.letter.payment');
    }

    public function render()
    {
        return view('livewire.letter-sender-form', ['countries' => ['France','Afghanistan','Afrique du Sud','Albanie','Algérie','Allemagne','Andorre','Angola','Anguilla','Antigua-et-Barbuda','Antilles Néerlandaises','Arabie Saoudite','Argentine','Arménie','Aruba','Australie','Autriche','Azerbaïdjan','Bahamas','Bahreïn','Bangladesh','Barbade','Belgique','Belize','Bénin','Bermudes','Bhoutan','Biélorussie','Birmanie (Myanmar)','Bolivie','Bosnie-Herzégovine','Botswana','Brésil','Brunei','Bulgarie','Burkina Faso','Burundi','Cambodge','Cameroun','Canada','Cap-vert','Chili','Chine','Chypre','Colombie','Comores','Corée du Nord','Corée du Sud','Costa Rica','Côte d\'Ivoire','Croatie','Cuba','Danemark','Djibouti','Dominique','Égypte','Émirats Arabes Unis','Équateur','Érythrée','Espagne','Estonie','États Fédérés de Micronésie','États-Unis','Éthiopie','Fidji','Finlande','France','Gabon','Gambie','Géorgie','Géorgie du Sud et les Îles Sandwich du Sud','Ghana','Gibraltar','Grèce','Grenade','Groenland','Guadeloupe','Guam','Guatemala','Guinée','Guinée-Bissau','Guinée Équatoriale','Guyana','Guyane Française','Haïti','Honduras','Hong-Kong','Hongrie','Île Christmas','Île de Man','Île Norfolk','Îles Åland','Îles Caïmanes','Îles Cocos (Keeling)','Îles Cook','Îles Féroé','Îles Malouines','Îles Mariannes du Nord','Îles Marshall','Îles Pitcairn','Îles Salomon','Îles Turks et Caïques','Îles Vierges Britanniques','Îles Vierges des États-Unis','Inde','Indonésie','Iran','Iraq','Irlande','Islande','Israël','Italie','Jamaïque','Japon','Jordanie','Kazakhstan','Kenya','Kirghizistan','Kiribati','Koweït','Laos','Le Vatican','Lesotho','Lettonie','Liban','Libéria','Libye','Liechtenstein','Lituanie','Luxembourg','Macao','Madagascar','Malaisie','Malawi','Maldives','Mali','Malte','Maroc','Martinique','Maurice','Mauritanie','Mayotte','Mexique','Moldavie','Monaco','Mongolie','Monténégro','Montserrat','Mozambique','Namibie','Nauru','Népal','Nicaragua','Niger','Nigéria','Niué','Norvège','Nouvelle-Calédonie','Nouvelle-Zélande','Oman','Ouganda','Ouzbékistan','Pakistan','Palaos','Panama','Papouasie-Nouvelle-Guinée','Paraguay','Pays-Bas','Pérou','Philippines','Pologne','Polynésie Française','Porto Rico','Portugal','Qatar','République Centrafricaine','République de Macédoine','République Démocratique du Congo','République Dominicaine','République du Congo','République Tchèque','Réunion','Roumanie','Royaume-Uni','Russie','Rwanda','Saint-Kitts-et-Nevis','Saint-Marin','Saint-Pierre-et-Miquelon','Saint-Vincent-et-les Grenadines','Sainte-Hélène','Sainte-Lucie','Salvador','Samoa','Samoa Américaines','Sao Tomé-et-Principe','Sénégal','Serbie','Seychelles','Sierra Leone','Singapour','Slovaquie','Slovénie','Somalie','Soudan','Sri Lanka','Suède','Suisse','Suriname','Svalbard et Jan Mayen','Swaziland','Syrie','Tadjikistan','Taïwan','Tanzanie','Tchad','Terres Australes Françaises','Thaïlande','Timor Oriental','Togo','Tonga','Trinité-et-Tobago','Tunisie','Turkménistan','Turquie','Tuvalu','Ukraine','Uruguay','Vanuatu','Venezuela','Viet Nam','Wallis et Futuna','Yémen','Zambie','Zimbabwe']]);
    }
}
