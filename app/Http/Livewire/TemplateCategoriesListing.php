<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Template;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class TemplateCategoriesListing extends Component
{
    /**
     * @var int|null
     */
    public ?int $categoryId = null;

    public string $search = '';

    /**
     * @param int|null $categoryId
     * @return void
     */
    public function select(?int $categoryId): void
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
            'templates' => Template::when(fn () => $this->categoryId, function ($query) {
               $query->whereHas('categories', function(Builder $query) {
                   return $query->where('id', $this->categoryId);
               });
            })->when(fn () => $this->search, function ($query) {
                $query->where('name', 'LIKE', "%{$this->search}%");
            })->orderBy('name')->get(),
        ]);
    }
}
