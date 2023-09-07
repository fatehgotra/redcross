<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageComment extends Model
{
    use HasFactory;

    protected $table = 'message_comments';

    protected $primaryKey = 'id';

    protected $fillable = ['message_id','user_id','message','flex'];

    public function message() {
        return $this->belongsTo(Message::class, 'id','message_id');
    }

     public function user() {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
