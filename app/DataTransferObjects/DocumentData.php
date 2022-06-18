<?php

namespace App\DataTransferObjects;

use App\Enums\DocumentType;
use Spatie\LaravelData\Attributes\Validation\IntegerType;
use Spatie\LaravelData\Attributes\Validation\Nullable;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;

class DocumentData extends Data
{
    /**
     * @param string $readable_file_name
     * @param string $file_name
     * @param string $path
     * @param int $size
     * @param array|null $form_data
     * @param DocumentType $type
     * @param int $number_of_pages
     */
    public function __construct(
        #[Nullable]
        public ?string $readable_file_name,
        #[Required]
        public string $file_name,
        #[Required]
        public string $path,
        #[Required,IntegerType]
        public int $size,
        public ?array $form_data = null,
        #[Required]
        public DocumentType $type = DocumentType::PDF,
        #[Required,IntegerType]
        public int $number_of_pages = 1,
    ){
    }
}
