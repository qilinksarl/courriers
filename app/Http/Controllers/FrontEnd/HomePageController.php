<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Registries\PaymentGatewayRegistry;

class HomePageController extends Controller
{
    /**
     * @throws \Exception
     */
    public function __invoke()
    {
        return view('front-end.home-page');
    }
}
