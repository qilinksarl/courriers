<?php

namespace App\Http\Controllers\FrontEnd\SaleProcess;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __invoke()
    {
        return view('front-end.sale-process.letter-payment');
    }
}
