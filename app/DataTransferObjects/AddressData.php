<?php

namespace App\DataTransferObjects;

use App\DataTransferObjects\Casts\AddressTypeCast;
use App\Enums\AddressType;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;

class AddressData extends Data
{
    /**w
     * @param string|null $compagny
     * @param string|null $first_name
     * @param string|null $last_name
     * @param string|null $address_line_2
     * @param string|null $address_line_3
     * @param string|null $address_line_4
     * @param string|null $address_line_5
     * @param string|null $postal_code
     * @param string|null $city
     * @param string|null $country
     * @param AddressType $type
     */
    public function __construct(
        public ?string $compagny,
        public ?string $first_name,
        public ?string $last_name,
        public ?string $address_line_2,
        public ?string $address_line_3,
        public ?string $address_line_4,
        public ?string $address_line_5,
        public ?string $postal_code,
        public ?string $city,
        public ?string $country,
        public ?string $country_code,
        #[WithCast(AddressTypeCast::class)]
        public AddressType $type = AddressType::PROFESSIONAL,
    ){
    }
}
