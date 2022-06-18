<?php

namespace App\Http\Controllers\FrontEnd\SaleProcess;

use App\Http\Controllers\Controller;
use App\Models\Template;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class LetterController extends Controller
{
    /**
     * @return View
     */
    public function show(): View
    {
        return view('front-end.sale-process.letter-edit');
    }

    public function store()
    {

    }

    /**
     * @param Template|null $template
     * @return View
     */
    public function edit(?Template $template): View
    {
        return view('front-end.sale-process.letter-edit', [
            'template' => $template,
        ]);
    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
