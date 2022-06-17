<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\View\View;

class TemplatePageController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('front-end.templates.index', [
            'templateCategories' => Category::orderBy('name')->get(),
        ]);
    }
}
