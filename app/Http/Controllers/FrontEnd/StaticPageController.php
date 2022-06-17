<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaticPageController extends Controller
{
    public function __invoke(String $slug)
    {
        return match($slug) {
            'envoyer' => view('front-end.send-page'),
            'faq' => view('front-end.faq-page'),
            'prix' => view('front-end.price-page'),
            default => view('front-end.static-page'),
        };
    }
}
