<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'starts_at',
        'ends_at',
        'correct',
        'incorrect',
        'unattempted',
        'marks',
    ];
}
