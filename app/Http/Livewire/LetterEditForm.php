<?php

namespace App\Http\Livewire;

use App\Contracts\Cart;
use App\DataTransferObjects\AddressData;
use App\DataTransferObjects\DocumentData;
use App\DataTransferObjects\ModelData;
use App\Enums\AppType;
use App\Enums\PostageType;
use App\Models\Brand;
use App\Models\Template;
use App\Traits\Documentable;
use Carbon\Carbon;
use DOMDocument;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Redirector;
use Livewire\WithFileUploads;

class LetterEditForm extends Component
{
    use WithFileUploads;
    use Documentable;

    /**
     * @var Brand|Template|null
     */
    public Template|Brand|null $product = null;

    /**
     * @var array|null
     */
    public ?array $template = null;

    /**
     * @var bool
     */
    public bool $isEditable = false;

    /**
     * @var mixed
     */
    public mixed $files = [];

    /**
     * @return void
     */
    public function mount(): void
    {
        if(AppType::TERMINATION_LETTER->value === config('site.type')) {
            $this->getLetter();
        } else {
            if($this->template['is_new_type'] && empty($this->template['model'])) {
                $this->template['model'] = ['text' => 'Écrivez votre courrier ici…', 'json' => null];
                $this->isEditable = true;
            } else {
                $this->template['is_new_type'] = true;
                $this->isEditable = true;
                $this->getLetterEditable();
            }
        }
    }

    /**
     * @return void
     */
    public function autosave(): void
    {}

    /**
     * @return RedirectResponse|Redirector
     */
    public function save(): RedirectResponse|Redirector
    {
        $this->validate();

        $cart = App::make(Cart::class);

        $documents = [];

        if(array_key_exists('json', $this->template['model'])) {
            $modelData = new ModelData(
                model: $this->template['model']['json'],
                is_new_type: true
            );
        } else {
            $modelData = ModelData::from(Arr::except($this->template, 'letter'));
        }

        $file_name = Str::slug('mon courrier'). '.pdf';

        $documents[] = new DocumentData(
            file_name: $file_name,
            readable_file_name: $file_name,
            model: $modelData,
            letter: $this->template['model']['text'] ?? $this->template['letter'],
        );

        $cart->addDocuments(array_merge($documents, $this->makeDocuments($this->files)));

        if($this->product) {
            $cart->addProduct($this->product);

            if($this->product instanceof Brand) {
                $cart->addRecipient(AddressData::from(
                    collect($this->product->address)->each(fn($line) => Str::upper($line))->toArray()
                ));
            }
        }

        if(AppType::TERMINATION_LETTER->value === config('site.type')) {
            $cart->addPostageType(PostageType::REGISTERED_LETTER);

            return redirect()->route('frontend.letter.recipient');
        }

        return redirect()->route('frontend.letter.postage');
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.letter-edit-form');
    }

    /**
     * @return array
     */
    protected function rules(): array
    {
        $rule_files = 'file|mimetypes:application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/msword,text/plain';

        if(!$this->template['is_new_type'] && !empty($this->template['model'])) {
            $rules = collect(array_keys(
                Arr::except($this->template['group_fields']['fields'], ['date_now', 'complement_document'])
            ))->mapWithKeys(function($rule) {
                return ["template.group_fields.fields.{$rule}.value" => 'required'];
            })->toArray();

            $rules['files.*'] = $rule_files;

            // TODO: Supprimer le test
            ray($rules);

            return $rules;
        }

        return [
            'template.model.text' => 'required|string',
            'template.model.json' => 'required',
            'files.*' => $rule_files,
        ];
    }

    /**
     * @return void
     */
    private function getLetter(): void
    {
        $DOM = new DOMDocument();
        $DOM->loadHTML('<?xml encoding="utf-8" ?>' . Str::markdown($this->template['model']));

        $paragraphs = [];

        $tags = $DOM->getElementsByTagName('p');
        $varkey = '\w*';

        foreach ($tags as $index => $paragraph) {
            $paragraph = $paragraph->nodeValue;

            if($index > 4 && ($index + 2) < count($tags)) {
                $words = explode(' ', $paragraph);

                foreach ($words as $i => $word) {
                    preg_match('/{{' . $varkey . '}}/', $word, $matches);
                    if(! $matches) {
                        $words[$i] = mb_ereg_replace('\w', '<span class="char"></span>', $word);
                    }
                }

                $paragraph = implode(' ', $words);
            }

            $paragraph = preg_replace('/(Objet)/', '<strong>${1}</strong>', $paragraph);
            $paragraph = preg_replace_callback('/{{(' . $varkey . ')}}/', function ($matches) {
                $field = data_get($this->template['group_fields']['fields'], $matches[1]);

                if($matches[1] === 'ville') {
                    return '<span class="varkey' . (empty($field['value']) ? '' : ' text-green-500') . '">' . Str::of(empty($field['value']) ? $field['label'] : $field['value'])->lower()->title() . '</span>';
                }

                if(Str::contains($matches[1], 'reference')) {
                    return '<span class="varkey' . (empty($field['value']) ? '' : ' text-green-500') . '">' . Str::upper(empty($field['value']) ? $field['label'] : $field['value']) . '</span>';
                }

                if(Str::contains($matches[1], 'date')) {
                    if($matches[1] === 'date_now') {
                        $field['value'] = now()->format('d/m/Y');
                    } else {
                        $field['value'] = (new Carbon($field['value']))->format('d/m/Y');
                    }
                }

                if($matches[1] === 'complement_document') {
                    $field['value'] = nl2br($field['value']);
                }

                return '<span class="varkey' . (empty($field['value']) ? '' : ' text-green-500') . '">' . Str::lower(empty($field['value']) ? $field['label'] : $field['value']) . '</span>';
            }, $paragraph);

            $className = '';

            if($index === 0) {
                $className = 'text-right pb-16';
            } else if($index === 1) {
                $className = 'mb-0';
            } else if($index === 2) {
                $className = 'pb-9';
            } else if($index === 3) {
                $className = 'pb-3';
            } else if(($index + 1) === count($tags)) {
                $className = 'pt-9';
            }

            $paragraphs[] = '<p class="' . $className . '">' . $paragraph . '</p>';
        }

        $this->template['letter'] = implode($paragraphs);
    }

    /**
     * @return void
     */
    private function getLetterEditable(): void
    {
        $DOM = new DOMDocument();
        $DOM->loadHTML('<?xml encoding="utf-8" ?>' . Str::markdown($this->template['model']));

        $paragraphs = [];

        $tags = $DOM->getElementsByTagName('p');
        $varkey = '\w*';

        foreach ($tags as $index => $paragraph) {
            $paragraph = $paragraph->nodeValue;
            $paragraph = preg_replace_callback('/{{(' . $varkey . ')}}/', function ($matches) {
                $field = data_get($this->template['group_fields']['fields'], $matches[1]);

                if($matches[1] === 'ville') {
                    return '<text label="' . $field['label'] . '" id="' . Str::replace('_', '-', $matches[1]) . '"></text>';
                }

                if(Str::contains($matches[1], 'reference')) {
                    return '<text label="' . $field['label'] . '" id="' . Str::replace('_', '-', $matches[1]) . '"></text>';
                }

                if($matches[1] === 'complement_document') {
                    return false;
                }

                return '<text label="' . $field['label'] . '" id="' . Str::replace('_', '-', $matches[1]) . '"></text>';
            }, $paragraph);

            if($paragraph) {
                $paragraphs[] = '<p>' . $paragraph . '</p>';
            }
        }

        $this->template['model'] = ['text' => implode($paragraphs), 'json' => null];
    }
}
