<?php

namespace App\Http\Controllers\FrontEnd\SaleProcess;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostageController extends Controller
{
    public function show()
    {
        return view('front-end.sale-process.letter-postage');
    }
}
