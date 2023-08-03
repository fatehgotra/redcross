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
        'test_reward_points',
        'video_reward_points',
        'status'
    ];

    public function documents()
    {
        return $this->hasMany(CourseDocument::class, 'course_id');
    }

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
