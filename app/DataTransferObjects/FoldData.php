<?php

namespace App\DataTransferObjects;

use App\Models\Fold;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Lazy;

class FoldData extends Data
{
    /**
     * @param Lazy|DataCollection|null $documents
     * @param AddressData|null $sender
     * @param AddressData|null $recipient
     */
    public function __construct(
        /** @var DocumentData */
        public Lazy|DataCollection|null $documents = null,
        public ?AddressData $sender = null,
        public ?AddressData $recipient = null,
    ){
    }

    public static function fromArray(array $fold): self
    {
        return new self(
            DocumentData::collection($fold['documents']),
            AddressData::from($fold['sender']),
            AddressData::from($fold['recipient'])
        );
    }

    public static function fromModel(Fold $fold): self
    {
        return new self(
            Lazy::create(fn() => DocumentData::collection($fold->documents)),
            $fold->sender,
            $fold->recipient
        );
    }
}
