<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $table = 'messages';

    protected $primaryKey = 'id';

    protected $fillable = ['sender_id','receiver_id'];

    public function user() {
        return $this->belongsTo(User::class, 'receiver_id','id');
    }

    public function messagecomments() {
        return $this->hasMany(MessageComment::class, 'id', 'message_id');
    }

    public function usersender() {
        return $this->belongsTo(User::class, 'sender_id','id');
    }

     public function userreceiver() {
        return $this->belongsTo(User::class, 'receiver_id','id');
    }

   
}
