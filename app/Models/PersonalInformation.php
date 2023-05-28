<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'lastname',
        'firstname',
        'other_names',
        'father_name',
        'date_of_birth',
        'sex',
        'citizenship',
        'specify_citizenship',
        'ethnic_background',
        'specify_ethnic_background',
        'marital_status',
        'no_of_dependents',
        'languages_spoken',
        'specify_languages_spoken'
    ];

    protected $casts = [
        'ethnic_background' => 'array',
        'languages_spoken' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
