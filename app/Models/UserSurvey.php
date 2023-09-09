<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSurvey extends Model
{
    use HasFactory;

    protected $table = 'user_survey';

    protected $fillable = [
        'survey',
        'survey_id',
        'user_id',
        'link',
        'status'
    ];
}
