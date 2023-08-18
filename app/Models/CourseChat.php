<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseChat extends Model
{
    use HasFactory;

    protected $table = 'course_chat';

    protected $fillable = [

        'created_by',
        'subject',
        'body',
        'priority',
        'status'

    ];

    public function user(){

        return $this->belongsTo(User::class,'created_by');
    }

    public function replies()
    {
        return $this->hasMany(SupportReplies::class, 'support_id');
    }

}