<?php

namespace App\Http\Livewire;

use App\Contracts\Cart;
use App\Contracts\Pdf;
use App\DataTransferObjects\AddressData;
use App\Enums\AddressType;
use App\Enums\DocumentType;
use App\Enums\PostageType;
use App\Helpers\Country;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Livewire\Component;
use Livewire\Redirector;

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
            'recipients.*.country' => 'required|in:FRANCE_FR',
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
            $recipient['country'] .= '_' . $recipient['country_code'];
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

        if($cart->getDocuments()->first(fn ($document) => $document->type === DocumentType::TEMPLATE)) {
            (App::make(Pdf::class))->makeAll();
        }

        return redirect()->route('frontend.letter.validation');
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.letter-recipient-form', [
            'default_countries' => Country::default(),
            'countries' => Country::all()
        ]);
    }
}
