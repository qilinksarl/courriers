<?php

namespace App\Http\Livewire;

use App\Contracts\Cart;
use App\DataTransferObjects\AddressData;
use App\Enums\AddressType;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Redirector;

class LetterRecipientForm extends Component
{
    /**
     * @var array|null
     */
    public ?array $recipient = null;

    /**
     * @return void
     */
    public function mount(): void
    {
        $this->recipient = [
            'address_line_1' => null,
            'address_line_2' => null,
            'address_line_3' => null,
            'address_line_4' => null,
            'address_line_5' => null,
            'postal_code' => null,
            'city' => null,
        ];
    }

    /**
     * @return RedirectResponse|Redirector
     */
    public function save(): RedirectResponse|Redirector
    {
        (App::make(Cart::class))->addRecipient(new AddressData(
            Str::upper($this->recipient['address_line_1']),
            Str::upper($this->recipient['address_line_2']),
            Str::upper($this->recipient['address_line_3']),
            Str::upper($this->recipient['address_line_4']),
            Str::upper($this->recipient['address_line_5']),
            Str::upper($this->recipient['postal_code'] . ' ' . $this->recipient['city']),
            'FRANCE',
            AddressType::PROFESSIONAL
        ));

        return redirect()->route('frontend.letter.sender');
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.letter-recipient-form');
    }
}
