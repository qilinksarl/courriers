<?php

namespace App\DataTransferObjects;

use App\Enums\AddressType;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Nullable;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;

class CustomerData extends Data
{
    /**
     * @param string|null $first_name
     * @param string|null $last_name
     * @param string|null $email
     */
    public function __construct(
        #[Required,Nullable]
        public ?string $first_name,
        #[Required,Nullable]
        public ?string $last_name,
        #[Required,Email,Nullable]
        public ?string $email,
    ){
    }
}
