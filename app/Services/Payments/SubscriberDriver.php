<?php

namespace App\Services\Payments;

use App\Contracts\PaymentGateway;
use App\DataTransferObjects\TransactionRedirectData;

class SubscriberDriver implements PaymentGateway
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'Subscriber';
    }

    public function authorize()
    {}

    /**
     * @param array $payload
     * @return TransactionRedirectData|bool
     */
    public function capture(array $payload): TransactionRedirectData|bool
    {
        return new TransactionRedirectData(
            status: 200,
            url: route('')
        );
    }

    /**
     * @param bool $isSubscription
     * @return void
     */
    public function setSubscription(bool $isSubscription): void
    {}
}
