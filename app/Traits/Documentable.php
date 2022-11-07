<?php

namespace App\Traits;

use _PHPStan_71ced81c9\Nette\Neon\Exception;
use App\Contracts\Cart;
use App\DataTransferObjects\DocumentData;
use App\Enums\DocumentType;
use Illuminate\Support\Facades\App;

trait Documentable
{
    /**
     * @param array $files
     * @return array
     */
    private function makeDocuments(array $files): array
    {
        $documents = [];

        foreach($files as $file) {
            $segments = explode('/', $file->store('documents'));
            $file_name = array_pop($segments);

            $page = null;

            if($file->getMimeType() === 'application/pdf') {
                exec('/usr/bin/pdfinfo ' . $file->getRealPath() . ' | awk \'/Pages/ {print $2}\'', $page);
            }

            $documents[] = new DocumentData(
                file_name: $file_name,
                readable_file_name: $file->getClientOriginalName(),
                path: implode('/', $segments),
                size: $file->getSize(),
                type: match($file->getMimeType()) {
                    'application/pdf' => DocumentType::PDF,
                    default => throw new \Exception("{$file->getMimeType()} non pris en charge"),
                },
                number_of_pages: ($page) ? (int)$page[0] : 1,
            );
        }

        return $documents;
    }
}
