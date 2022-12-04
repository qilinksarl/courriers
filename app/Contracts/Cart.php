<?php

namespace App\Contracts;

use App\DataTransferObjects\CustomerData;
use App\DataTransferObjects\FoldData;
use App\DataTransferObjects\OrderData;
use App\Enums\PostageType;
use App\Models\Brand;
use App\Models\Template;
use Spatie\LaravelData\DataCollection;

interface Cart
{
    /**
     * @param OrderData $order
     * @return void
     */
    public function addOrder(OrderData $order): void;

    /**
     * @return OrderData
     */
    public function getOrder(): OrderData;

    /**
     * @param array $documents
     * @return void
     */
    public function addDocuments(array $documents): void;

    /**
     * @return DataCollection
     */
    public function getDocuments(): DataCollection;

    /**
     * @param array $addresses
     * @return void
     */
    public function addRecipients(array $addresses): void;

    /**
     * @param int $index
     * @return void
     */
    public function removeRecipient(int $index): void;

    /**
     * @return DataCollection
     */
    public function getRecipients(): DataCollection;

    /**
     * @param array $addresses
     * @return void
     */
    public function addSenders(array $addresses): void;

    /**
     * @param int $index
     * @return void
     */
    public function removeSender(int $index): void;

    /**
     * @return DataCollection
     */
    public function getSenders(): DataCollection;

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
