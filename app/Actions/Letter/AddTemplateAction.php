<?php

namespace App\Actions\Letter;

use App\DataTransferObjects\DocumentData;
use App\DataTransferObjects\ModelData;
use App\Enums\DocumentType;

class AddTemplateAction
{
    /**
     * @param array $template
     * @return DocumentData
     */
    public function handle(array $template): DocumentData
    {
        return new DocumentData(
            file_name: "{Str::uuid()}.pdf",
            readable_file_name: 'mon-courrier.pdf',
            model: ModelData::fromTemplate($template),
            letter: $template['model']['text'] ?? $template['letter'],
            type: DocumentType::TEMPLATE
        );
    }
}
