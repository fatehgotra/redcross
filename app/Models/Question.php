<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'question',
        'option_1',
        'option_2',
        'option_3',
        'option_4',
        'correct_option',
        'status'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function responses()
    {
        return $this->hasMany(TestResponse::class);
    }

}
