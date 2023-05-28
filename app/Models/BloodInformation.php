<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'blood_donar',
        'know_your_blood_group',
        'blood_group',
    ];
}
