<?php

namespace App\Traits;

use App\Registries\PaymentGatewayRegistry;
use Illuminate\Support\Facades\App;

trait WithPaymentGateway
{
    public function pay(array $payload)
    {
        $response = (
            App::make(PaymentGatewayRegistry::class)
        )->get('hipay')->capture($payload);

        dd($response);
    }
}
