<?php

namespace App\Models;

use App\DataTransferObjects\PostLetter\CampaignData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = ['data'];

    protected $casts = [
        'data' => CampaignData::class,
    ];
}
