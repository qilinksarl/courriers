<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Template;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use LaravelIdea\Helper\App\Models\_IH_Brand_C;
use Livewire\Component;

class TemplateBrandsCategoriesListing extends Component
{
    /**
     * @var string
     */
    public string $words = '';

    /**
     * @var string|null
     */
    public ?string $category = null;

    /**
     * @var int|null
     */
    public ?int $categoryId = null;

    /**
     * @var Collection|null
     */
    public ?Collection $letters = null;

    /**
     * @param int $categoryId
     * @return void
     */
    public function getCategory(int $categoryId): void
    {
        $this->letters = $this->getLetters($categoryId);
    }

    /**
     * @return void
     */
    public function getBack(): void
    {
        $this->category = null;
        $this->categoryId = null;
        $this->letters = null;
    }


    /**
     * @param string $words
     * @return void
     */
    public function updatedWords(string $words): void
    {
        if($words) {
            $brands = Brand::select('name', 'slug')->where('name', 'LIKE', '%' . $this->words . '%');
            $templates = DB::table('templates')
                ->select('name', 'slug')
                ->where('name', 'LIKE', '%' . $this->words . '%');
            $this->letters = $brands->union($templates)->orderBy('name')->get();
        } else {
            $this->letters = $this->categoryId ? $this->getLetters($this->categoryId) : null;
        }
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.template-brands-categories-listing', [
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    /**
     * @param int $categoryId
     * @return Collection
     */
    private function getLetters(int $categoryId): Collection
    {
        $this->category = Category::findorFail($categoryId)->name;
        $this->categoryId = $categoryId;

        $brands = Brand::select('name', 'slug')->whereHas('categories', function ($query) use ($categoryId) {
            $query->where('id', $categoryId);
        });
        $templates = DB::table('templates')
            ->select('templates.name', 'templates.slug')
            ->join('categorizables', 'templates.id', '=', 'categorizables.categorizable_id')
            ->where('categorizables.category_id', $categoryId)
            ->where('categorizables.categorizable_type', 'App\\Models\\Template');

        return $brands->union($templates)->orderBy('name')->get();
    }
}
