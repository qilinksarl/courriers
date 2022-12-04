<?php

use App\Enums\MediaType;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

class MailevaSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('maileva.version', '5.0');
        $this->migrator->add('maileva.name', 'lettre-recommande.fr');
        $this->migrator->add('maileva.media_type', MediaType::PAPER->value);
    }
}
