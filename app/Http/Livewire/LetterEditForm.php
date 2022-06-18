<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;
use Livewire\Redirector;
use Livewire\WithFileUploads;

class LetterEditForm extends Component
{
    use WithFileUploads;

    /**
     * @var array|null
     */
    public ?array $model = null;

    /**
     * @var mixed
     */
    public mixed $files = [];

    /**
     * @return void
     */
    public function autosave(): void
    {

    }

    /**
     * @return RedirectResponse|Redirector
     */
    public function save(): RedirectResponse|Redirector
    {
        return redirect()->route('frontend.letter.recipient');
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.letter-edit-form');
    }
}
