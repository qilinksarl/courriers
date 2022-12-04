<?php

namespace App\Http\Livewire;

use App\Actions\Letter\AddDocumentsAction;
use App\Actions\Letter\AddTemplateAction;
use App\Actions\Letter\GetLetter;
use App\Actions\Letter\GetLetterEditable;
use App\Contracts\Cart;
use App\Enums\AppType;
use App\Enums\DocumentType;
use App\Enums\PostageType;
use App\Helpers\MimeTypes;
use App\Models\Brand;
use App\Models\Template;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Livewire\Component;
use Livewire\Redirector;
use Livewire\WithFileUploads;

class LetterEditForm extends Component
{
    use WithFileUploads;

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
     * @return array
     */
    protected function rules(): array
    {
        $rule_files = 'file|mimetypes:' . MimeTypes::authorized();

        if(!$this->template['is_new_type'] && !empty($this->template['model'])) {
            $rules = collect(array_keys(
                Arr::except($this->template['group_fields']['fields'], ['date_now', 'complement_document'])
            ))->mapWithKeys(function($rule) {
                return ["template.group_fields.fields.{$rule}.value" => 'required'];
            })->toArray();

            $rules['files.*'] = $rule_files;

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
    public function mount(): void
    {
        $document = App::make(Cart::class)
            ->getDocuments()
            ->first(
                fn ($document) => $document->type === DocumentType::TEMPLATE
            );

        if($document) {
            $this->template= $document->model->toArray();
        }

        if(AppType::TERMINATION_LETTER->value === config('site.type')) {
            $this->template['letter'] = (new GetLetter)->handle(template: $this->template);
        } else if(
            $this->template['is_new_type'] &&
            (
                empty($this->template['model']) ||
                $document
            )
        ) {
            $this->template['model'] = ['text' => $document?->letter ?? 'Écrivez votre courrier ici…', 'json' => null];
            $this->isEditable = true;
        } else {
            $this->template['model'] = (new GetLetterEditable)->handle(template: $this->template);
            $this->template['is_new_type'] = true;
            $this->isEditable = true;
        }
    }

    /**
     * @return void
     */
    public function autosave(): void
    {}

    /**
     * @return RedirectResponse|Redirector
     * @throws Exception
     */
    public function save(): RedirectResponse|Redirector
    {
        $this->validate();
        (new AddDocumentsAction(
            templateDocument: (new AddTemplateAction)->handle($this->template)
        ))->handle(documents: $this->files);

        if(AppType::TERMINATION_LETTER->value === config('site.type')) {
            App::make(Cart::class)->addPostageType(PostageType::REGISTERED_LETTER);
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
}
