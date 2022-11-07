<?php

namespace App\DataTransferObjects;

use App\Enums\AddressType;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class AddressData extends Data
{
    /**w
     * @param string|null $address_line_1
     * @param string|null $address_line_2
     * @param string|null $address_line_3
     * @param string|null $address_line_4
     * @param string|null $address_line_5
     * @param string|null $address_line_6
     * @param string|null $address_line_7
     * @param AddressType $type
     */
    public function __construct(
        public ?string $address_line_1,
        public ?string $address_line_2,
        public ?string $address_line_3,
        public ?string $address_line_4,
        public ?string $address_line_5,
        public ?string $address_line_6,
        public ?string $address_line_7,
        public AddressType|string $type = AddressType::PROFESSIONAL,
    ){
    }
}
