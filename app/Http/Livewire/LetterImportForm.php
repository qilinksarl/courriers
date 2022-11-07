<?php

namespace App\Http\Livewire;

use App\Contracts\Cart;
use App\DataTransferObjects\DocumentData;
use App\DataTransferObjects\FoldData;
use App\Enums\DocumentType;
use App\Traits\Documentable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\Redirector;
use Livewire\WithFileUploads;

class LetterImportForm extends Component
{
    use WithFileUploads;
    use Documentable;

    /**
     * @var mixed
     */
    public mixed $files = [];

    // TODO: Vérifier aussi la taille max du fichier
    protected $rules = [
        'files' => 'required',
        'files.*' => 'required|file|mimetypes:application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/msword,text/plain',
    ];

    /**
     * @return RedirectResponse|Redirector
     */
    public function save(): RedirectResponse|Redirector
    {
        $this->validate();

        (App::make(Cart::class))->addDocuments($this->makeDocuments($this->files));
        return redirect()->route('frontend.letter.postage');
    }

    public function render()
    {
        return view('livewire.letter-import-form');
    }
}
