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
     * @return TransactionRedirectData|bool
     */
    public function capture(array $payload): TransactionRedirectData|bool;

    /**
     * @param bool $isSubscription
     * @return void
     */
    public function setSubscription(bool $isSubscription): void;
}
