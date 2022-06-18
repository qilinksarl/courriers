<?php

namespace App\Http\Livewire;

use App\Contracts\Cart;
use App\DataTransferObjects\DocumentData;
use App\DataTransferObjects\FoldData;
use App\Enums\DocumentType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
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
     * @return RedirectResponse|Redirector
     */
    public function save(): RedirectResponse|Redirector
    {
        $documents = [];

        foreach($this->files as $file) {
            $segments = explode('/', $file->store('documents'));
            $file_name = array_pop($segments);

            $page = null;

            if($file->getMimeType() === 'application/pdf') {
                exec('/usr/bin/pdfinfo ' . $file->getRealPath() . ' | awk \'/Pages/ {print $2}\'', $page);
            }

            $documents[] = new DocumentData(
                readable_file_name: $file->getClientOriginalName(),
                file_name: $file_name,
                path: implode('/', $segments),
                size: $file->getSize(),
                type: match($file->getMimeType()) {
                    'application/pdf' => DocumentType::PDF,
                },
                number_of_pages: ($page) ? (int)$page[0] : 1,
            );
        }

        (App::make(Cart::class))->addDocuments($documents);

        return redirect()->route('frontend.letter.recipient');
    }

    public function render()
    {
        return view('livewire.letter-import-form');
    }
}
