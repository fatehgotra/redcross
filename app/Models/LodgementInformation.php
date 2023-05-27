<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LodgementInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date_of_lodgement',
        'registering_year',
        'division',
        'registration_location',
        'registration_location_type',
    ];
}
