<?php

namespace App\Services;

use App\Contracts\Cart;
use App\DataTransferObjects\AddressData;
use App\DataTransferObjects\CustomerData;
use App\DataTransferObjects\DocumentData;
use App\DataTransferObjects\FoldData;
use App\DataTransferObjects\OrderData;
use App\Enums\PostageType;
use App\Models\Brand;
use App\Models\Template;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

final class CartService implements Cart
{
    public function __construct()
    {
        if(!Session::has('cart')) {
            Session::put('cart', [
                'product' => null,
                'documents' => DocumentData::empty(),
                'sender' => AddressData::empty(),
                'recipient' => AddressData::empty(),
                'order' => OrderData::empty(),
            ]);
        }

        if(!Session::has('customer')) {
            Session::put('customer', CustomerData::empty());
        }
    }

    /**
     * @param Brand|Template|null $product
     * @return void
     */
    public function addProduct(Brand|Template|null $product): void
    {
        $cart = Session::get('cart');
        $cart['product'] = $product?->toArray();
        Session::put('cart', $cart);
    }

    /**
     * @return Brand|Template|null
     */
    public function getProduct(): Brand|Template|null
    {
        return Session::get('cart.product');
    }

    /**
     * @param array $documents
     * @return void
     */
    public function addDocuments(array $documents): void
    {
        $cart = Session::get('cart');
        $cart['documents'] = DocumentData::collection($documents)->toArray();
        Session::put('cart', $cart);
    }

    /**
     * @return FoldData
     */
    public function getFold(): FoldData
    {
        return FoldData::fromArray(Arr::except(Session::get('cart'), ['product', 'order']));
    }

    /**
     * @param AddressData $addressData
     * @return void
     */
    public function addRecipient(AddressData $addressData): void
    {
        $cart = Session::get('cart');
        $cart['recipient'] = $addressData->toArray();
        Session::put('cart', $cart);
    }

    /**
     * @return AddressData
     */
    public function getRecipient(): AddressData
    {
        return AddressData::from(Session::get('cart')['recipient']);
    }

    /**
     * @param AddressData $addressData
     * @return void
     */
    public function addSender(AddressData $addressData): void
    {
        $cart = Session::get('cart');
        $cart['sender'] = $addressData->toArray();
        Session::put('cart', $cart);
    }

    /**
     * @return AddressData
     */
    public function getSender(): AddressData
    {
        return AddressData::from(Session::get('cart')['sender']);
    }

    /**
     * @param CustomerData $customerData
     * @return void
     */
    public function addCustomer(CustomerData $customerData): void
    {
        Session::put('customer', $customerData->toArray());
    }

    /**
     * @return CustomerData
     */
    public function getCustomer(): CustomerData
    {
        return CustomerData::from(Session::get('customer'));
    }

    /**
     * @param PostageType $postageType
     * @return void
     */
    public function addPostageType(PostageType $postageType): void
    {
        $cart = Session::get('cart');
        $cart['order']['postage'] = $postageType;
        Session::put('cart', $cart);
    }

    public function getPostageType(): PostageType|null
    {
        return Session::get('cart.order.postage');
    }
}
