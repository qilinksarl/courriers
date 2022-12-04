<?php

namespace App\Actions\Letter;

use App\Contracts\Cart;
use App\DataTransferObjects\DocumentData;
use App\Enums\DocumentType;
use Exception;
use Illuminate\Support\Facades\App;

class AddDocumentsAction
{
    /**
     * @var array
     */
    private array $documents = [];

    /**
     * @var Cart
     */
    private Cart $cart;

    public function __construct(
        private readonly ?DocumentData $templateDocument = null,
    ) {
        $this->cart = App::make(Cart::class);
    }

    /**
     * @param array $documents
     * @return void
     * @throws Exception
     */
    public function handle(array $documents): void
    {
        foreach($documents as $document) {
            $path = $document->store('documents');
            $segments = explode('/', $path);
            $document_name = array_pop($segments);

            $page = null;

            if($document->getMimeType() === 'application/pdf') {
                exec('/usr/bin/pdfinfo ' . $document->getRealPath() . ' | awk \'/Pages/ {print $2}\'', $page);
            }

            $this->documents[] = new DocumentData(
                file_name: $document_name,
                readable_file_name: $document->getClientOriginalName(),
                path: $path,
                size: $document->getSize(),
                type: match($document->getMimeType()) {
                    'application/pdf' => DocumentType::PDF,
                    default => throw new Exception("{$document->getMimeType()} non pris en charge"),
                },
                number_of_pages: ($page) ? (int)$page[0] : 1,
            );
        }

        if($this->templateDocument) {
            $this->documents[] = $this->templateDocument;
        }

        $this->cart->addDocuments($this->documents);
    }
}
