<?php

namespace App\Http\Livewire;

use App\Contracts\Cart;
use App\Traits\WithPaymentGateway;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class LetterPaymentProcess extends Component
{
    use WithPaymentGateway;

    /**
     * @var bool
     */
    public bool $offerSelected = false;

    /**
     * @var bool
     */
    public bool $promotion = false;

    /**
     * @var bool
     */
    public bool $noPromotion = false;

    /**
     * @var bool
     */
    public bool $promotionMessage = false;

    /**
     * @return void
     */
    public function updatedPromotion(): void
    {
        $this->noPromotion = !$this->promotion;
    }

    /**
     * @return void
     */
    public function updatedNoPromotion(): void
    {
        $this->promotion = !$this->noPromotion;
    }

    /**
     * @return void
     */
    public function saveOffer(): void
    {
        if($this->promotion || $this->noPromotion) {
            $this->promotionMessage = false;
            $this->offerSelected = true;
        } else {
            $this->promotionMessage = true;

        }
    }

    /**
     * @param string $path
     * @return void
     */
    public function show(string $path): void
    {

    }

    /**
     * @return View
     */
    public function render(): View
    {
        $cart = App::make(Cart::class);

        return view('livewire.letter-payment-process', [
            'documents' => $cart->getDocuments(),
        ]);
    }
}
