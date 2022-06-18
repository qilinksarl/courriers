<?php

namespace App\Contracts;

use App\DataTransferObjects\AddressData;
use App\DataTransferObjects\CustomerData;
use App\DataTransferObjects\FoldData;

interface Cart
{
    /**
     * @param array $documents
     * @return void
     */
    public function addDocuments(array $documents): void;

    /**
     * @param AddressData $addressData
     * @return void
     */
    public function addRecipient(AddressData $addressData): void;

    /**
     * @param AddressData $addressData
     * @return void
     */
    public function addSender(AddressData $addressData): void;

    /**
     * @param CustomerData $customerData
     * @return void
     */
    public function addCustomer(CustomerData $customerData): void;

    /**
     * @return CustomerData
     */
    public function getCustomer(): CustomerData;

    /**
     * @return FoldData
     */
    public function getFold(): FoldData;
}
