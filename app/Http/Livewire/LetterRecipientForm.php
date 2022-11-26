<?php

namespace App\Http\Livewire;

use App\Contracts\Cart;
use App\DataTransferObjects\AddressData;
use App\Enums\AddressType;
use App\Enums\PostageType;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Redirector;
use Spatie\LaravelData\DataCollection;

class LetterRecipientForm extends Component
{
    /**
     * @var array
     */
    public array $recipients = [];

    /**
     * @return array
     */
    protected function rules(): array
    {
        $rules = [
            'recipients.*.address_line_2' => 'nullable|string|max:38',
            'recipients.*.address_line_3' => 'nullable|string|max:38',
            'recipients.*.address_line_4' => 'required|string|max:38',
            'recipients.*.address_line_5' => 'nullable|string|max:38',
            'recipients.*.postal_code' => 'required|string|size:5',
            'recipients.*.city' => 'required|string|max:32',
            'recipients.*.country' => 'required|in:FRANCE',
            'recipients.*.type' => 'required',
        ];

        foreach ($this->recipients as $index => $recipient) {
            if($recipient['type'] === AddressType::PROFESSIONAL->value) {
                $rules['recipients.'.$index.'.compagny'] = 'required|string|max:38';
            } else {
                $rules['recipients.'.$index.'.first_name'] = 'required|string|max:19';
                $rules['recipients.'.$index.'.last_name'] = 'required|string|max:19';
            }
        }

        return $rules;
    }

    /**
     * @return void
     */
    public function mount(): void
    {
        $recipients = (App::make(Cart::class))->getRecipients()->toArray();

        foreach($recipients as $index => $recipient) {
            $recipient['type'] = $recipient['type']->value;
            $this->recipients[] = $recipient;
        }
    }

    /**
     * @return void
     */
    public function add(): void
    {
        $recipient = AddressData::empty();
        $recipient['type'] = $recipient['type']->value;
        $this->recipients[] = $recipient;
    }

    /**
     * @param int $index
     * @return void
     */
    public function remove(int $index): void
    {
        array_splice($this->recipients, $index, 1);
    }

    /**
     * @return RedirectResponse|Redirector
     */
    public function save(): RedirectResponse|Redirector
    {
        $this->validate();


        $cart = (App::make(Cart::class));

        $cart->addRecipients($this->recipients);

        if($cart->getPostageType() === PostageType::REGISTERED_LETTER) {
            return redirect()->route('frontend.letter.sender');
        }

        return redirect()->route('frontend.letter.payment');
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.letter-recipient-form', ['countries' => ['France','Afghanistan','Afrique du Sud','Albanie','Algérie','Allemagne','Andorre','Angola','Anguilla','Antigua-et-Barbuda','Antilles Néerlandaises','Arabie Saoudite','Argentine','Arménie','Aruba','Australie','Autriche','Azerbaïdjan','Bahamas','Bahreïn','Bangladesh','Barbade','Belgique','Belize','Bénin','Bermudes','Bhoutan','Biélorussie','Birmanie (Myanmar)','Bolivie','Bosnie-Herzégovine','Botswana','Brésil','Brunei','Bulgarie','Burkina Faso','Burundi','Cambodge','Cameroun','Canada','Cap-vert','Chili','Chine','Chypre','Colombie','Comores','Corée du Nord','Corée du Sud','Costa Rica','Côte d\'Ivoire','Croatie','Cuba','Danemark','Djibouti','Dominique','Égypte','Émirats Arabes Unis','Équateur','Érythrée','Espagne','Estonie','États Fédérés de Micronésie','États-Unis','Éthiopie','Fidji','Finlande','France','Gabon','Gambie','Géorgie','Géorgie du Sud et les Îles Sandwich du Sud','Ghana','Gibraltar','Grèce','Grenade','Groenland','Guadeloupe','Guam','Guatemala','Guinée','Guinée-Bissau','Guinée Équatoriale','Guyana','Guyane Française','Haïti','Honduras','Hong-Kong','Hongrie','Île Christmas','Île de Man','Île Norfolk','Îles Åland','Îles Caïmanes','Îles Cocos (Keeling)','Îles Cook','Îles Féroé','Îles Malouines','Îles Mariannes du Nord','Îles Marshall','Îles Pitcairn','Îles Salomon','Îles Turks et Caïques','Îles Vierges Britanniques','Îles Vierges des États-Unis','Inde','Indonésie','Iran','Iraq','Irlande','Islande','Israël','Italie','Jamaïque','Japon','Jordanie','Kazakhstan','Kenya','Kirghizistan','Kiribati','Koweït','Laos','Le Vatican','Lesotho','Lettonie','Liban','Libéria','Libye','Liechtenstein','Lituanie','Luxembourg','Macao','Madagascar','Malaisie','Malawi','Maldives','Mali','Malte','Maroc','Martinique','Maurice','Mauritanie','Mayotte','Mexique','Moldavie','Monaco','Mongolie','Monténégro','Montserrat','Mozambique','Namibie','Nauru','Népal','Nicaragua','Niger','Nigéria','Niué','Norvège','Nouvelle-Calédonie','Nouvelle-Zélande','Oman','Ouganda','Ouzbékistan','Pakistan','Palaos','Panama','Papouasie-Nouvelle-Guinée','Paraguay','Pays-Bas','Pérou','Philippines','Pologne','Polynésie Française','Porto Rico','Portugal','Qatar','République Centrafricaine','République de Macédoine','République Démocratique du Congo','République Dominicaine','République du Congo','République Tchèque','Réunion','Roumanie','Royaume-Uni','Russie','Rwanda','Saint-Kitts-et-Nevis','Saint-Marin','Saint-Pierre-et-Miquelon','Saint-Vincent-et-les Grenadines','Sainte-Hélène','Sainte-Lucie','Salvador','Samoa','Samoa Américaines','Sao Tomé-et-Principe','Sénégal','Serbie','Seychelles','Sierra Leone','Singapour','Slovaquie','Slovénie','Somalie','Soudan','Sri Lanka','Suède','Suisse','Suriname','Svalbard et Jan Mayen','Swaziland','Syrie','Tadjikistan','Taïwan','Tanzanie','Tchad','Terres Australes Françaises','Thaïlande','Timor Oriental','Togo','Tonga','Trinité-et-Tobago','Tunisie','Turkménistan','Turquie','Tuvalu','Ukraine','Uruguay','Vanuatu','Venezuela','Viet Nam','Wallis et Futuna','Yémen','Zambie','Zimbabwe']]);
    }
}
