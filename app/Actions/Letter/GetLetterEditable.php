<?php

namespace App\Actions\Letter;

use DOMDocument;
use Illuminate\Support\Str;

class GetLetterEditable
{
    /**
     * @param array $template
     * @return array
     */
    public function handle(array $template): array
    {
        $DOM = new DOMDocument();
        $DOM->loadHTML('<?xml encoding="utf-8" ?>' . Str::markdown($template['model']));

        $paragraphs = [];

        $tags = $DOM->getElementsByTagName('p');
        $varkey = '\w*';

        foreach ($tags as $index => $paragraph) {
            $paragraph = $paragraph->nodeValue;
            $paragraph = preg_replace_callback('/{{(' . $varkey . ')}}/', function ($matches) use($template) {
                $field = data_get($template['group_fields']['fields'], $matches[1]);

                if($matches[1] === 'ville') {
                    return '<text label="' . $field['label'] . '" id="' . Str::replace('_', '-', $matches[1]) . '"></text>';
                }

                if(Str::contains($matches[1], 'reference')) {
                    return '<text label="' . $field['label'] . '" id="' . Str::replace('_', '-', $matches[1]) . '"></text>';
                }

                if($matches[1] === 'complement_document') {
                    return false;
                }

                return '<text label="' . $field['label'] . '" id="' . Str::replace('_', '-', $matches[1]) . '"></text>';
            }, $paragraph);

            if($paragraph) {
                $paragraphs[] = '<p>' . $paragraph . '</p>';
            }
        }

        return ['text' => implode($paragraphs), 'json' => null];
    }
}
