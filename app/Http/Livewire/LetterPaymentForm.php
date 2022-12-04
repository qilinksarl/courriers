<?php

namespace App\Http\Livewire;

use App\Contracts\Cart;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rule;
use Livewire\Component;

class LetterPaymentForm extends Component
{
    /**
     * @var bool
     */
    public bool $customerCertifiesHavingReadTheGeneralConditionsOfSale = false;

    /**
     * @return array
     */
    protected function rules(): array
    {
        return [
            'customerCertifiesHavingReadTheGeneralConditionsOfSale' => 'accepted'
        ];
    }

    /**
     * @return void
     */
    public function show(): void
    {

    }

    /**
     * @return Factory|View|Application
     */
    public function render(): Factory|View|Application
    {
        $cart = App::make(Cart::class);

        return view('livewire.letter-payment-form', [
            'cart' => $cart,
            'options' => Arr::pluck($cart->getOrder()->toArray()['options'], 'price', 'name'),
            'amount' => $cart->getOrder()->amount,
        ]);
    }
}
