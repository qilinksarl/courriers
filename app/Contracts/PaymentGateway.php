<?php

namespace App\Contracts;

use App\DataTransferObjects\TransactionRedirectData;

interface PaymentGateway
{
    /**
     * @return string
     */
    public function getName(): string;

    public function authorize();

    /**
     * @param array $payload
     * @return TransactionRedirectData
     */
    public function capture(array $payload): TransactionRedirectData;

    /**
     * @param bool $isSubscription
     * @return void
     */
    public function isSubscription(bool $isSubscription): void;
}
