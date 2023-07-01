<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_attempt_id',
        'user_id',
        'course_id',
        'question_id',
        'attempted',
        'option',
        'correct',
    ];

    public function attempt()
    {
        return $this->belongsTo(TestAttempt::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

}
