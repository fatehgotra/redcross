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
        'enquiry_type',
        'description',
        'status'

    ];

    public function user(){

        return $this->belongsTo(User::class,'created_by');
    }

    public function replies()
    {
        return $this->hasMany(SupportReplies::class, 'support_id');
    }

    public function messages(){

        return $this->hasOne(Message::class,'receiver_id','created_by');
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function ($chat) {
           
           $msg = Message::where('receiver_id',$chat->id)->get()->first();
           Message::where('receiver_id',$chat->id)->delete();
           MessageComment::where('message_id',$msg->id)->delete();
           
        });
    }

}
