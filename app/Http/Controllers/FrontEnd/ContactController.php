<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * @return View
     */
    public function show(): View
    {
        return view('front-end.contact');
    }

    public function store()
    {

    }
}
