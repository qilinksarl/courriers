<?php

namespace Database\Seeders;

use App\DataTransferObjects\AddressData;
use App\DataTransferObjects\BrandData;
use App\DataTransferObjects\TemplateData;
use App\Enums\AddressType;
use App\Enums\PageStatus;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Template;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Applications & sites de rencontre',
                'slug' => Str::slug('Applications & sites de rencontre'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Assurances',
                'slug' => Str::slug('Assurances'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bail et logement',
                'slug' => Str::slug('Bail et logement'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Banque',
                'slug' => Str::slug('Banque'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Contrats et abonnements divers',
                'slug' => Str::slug('Contrats et abonnements divers'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Energie',
                'slug' => Str::slug('Energie'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Internet, mobile et TV',
                'slug' => Str::slug('Internet, mobile et TV'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Loisirs',
                'slug' => Str::slug('Loisirs'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mutuelles',
                'slug' => Str::slug('Mutuelles'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Presse et magazine',
                'slug' => Str::slug('Presse et magazine'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Salles de Sport',
                'slug' => Str::slug('Salles de Sport'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Transport',
                'slug' => Str::slug('Transport'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        Category::insert($categories);

        $values = Arr::map($categories, fn ($category) => $category['slug']);

        $glues = [];
        $glues['modele-lettre-resiliation-applications-rencontre'] = $values[0];
        $glues['modele-lettre-resiliation-assurance'] = $values[1];
        $glues['modele-lettre-resiliation-bail-logement'] = $values[2];
        $glues['modele-lettre-resiliation-banque'] = $values[3];
        $glues['modele-lettre-resiliation-contrats-divers'] = $values[4];
        $glues['modele-lettre-resiliation-energie'] = $values[5];
        $glues['modele-lettre-resiliation-forfait-mobile-internet-tv'] = $values[6];
        $glues['modele-lettre-resiliation-loisirs'] = $values[7];
        $glues['modele-lettre-resiliation-mutuelle'] = $values[8];
        $glues['modele-lettre-resiliation-presse-magazines'] = $values[9];
        $glues['modele-lettre-resiliation-salle-sport'] = $values[10];
        $glues['modele-lettre-resiliation-transport'] = $values[11];

        $models = collect(Storage::files('content/collections/modeles'))->map(function ($file) {
            return (YamlFrontMatter::parse(Storage::get($file)))->matter();
        });

        collect(Storage::files('content/collections/marques'))
            ->each(function ($file) use ($glues, $models) {
                $contain = YamlFrontMatter::parse(Storage::get($file));

                if (!$contain->matter('lettre')) {
                    return null;
                }

                $address = null;
                if(
                    $contain->matter('destinataire') &&
                    $contain->matter('adresse') &&
                    $contain->matter('code_postal') &&
                    $contain->matter('commune')
                ) {
                    $address = new AddressData(
                        address_line_1: $contain->matter('destinataire'),
                        address_line_2: null,
                        address_line_3: Str::upper($contain->matter('complement_adresse')),
                        address_line_4: Str::upper($contain->matter('adresse')),
                        address_line_5: null,
                        address_line_6: Str::upper($contain->matter('code_postal') . ' ' . $contain->matter('commune')),
                        address_line_7: 'FRANCE'
                    );
                }

                $key = $models->find(fn ($model) => $model['id'] === '12d0460e-32cb-437b-8eba-9e07247ca8f1');
                $model = $models->toArray()[$key];
                $template = Template::findOrCreate(
                    ['id' => $key + 1],
                    (new TemplateData(
                        name: $model['title'],
                        slug: Str::slug($model['title']),
                        model: []
                    ))->toArray()
                );
                $template->save();

                $brandModel = new Brand((new BrandData(
                    name: $contain->matter('title'),
                    address: $address,
                    status: ($address)? PageStatus::VISIBLE : PageStatus::DRAFT
                ))->toArray());
                $brandModel->views = $contain->matter('vues') ?? 0;
                $brandModel->save();

                $brandModel->template()->save($template);

                $brandModel->categories()->attach(
                    collect($contain->matter('thematiques'))
                        ->map(fn ($thematique) => Category::where('slug', $glues[$thematique])->first())
                        ->pluck('id')
                );
            });
    }
}
