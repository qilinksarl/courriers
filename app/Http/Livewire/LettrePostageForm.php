<?php

namespace App\Http\Livewire;

use App\Contracts\Cart;
use App\Enums\PostageType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Livewire\Component;
use Livewire\Redirector;

class LettrePostageForm extends Component
{
    /**
     * @return RedirectResponse|Redirector
     */
    public function setSimpleLetter(): RedirectResponse|Redirector
    {
        (App::make(Cart::class))->addPostageType(PostageType::SIMPLE_LETTER);
        return redirect()->route('frontend.letter.recipient');
    }

    /**
     * @return RedirectResponse|Redirector
     */
    public function setFollowedLetter(): RedirectResponse|Redirector
    {
        (App::make(Cart::class))->addPostageType(PostageType::FOLLOWED_LETTER);
        return redirect()->route('frontend.letter.recipient');
    }

    /**
     * @return RedirectResponse|Redirector
     */
    public function setRegisteredLetter(): RedirectResponse|Redirector
    {
        (App::make(Cart::class))->addPostageType(PostageType::REGISTERED_LETTER);
        return redirect()->route('frontend.letter.recipient');
    }

    public function render()
    {
        return view('livewire.lettre-postage-form');
    }
}
