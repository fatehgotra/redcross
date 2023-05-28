<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteeringInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'experience',
        'red_cross_involvement',
     ];
}
