<?php

namespace App\Http\Controllers\FrontEnd\SaleProcess;

use App\Http\Controllers\Controller;

class ValidationController extends Controller
{
    public function __invoke()
    {
        return view('front-end.sale-process.letter-validation');
    }
}
