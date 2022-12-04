<?php

namespace App\Services;

use App\Contracts\Cart;
use App\Contracts\Pdf;
use App\DataTransferObjects\AddressData;
use App\DataTransferObjects\DocumentData;
use App\Enums\DocumentType;
use Barryvdh\DomPDF\Facade\Pdf as DomPdf;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DomPdfService implements Pdf
{
    private mixed $cart;

    public function __construct()
    {
        $this->cart = App::make(Cart::class);
    }

    /**
     * @inheritDoc
     */
    public function make(
        AddressData $recipientData,
        AddressData $senderData,
        DocumentData $documentData
    ): DocumentData
    {
        $path = 'documents/' . $documentData->file_name;

        Storage::put(
            $path,
            DomPdf::loadView('templates.letter', [
                'recipient' => $recipientData->toArray(),
                'sender' => $senderData->toArray(),
                'letter' => $documentData->toArray()['letter'],
            ])->stream()
        );

        $page = null;
        exec('/usr/bin/pdfinfo ' . storage_path('app/' . $path) . ' | awk \'/Pages/ {print $2}\'', $page);

        $documentData->path = $path;
        $documentData->size = File::size(storage_path('app/' . $path));
        $documentData->number_of_pages = ($page) ? (int)$page[0] : 1;

        return $documentData;
    }

    /**
     * @inheritDoc
     */
    public function makeAll(): void
    {
        $document = $this->cart->getDocuments()
            ->first(
                fn ($document) => $document->type === DocumentType::TEMPLATE
            );

        if($document) {
            $documents = $this->cart->getDocuments()->filter(
                fn ($document) => $document->type !== DocumentType::TEMPLATE
            )->toArray();

            $sender = $this->cart->getSenders()[0];

            foreach ($this->cart->getRecipients() as $recipient) {
                $documents[] = $this->make($recipient, $sender, $document);
            }

            $this->cart->addDocuments($documents);
        }
    }
}
