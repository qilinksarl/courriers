<?php

namespace App\Http\Livewire;

use App\Contracts\Cart;
use App\Contracts\Pdf;
use App\DataTransferObjects\CustomerData;
use App\Enums\AddressType;
use App\Helpers\Country;
use Illuminate\Http\RedirectResponse;
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
            'senders.*.country' => 'required|in:FRANCE_FR',
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
        $this->first_name = $customer->first_name;
        $this->last_name = $customer->last_name;
        $this->email = $customer->email;

        $senders = (App::make(Cart::class))->getSenders()->toArray();

        foreach($senders as $sender) {
            $sender['type'] = $sender['type']->value;
            $sender['country'] .= '_' . $sender['country_code'];
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
            Str::lower(trim($this->first_name)),
            Str::lower(trim($this->last_name)),
            trim($this->email),
        ));

        (App::make(Pdf::class))->makeAll();

        return redirect()->route('frontend.letter.validation');
    }

    public function render()
    {
        return view('livewire.letter-sender-form', [
            'default_countries' => Country::default(),
            'countries' => Country::all()
        ]);
    }
}
