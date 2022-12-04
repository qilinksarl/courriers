<?php

namespace App\Http\Livewire;

use App\Actions\Letter\AddDocumentsAction;
use App\Helpers\MimeTypes;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;
use Livewire\Redirector;
use Livewire\WithFileUploads;

class LetterImportForm extends Component
{
    use WithFileUploads;

    /**
     * @var mixed
     */
    public mixed $files = [];

    /**
     * @return string[]
     */
    protected function rules(): array
    {
        return [
            'files' => 'required',
            'files.*' => 'required|file|mimetypes:' . MimeTypes::authorized(),
        ];
    }

    /**
     * @return RedirectResponse|Redirector
     * @throws \Exception
     */
    public function save(): RedirectResponse|Redirector
    {
        $this->validate();
        (new AddDocumentsAction())->handle($this->files);

        return redirect()->route('frontend.letter.postage');
    }

    public function render()
    {
        return view('livewire.letter-import-form');
    }
}
