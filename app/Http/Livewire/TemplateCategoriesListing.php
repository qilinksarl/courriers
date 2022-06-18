<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Template;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class TemplateCategoriesListing extends Component
{
    /**
     * @var int|null
     */
    public ?int $categoryId = null;

    /**
     * @return void
     */
    public function mount()
    {
        $this->categoryId = Category::orderBy('name')->first()?->id;
    }

    /**
     * @param int $categoryId
     * @return void
     */
    public function select(int $categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.template-categories-listing', [
            'templateCategories' => Category::orderBy('name')->get(),
            'templates' => Template::where('category_id', $this->categoryId)->orderBy('name')->get(),
        ]);
    }
}
