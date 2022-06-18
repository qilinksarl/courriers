<?php

namespace App\Services;

use App\Contracts\Cart;
use App\DataTransferObjects\AddressData;
use App\DataTransferObjects\CustomerData;
use App\DataTransferObjects\DocumentData;
use App\DataTransferObjects\FoldData;
use Illuminate\Support\Facades\Cache;

final class CartService implements Cart
{
    public function __construct()
    {
        if(!Cache::has('cart')) {
            Cache::put('cart', [
                'documents' => null,
                'sender' => null,
                'recipient' => null,
            ]);
        }
    }

    /**
     * @param array $documents
     * @return void
     */
    public function addDocuments(array $documents): void
    {
        $cart = Cache::get('cart');
        $cart['documents'] = DocumentData::collection($documents)->toArray();
        Cache::put('cart', $cart);
    }

    /**
     * @return FoldData
     */
    public function getFold(): FoldData
    {
        return FoldData::fromArray(Cache::get('cart'));
    }

    /**
     * @param AddressData $addressData
     * @return void
     */
    public function addRecipient(AddressData $addressData): void
    {
        $cart = Cache::get('cart');
        $cart['recipient'] = $addressData->toArray();
        Cache::put('cart', $cart);
    }

    /**
     * @param AddressData $addressData
     * @return void
     */
    public function addSender(AddressData $addressData): void
    {
        $cart = Cache::get('cart');
        $cart['sender'] = $addressData->toArray();
        Cache::put('cart', $cart);
    }

    /**
     * @param CustomerData $customerData
     * @return void
     */
    public function addCustomer(CustomerData $customerData): void
    {
        Cache::put('customer', $customerData->toArray());
    }

    /**
     * @return CustomerData
     */
    public function getCustomer(): CustomerData
    {
        return CustomerData::from(Cache::get('customer'));
    }
}
