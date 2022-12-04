<?php

namespace App\Console\Commands;

use App\DataTransferObjects\AddressData;
use App\DataTransferObjects\BrandData;
use App\Enums\PageStatus;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Template;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class ImportBrandsCommand extends Command
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

    private const TEMPLATES = [
        'bf78f9c8-cd82-432d-8e79-327ff2506306' => 1,
        'ed4a8302-8921-49c1-84d1-c943e169dc4d' => 2,
        '88ef9b99-ba67-4e8a-ac3e-bc9738d3bf45' => 3,
        'dea556e3-2d61-4e6b-80f2-42082e7a64f4' => 4,
        '87ef64db-039d-40e2-93f1-e6597e768157' => 5,
        'a88de8d2-ae45-4729-b01e-0c01829be3c8' => 6,
        '389318ad-9c4a-40e1-a450-0081e184ec63' => 7,
        '205ae05d-817b-45f3-9ff8-90a7548ae2c2' => 8,
        'c3edd26c-2fd9-44ba-87e8-e5ada5d44c72' => 9,
        '421b5c31-8d0c-483b-9919-b35704cf3bf1' => 10,
        '3aaa6d96-c3d0-4669-83c2-fe16f67c8331' => 11,
        '7bf53e78-1ebe-46e6-818f-963d04957bc4' => 12,
        '9f280532-7611-40e4-9510-d4b5ffd42b6f' => 13,
        'c046d868-47d2-42d3-8070-37311c7eda94' => 14,
        '6d42b1db-8e03-4d08-9859-7b4d49f0e99c' => 15,
        'ee3b3c23-ad65-4ee6-a29f-c0e71d211e2f' => 16,
        '1a80866e-099d-4e6e-a9a8-b9882c5b3aad' => 17,
        '9b0bfdb2-60c5-48a4-9335-c44c2003a00d' => 18,
        '73bbd4c2-f999-4031-8b44-b7795cfb6131' => 19,
        'd00d8448-7c55-4059-b738-f589b1d79149' => 20,
        'd59c79e0-1d68-49f9-a6f5-43ba063e93fc' => 21,
        'eb7772c3-fc14-4e57-be34-284898e0007f' => 22,
        '35094282-e7b7-4771-99a3-ad2b3475550a' => 23,
        '7dd4bbf5-5aa1-484d-8798-d1ccf3fefa74' => 24,
        '4d9121c0-222e-4edd-9992-caf9a1f07ef5' => 25,
        '4d5f38f1-d529-49cd-9949-64d746b6f4a1' => 26,
        'ddc42396-8bef-4cf9-b5c2-c244f5917689' => 27,
        'b1b348e6-06f6-4d22-8aa0-cc5513e1feb9' => 28,
        'd1e35244-f95a-4866-a6b6-54f0576f8f35' => 29,
        '253d30ab-88c7-42a6-9b27-c80b96d5eb01' => 30,
        '3b6cd372-aaa9-4160-87b1-e201a4ccf0e4' => 31,
        '865e5275-da30-4bdd-881d-368562319c5f' => 32,
        '872fecf3-3ee6-43c9-b26f-68458beeafd3' => 33,
        '94931ddc-ffbf-4180-b7ed-0fe44bbd840f' => 34,
        'df89ed04-83a6-4e6e-bb10-1312b8945551' => 35,
        '1001d951-59b8-48e4-ace7-88d38da64301' => 36,
        'eea16a0a-fec1-4182-abeb-ad896b34c4b1' => 37,
        'bc548342-d100-4ee0-8493-ae64157b0e5a' => 38,
        'e9a920e5-5e19-4c20-8754-a2422a93b62d' => 39,
        'e2a3b795-852d-4d35-b113-8c0e9f9b9aa2' => 40,
        'e7b98d37-8fb1-4c61-830e-b7cfc192bf1a' => 41,
        'd482234e-87c9-4512-8a66-1a650ddaf5d2' => 42,
        '63fd14ff-06ba-43bb-b0fc-340ae06d90e4' => 43,
        'df43e3db-2d3b-4bfb-9501-d0be8e41dee6' => 44,
        '11289b9a-3717-4438-94b5-9d5c873e3b17' => 45,
        'b335c96e-f2d1-4bd2-aa87-e3b9b50b0025' => 46,
        '33f5c733-a85e-46f1-a103-971ca1ce2292' => 47,
        'cf104f8f-553b-4c49-9acb-c31948bfe40f' => 48,
        '7a5305e7-85bd-484c-9aa6-082ac25db315' => 49,
        'dfb0d48f-6655-4183-98d9-66c37f27967c' => 50,
        'fd14b7cd-5df8-432d-9d69-1f6ced9a6601' => 51,
        '1799f55b-eaed-492c-a285-83fd867ec41f' => 52,
        '0375bc21-fe70-49d7-8280-ebf0d0cc5270' => 53,
        '444b5e34-f6a8-4e16-832a-630bc8c80f4b' => 54,
        'e52655cb-afc5-4f36-b5f4-b262dad2e5f3' => 55,
        '84e8ff59-20ab-4bb6-a60a-85a1e0c69533' => 56,
        'ffbe3c79-0bd3-4d7e-b0ad-c5d458d0a004' => 57,
        '91b80252-20ee-499a-807b-77dada8aa0c4' => 58,
        '12d0460e-32cb-437b-8eba-9e07247ca8f1' => 59,
        '36080ac4-737f-486b-89bd-bd588e67b50e' => 60,
        '1e3e1056-f0f0-4ff0-835e-81977813d62f' => 61,
        '05159681-5fdf-4d19-a4c9-6e53b0af0891' => 62,
        '5ab21411-fd1f-41ae-b6e6-a2444367d3e0' => 63,
        '882ec4bc-af43-4b93-8e11-a1a2720f57c8' => 64,
        '4d15df9d-0162-48f3-a1ac-a1f7262f4e6a' => 65,
        'be419d60-97cb-4a04-8138-f7a7ab5a0d92' => 66,
        '75afc50e-8917-4531-9630-cd5a44bcd883' => 67,
        'f2908720-a753-477e-93bd-bfd28391c87f' => 68,
        'd1414ad1-ab36-4e73-a6a6-95d84c450cd6' => 69,
        '32954555-88eb-40b1-bf36-fae4570b2e04' => 70,
        'c8c2e4f4-6b0d-4497-b703-fcebac75c051' => 71,
        '35fc040c-6fa9-4b1d-9a42-40fe2f2f8a43' => 72,
        'b377e61b-ea75-474a-9f3d-f929ccb2d7f8' => 73,
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:brands';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importation brands';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $files = Storage::allFiles('content/collections/marques');

        foreach ($files as $file) {
            $object = YamlFrontMatter::parse(Storage::get($file));

            if(! $object->matter('sous_marques')) {
                $brand = Brand::create(array_merge((new BrandData(
                    name: $object->matter('title'),
                    address: new AddressData(
                        compagny: $object->matter('destinataire'),
                        first_name: null,
                        last_name: null,
                        address_line_2: null,
                        address_line_3: null,
                        address_line_4: $object->matter('adresse'),
                        address_line_5: null,
                        postal_code: $object->matter('code_postal'),
                        city: Str::of($object->matter('commune'))->trim()->upper(),
                        country: 'France'
                    ),
                    status: PageStatus::VISIBLE,
                ))->toArray(), [
                    'views' => $object->matter('vues') ?? 0
                ]));

                $template = $object->matter('lettre');
                if($template) {
                    $brand->template()->associate(Template::find(self::TEMPLATES[$template]));
                    $brand->save();
                } else {
                    $this->error('Pas de template sur ' . $brand->name);
                }

                if($object->matter('thematiques')) {
                    $ids = [];
                    foreach ($object->matter('thematiques') as $thematique) {
                        $ids[] = Category::where('slug', self::CATEGORIES[$thematique])->first()->id;
                    }

                    $brand->categories()->attach($ids);
                } else {
                    $this->error('Pas de thématique sur ' . $brand->name);
                }
            }
        }

        return Command::SUCCESS;
    }
}
