<?php

namespace App\Contracts;

use App\DataTransferObjects\AddressData;
use App\DataTransferObjects\CustomerData;
use App\DataTransferObjects\FoldData;
use App\Enums\PostageType;
use App\Models\Brand;
use App\Models\Template;

interface Cart
{
    /**
     * @param Brand|Template|null $product
     * @return void
     */
    public function addProduct(Brand|Template|null $product): void;

    /**
     * @return Brand|Template|null
     */
    public function getProduct(): Brand|Template|null;

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
     * @return AddressData
     */
    public function getRecipient(): AddressData;

    /**
     * @param AddressData $addressData
     * @return void
     */
    public function addSender(AddressData $addressData): void;

    /**
     * @return AddressData
     */
    public function getSender(): AddressData;

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

    /**
     * @param PostageType $postageType
     * @return void
     */
    public function addPostageType(PostageType $postageType): void;

    /**
     * @return PostageType
     */
    public function getPostageType(): PostageType|null;
}
