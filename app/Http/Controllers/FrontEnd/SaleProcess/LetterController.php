<?php

namespace App\Http\Controllers\FrontEnd\SaleProcess;

use App\DataTransferObjects\ModelData;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Template;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class LetterController extends Controller
{
    /**
     * @param string|null $slug
     * @return View
     */
    public function edit(?string $slug = null): View
    {
        $product = null;
        $template = null;

        if(isset($slug)) {
            $product = Brand::where('slug', $slug)->first();

            if($product) {
                $template = $product->template->model->toArray();
            } else {
                $templateModel = Template::where('slug', $slug)->first();
                $template = $templateModel->model->toArray();
            }
        } else {
            $template = (new ModelData([], null, true))->toArray();
        }

        return view('front-end.sale-process.letter-edit', [
            'product' => $product,
            'template' => $template,
        ]);
    }
}
