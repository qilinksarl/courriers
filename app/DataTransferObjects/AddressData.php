<?php

namespace App\DataTransferObjects;

use App\Enums\AddressType;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class AddressData extends Data
{
    public function __construct(
        public ?string $address_line_1,
        public ?string $address_line_2,
        public ?string $address_line_3,
        public ?string $address_line_4,
        public ?string $address_line_5,
        public ?string $address_line_6,
        public ?string $address_line_7,
        public AddressType $type = AddressType::PROFESSIONAL,
    ){
    }
}
