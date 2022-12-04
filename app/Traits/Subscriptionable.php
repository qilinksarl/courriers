<?php

namespace App\Traits;

trait Subscriptionable
{
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
}
