<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class LetterPaymentProcess extends Component
{
    /**
     * @var bool
     */
    public bool $offerSelected = false;

    /**
     * @var bool|null
     */
    public bool $promotion = false;

    /**
     * @var bool|null
     */
    public bool $noPromotion = false;

    /**
     * @var bool|null
     */
    public bool $promotionMessage = false;

    /**
     * @return void
     */
    public function updatedPromotion()
    {
        $this->noPromotion = !$this->promotion;
    }

    /**
     * @return void
     */
    public function updatedNoPromotion()
    {
        $this->promotion = !$this->noPromotion;
    }

    /**
     * @return void
     */
    public function saveOffer()
    {
        if($this->promotion || $this->noPromotion) {
            $this->promotionMessage = false;
            $this->offerSelected = true;
        } else {
            $this->promotionMessage = true;
        }
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.letter-payment-process');
    }
}
