<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityAttendees extends Model
{
    use HasFactory;

    protected $table = 'community_attendees';

    protected $fillable = [
        'community_id',
        'attendee_id',
    ];

    public function user(){

        return $this->hasOne(User::class,'id','attendee_id');
    }
}
