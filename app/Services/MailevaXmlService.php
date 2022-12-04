<?php

namespace App\Services;

use App\Contracts\PostLetter;
use App\DataTransferObjects\PostLetter\AddressLinesData;
use App\DataTransferObjects\PostLetter\CampaignData;
use App\DataTransferObjects\PostLetter\ContentData;
use App\DataTransferObjects\PostLetter\DocumentData;
use App\DataTransferObjects\PostLetter\FoldData;
use App\DataTransferObjects\PostLetter\NotificationData;
use App\DataTransferObjects\PostLetter\OptionData;
use App\DataTransferObjects\PostLetter\PaperAddress;
use App\DataTransferObjects\PostLetter\RecipientData;
use App\DataTransferObjects\PostLetter\RequestData;
use App\DataTransferObjects\PostLetter\SenderData;
use App\DataTransferObjects\PostLetter\UserData;
use App\Enums\AddressType;
use App\Models\Campaign;
use App\Models\Fold;
use App\Settings\MailevaSettings;
use Illuminate\Support\Facades\App;

class MailevaXmlService implements PostLetter
{
    /**
     * @inheritDoc
     */
    public function execute(): void
    {
        $mailevaSettings = App::make(MailevaSettings::class);

        $requests = [];

        foreach (Fold::all() as $fold) {
            $requests[] = new RequestData(
                recipients: RecipientData::collection($fold->recipients->each(fn ($address) => new RecipientData(
                    paper_address: new PaperAddress(
                        address_lines: new AddressLinesData(
                            address_line_1: ($address->type === AddressType::PROFESSIONAL) ? $address->compagny : "{$address->first_name} {$address->last_name}",
                            address_line_2: $address->address_line_2,
                            address_line_3: $address->address_line_3,
                            address_line_4: $address->address_line_4,
                            address_line_5: $address->address_line_5,
                            address_line_6: $address->address_line_6,
                        ),
                        country: $address->country,
                        country_code: 'FR',
                    ),
                    category: $address->type->maileva(),
                    id: '',
                    track_id: '',
                    partner_track_id: '',
                ))),
                senders: SenderData::collection($fold->senders->each(fn ($address) => new SenderData(
                    paper_address: new PaperAddress(
                        address_lines: new AddressLinesData(
                            address_line_1: ($address->type === AddressType::PROFESSIONAL) ? $address->compagny : "{$address->first_name} {$address->last_name}",
                            address_line_2: $address->address_line_2,
                            address_line_3: $address->address_line_3,
                            address_line_4: $address->address_line_4,
                            address_line_5: $address->address_line_5,
                            address_line_6: $address->address_line_6,
                        ),
                        country: $address->country,
                        country_code: $address->country_code,
                    ),
                    id: '',
                ))),
                documentData: DocumentData::collection($fold->documents->each(fn ($document) => new DocumentData(
                    id: '',
                    content: new ContentData(
                        uri: '' . $document->file_name,
                    ),
                ))),
                options: OptionData::collection([]),
                folds: FoldData::collection([]),
                notifications: NotificationData::collection([]),
                media_type: $mailevaSettings->media_type,
                media_sub_type: '',
                track_id: '',
            );
        }

        $campaignData = new CampaignData(
            user: new UserData(
                auth_type: '',
                login: '',
                password: '',
            ),
            requests: RequestData::collection($requests),
            version: $mailevaSettings->version,
            partner_track_id: '',
            name: $mailevaSettings->name,
            track_id: '',
            com_application_name: '',
            break_down_code: '',
        );

        Campaign::create([
            'data' => $campaignData->toArray(),
        ]);
    }
}
