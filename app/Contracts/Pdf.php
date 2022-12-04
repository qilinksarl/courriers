<?php

namespace App\Contracts;

use App\DataTransferObjects\AddressData;
use App\DataTransferObjects\DocumentData;

interface Pdf
{
    /**
     * @param AddressData $recipientData
     * @param AddressData $senderData
     * @param DocumentData $documentData
     * @return DocumentData
     */
    public function make(AddressData $recipientData, AddressData $senderData, DocumentData $documentData): DocumentData;

    /**
     * @return void
     */
    public function makeAll(): void;
}
