<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaticPageController extends Controller
{
    public function __invoke(String $slug)
    {
        return view('front-end.static-page');
    }
}
