<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status'
    ];

    public function questions()
    {
        return $this->hasMany(Question::class, 'course_id')->where('status', true);
    }

    public function videos()
    {
        return $this->hasMany(Video::class, 'course_id')->where('status', true);
    }

    public function attempts()
    {
        return $this->hasMany(TestAttempt::class);
    }


}
