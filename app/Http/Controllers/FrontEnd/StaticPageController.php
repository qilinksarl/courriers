<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaticPageController extends Controller
{
    public function __invoke(String $slug)
    {
        return match($slug) {
            //'envoyer' => view('front-end.send-page'),
            //'prix' => view('front-end.price-page'),
            'desabonnement' => view('front-end.unsubscribe-page'),
            'faq' => view('front-end.faq-page'),
            default => view('front-end.static-page'),
        };
    }
}
