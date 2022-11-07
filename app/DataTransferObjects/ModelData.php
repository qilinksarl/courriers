<?php

namespace App\DataTransferObjects;

use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;

class ModelData extends Data
{
    /**
     * @param array|string $model
     * @param array|null $group_fields
     * @param bool $is_new_type
     */
    public function __construct(
        #[Required]
        public array|string $model,
        public ?array $group_fields = null,
        #[Required]
        public bool $is_new_type = false,
    ){
    }
}
