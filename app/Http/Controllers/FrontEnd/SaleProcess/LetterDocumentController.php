<?php

namespace App\Http\Controllers\FrontEnd\SaleProcess;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class LetterDocumentController extends Controller
{
    /**
     * @return View
     */
    public function show(): View
    {
        return view('front-end.sale-process.letter-import');
    }


    public function store()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
