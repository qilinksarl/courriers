<?php

namespace App\DataTransferObjects\PostLetter;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\Validation\Nullable;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class OptionData extends Data
{
    /**
     * @param DataCollection $document_options
     * @param PaperOptionData|null $request_option
     * @param PaperOptionData|null $page_options
     */
    public function __construct(
        #[DataCollectionOf(DocumentOptionData::class)]
        public DataCollection $document_options,
        #[Nullable]
        public ?PaperOptionData $request_option = null,
        #[Nullable]
        public ?PaperOptionData $page_options = null,
    ){
    }
}
