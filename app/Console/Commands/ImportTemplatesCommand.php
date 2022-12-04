<?php

namespace App\Console\Commands;

use App\DataTransferObjects\ModelData;
use App\DataTransferObjects\TemplateData;
use App\Models\Category;
use App\Models\Template;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Symfony\Component\Yaml\Yaml;

class ImportTemplatesCommand extends Command
{
    private const CATEGORIES = [
        'modele-lettre-resiliation-applications-rencontre' => 'applications-sites-de-rencontre',
        'modele-lettre-resiliation-assurance' => 'assurances',
        'modele-lettre-resiliation-bail-logement' => 'bail-et-logement',
        'modele-lettre-resiliation-banque' => 'banque',
        'modele-lettre-resiliation-contrats-divers' => 'contrats-et-abonnements-divers',
        'modele-lettre-resiliation-energie' => 'energie',
        'modele-lettre-resiliation-forfait-mobile-internet-tv' => 'internet-mobile-et-tv',
        'modele-lettre-resiliation-loisirs' => 'loisirs',
        'modele-lettre-resiliation-presse-magazines' => 'presse-et-magazine',
        'modele-lettre-resiliation-mutuelle' => 'mutuelles',
        'modele-lettre-resiliation-salle-sport' => 'salles-de-sport',
        'modele-lettre-resiliation-transport' => 'transport',
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:templates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importation templates';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $files = Storage::allFiles('content/collections/modeles');

        foreach ($files as $file) {
            $object = YamlFrontMatter::parse(Storage::get($file));

            $groupFields = [];

            foreach (Yaml::parse($object->matter('template_du_formulaire')) as $keyGroup => $group) {
                if($keyGroup === 'formulaire') {
                    $groupFields['fields'] = [];

                    $groupFields['fields']['ville'] = [
                        'type' => 'string',
                        'label' => 'Votre commune',
                        'value' => null,
                    ];

                    $groupFields['fields']['date_now'] = [
                        'type' => 'date',
                        'label' => 'Date du jour',
                        'futur' => true,
                        'value' => null,
                    ];

                    foreach ($group as $field) {
                        $name = $field['name'];

                        foreach($field as $item => $value) {
                            if($item === 'when') {
                                $groupFields['fields'][$name]['futur'] = $field['when'] === 'futur';
                            } else {
                                $groupFields['fields'][$name][$item] = $value;
                            }
                        }

                        $groupFields['fields'][$name]['value'] = null;
                    }

                    $groupFields['fields']['complement_document'] = [
                        'type' => 'string',
                        'label' => 'Complément d‘informations',
                        'value' => null,
                    ];

                    $groupFields['fields']['name_sender'] = [
                        'type' => 'string',
                        'label' => 'Civilité, nom et prénom',
                        'value' => null,
                    ];
                }

                if($keyGroup === 'documents') {
                    $groupFields['documents'] = [];

                    foreach ($group as $document) {
                        $groupFields['documents'][] = [
                            'label' => $document['nom'],
                            'required' => true,
                        ];
                    }
                }
            }

            $template = Template::create(array_merge((new TemplateData(
                name: $object->matter('title'),
                model: new ModelData(
                    model: $object->matter('modele_de_lettre'),
                    group_fields: $groupFields,
                ),
            ))->toArray(), [
                'views' => $object->matter('vues') ?? 0
            ]));

            $thematique = $object->matter('thematiques');
            if($thematique) {
                $template->categories()->attach(Category::where('slug', self::CATEGORIES[$thematique])->first()->id);
            } else {
                $this->error('Pas de thématique sur ' . $template->name);
            }
        }


        return Command::SUCCESS;
    }
}
