<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'consent_to_be_contacted',
        'consent_to_background_check',
        'parental_consent',
        'media_consent',
        'agree_to_code_of_conduct',
        'agree_to_child_protection_policy',
        'age_under_18'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
