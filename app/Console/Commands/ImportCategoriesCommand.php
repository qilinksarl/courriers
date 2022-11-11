<?php

namespace App\Console\Commands;

use App\Models\Category;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportCategoriesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importation categories';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Category::insert([
            [
                'name' => 'Applications & sites de rencontre',
                'slug' => 'applications-sites-de-rencontre',
            ],
            [
                'name' => 'Assurances',
                'slug' => 'assurances',
            ],
            [
                'name' => 'Bail et logement',
                'slug' => 'bail-et-logement',
            ],
            [
                'name' => 'Banque',
                'slug' => 'banque',
            ],
            [
                'name' => 'Contrats et abonnements divers',
                'slug' => 'contrats-et-abonnements-divers',
            ],
            [
                'name' => 'Energie',
                'slug' => 'energie',
            ],
            [
                'name' => 'Internet, mobile et TV',
                'slug' => 'internet-mobile-et-tv',
            ],
            [
                'name' => 'Loisirs',
                'slug' => 'loisirs',
            ],
            [
                'name' => 'Presse et magazine',
                'slug' => 'presse-et-magazine',
            ],
            [
                'name' => 'Mutuelles',
                'slug' => 'mutuelles',
            ],
            [
                'name' => 'Salles de Sport',
                'slug' => 'salles-de-sport',
            ],
            [
                'name' => 'Transport',
                'slug' => 'transport',
            ],
        ]);

        return Command::SUCCESS;
    }
}
