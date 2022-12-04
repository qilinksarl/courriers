<?php

namespace App\DataTransferObjects;

use App\Enums\PostageType;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class OrderData extends Data
{
    /**
     * @param PostageType $postage
     * @param DataCollection|null $options
     * @param float $amount
     * @param bool $customer_certifies_documents_are_compliant
     * @param bool $customer_certifies_having_read_the_general_conditions_of_sale
     */
    public function __construct(
        public PostageType $postage,
        #[DataCollectionOf(OptionData::class)]
        public DataCollection|null $options = null,
        public float $amount = 0.0,
        public bool $customer_certifies_documents_are_compliant = false,
        public bool $customer_certifies_having_read_the_general_conditions_of_sale = false,
    ){
    }
}
