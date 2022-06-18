<?php

namespace App\DataTransferObjects;

use App\Enums\AddressType;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;

class CustomerData extends Data
{
    public function __construct(
        #[Required]
        public string $first_name,
        #[Required]
        public string $last_name,
        #[Required,Email]
        public string $email
    ){
    }
}
