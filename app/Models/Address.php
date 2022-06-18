<?php

namespace App\Models;

use Domain\PostOffice\DataTransferObjects\AddressLineData;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'lines_data',
    ];

    protected $casts = [
        'lines' => AddressLineData::class,
    ];
}
