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

    public function course()
    {
        return $this->belongsTo(Course::class);
    }


    public function responses()
    {
        return $this->hasMany(TestResponse::class);
    }

    public function attempted()
    {
        return $this->hasMany(TestResponse::class)->where('attempted', 'yes');
    }

}
