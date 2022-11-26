<?php

namespace App\Services;

use App\Contracts\Cart;
use App\DataTransferObjects\AddressData;
use App\DataTransferObjects\CustomerData;
use App\DataTransferObjects\DocumentData;
use App\DataTransferObjects\FoldData;
use App\DataTransferObjects\OrderData;
use App\Enums\AddressType;
use App\Enums\PostageType;
use App\Models\Brand;
use App\Models\Template;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Spatie\LaravelData\DataCollection;

final class CartService implements Cart
{
    public function __construct()
    {
        if(!Session::has('cart')) {
            Session::put('cart', [
                'product' => null,
                'documents' => DocumentData::collection([]),
                'senders' => AddressData::collection([AddressData::empty()]),
                'recipients' => AddressData::collection([AddressData::empty()]),
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
        $cart['documents'] = DocumentData::collection($documents);
        Session::put('cart', $cart);
    }

    /**
     * @return DataCollection
     */
    public function getDocuments(): DataCollection
    {
        return Session::get('cart')['documents'];
    }

    /**
     * @return FoldData
     */
    public function getFold(): FoldData
    {
        return FoldData::fromArray(Arr::except(Session::get('cart'), ['product', 'order']));
    }

    /**
     * @param array $addresses
     * @return void
     */
    public function addRecipients(array $addresses): void
    {
        $cart = Session::get('cart');
        $cart['recipients'] = AddressData::collection($addresses)->each(static function ($address) {
            if($address->type === AddressType::PROFESSIONAL) {
                $address->first_name = null;
                $address->last_name = null;
            } else {
                $address->compagny = null;
            }
        });
        Session::put('cart', $cart);
    }

    /**
     * @param int $index
     * @return void
     */
    public function removeRecipient(int $index): void
    {
        $cart = Session::get('cart');
        array_splice($cart['recipients'], $index, 1);
        Session::put('cart', $cart);
    }

    /**
     * @return DataCollection
     */
    public function getRecipients(): DataCollection
    {
        return Session::get('cart')['recipients'];
    }

    /**
     * @param array $addresses
     * @return void
     */
    public function addSenders(array $addresses): void
    {
        $cart = Session::get('cart');
        $cart['senders'] = AddressData::collection($addresses)->each(static function ($address) {
            if($address->type === AddressType::PROFESSIONAL) {
                $address->first_name = null;
                $address->last_name = null;
            } else {
                $address->compagny = null;
            }
        });
        Session::put('cart', $cart);
    }

    /**
     * @param int $index
     * @return void
     */
    public function removeSender(int $index): void
    {
        $cart = Session::get('cart');
        array_splice($cart['senders'], $index, 1);
        Session::put('cart', $cart);
    }

    /**
     * @return DataCollection
     */
    public function getSenders(): DataCollection
    {
        return Session::get('cart')['senders'];
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
