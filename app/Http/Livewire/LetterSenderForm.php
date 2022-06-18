<?php

namespace App\Http\Livewire;

use App\Contracts\Cart;
use App\DataTransferObjects\AddressData;
use App\DataTransferObjects\CustomerData;
use App\Enums\AddressType;
use Illuminate\Http\RedirectResponse;
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
     * @return void
     */
    public function mount(): void
    {
        $this->sender = [
            'first_name' => null,
            'last_name' => null,
            'email' => null,
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
        $cart = App::make(Cart::class);

        $cart->addSender(new AddressData(
            Str::upper($this->sender['first_name'] . ' ' . $this->sender['last_name']),
            Str::upper($this->sender['address_line_2']),
            Str::upper($this->sender['address_line_3']),
            Str::upper($this->sender['address_line_4']),
            Str::upper($this->sender['address_line_5']),
            Str::upper($this->sender['postal_code'] . ' ' . $this->sender['city']),
            'FRANCE',
            AddressType::PROFESSIONAL
        ));

        $cart->addCustomer(new CustomerData(
            Str::lower($this->sender['first_name']),
            Str::lower($this->sender['last_name']),
            Str::lower($this->sender['email']),
        ));

        return redirect()->route('frontend.letter.payment');
    }

    public function render()
    {
        return view('livewire.letter-sender-form');
    }
}
