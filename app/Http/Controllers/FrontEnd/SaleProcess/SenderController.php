<?php

namespace App\Http\Controllers\FrontEnd\SaleProcess;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SenderController extends Controller
{
    /**
     * @return View
     */
    public function show(): View
    {
        return view('front-end.sale-process.letter-sender');
    }
}
